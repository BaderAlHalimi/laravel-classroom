<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\View\Components\classroom as ComponentsClassroom;
use Illuminate\Http\Request;

class ClassroomUserController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Classroom $classroom)
    {
        return view('classroom.people', compact(['classroom']));
    }
    public function destroy(Request $request, Classroom $classroom)
    {
        $request->validate([
            'user_id' => ['required'/*,'exists:classroom_user,user_id'*/]
        ]);
        $user_id = $request->input('user_id');
        if ($user_id == $classroom->user_id) {
            return redirect()->route('classroom.people', $classroom->id)
                ->with('error', 'can\' remove user!');
        }
        $classroom->users()->detach($user_id);
        return redirect()->route('classroom.people', $classroom->id)
            ->with('success', 'user removed!');
    }
}
