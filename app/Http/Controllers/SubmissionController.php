<?php

namespace App\Http\Controllers;

use App\Models\Classwork;
use App\Models\ClassworkUser;
use App\Models\Submission;
use App\Rules\ForbiddenFile;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Throwable;

class SubmissionController extends Controller
{
    //
    public function store(Request $request, Classwork $classwork)
    {
        Gate::authorize('submissions.create',[$classwork]);
        $request->validate([
            'files' => 'required|array',
            'files.*' => ['file', new ForbiddenFile('text/x-php')]
        ]);
        $assigned = $classwork->users()->where('id', Auth::id())->exists();
        if (!$assigned) {
            abort(403);
        }
        DB::beginTransaction();
        try {
            $data = [];
            $user = Auth::user();
            foreach ($request->file('files') as $file) {
                $data[] = [
                    'user_id' => $user->id,
                    'classwork_id' => $classwork->id,
                    'content' => $file->store("submissions/{$classwork->id}"),
                    'type' => 'file',
                ];
            }
            $user->submission()->createMany($data);
            // Submission::insert($data);
            ClassworkUser::where([
                'user_id' => $user->id,
                'classwork_id' => $classwork->id,
            ])->update([
                'status' => 'submitted',
                'submitted_at' => now(),
            ]);
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
        return back()->with('success', 'work submitted');
    }
    public function file(Submission $submission)
    {
        $user = Auth::user();
        //check if the user is classroom teacher
        $isTeacher = $submission->classwork->classroom->teachers()->where('id', $user->id)->exists();
        $isOwner = $submission->user_id == $user->id;
        if (!$isTeacher && !$isOwner) {
            abort(403);
        }
        // dd('app/' . $submission->content);
        return response()->file(storage_path('app/' . $submission->content));
    }
}
