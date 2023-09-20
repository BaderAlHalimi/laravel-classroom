<?php

namespace App\Http\Controllers;

use App\Enums\ClassworkType;
use App\Events\ClassworkCreated;
use App\Models\Classroom;
use App\Models\Classwork;
use Error;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use ValueError;

class ClassworkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected function getType(Request $request)
    {
        try {
            return ClassworkType::from($request->query('type'));
        } catch (Error $e) {
            return Classwork::TYPE_ASSIGNMENT;
        }
    }

    protected function teacherClassworks()
    {
    }

    public function index(Request $request, Classroom $classroom)
    {
        //
        $classwork = $classroom->classworks()
            ->with('topic') //Eager load
            ->withCount([
                'users as assigned_count' => function ($query) {
                    $query->where('classwork_user.status', 'assigned');
                },
                'users as turnedin_count' => function ($query) {
                    $query->where('classwork_user.status', 'submitted');
                },
                'users as graded_count' => function ($query) {
                    $query->whereNotNull('classwork_user.grade');
                },
            ])
            ->filter($request->query())
            ->latest('published_at')
            ->where(function ($query) {
                $query->whereHas('users', function ($query) {
                    $query->where('id', Auth::id());
                })
                    ->orWhereHas('classroom.teachers', function ($query) {
                        $query->where('id', Auth::id());
                    });
            })
            ->paginate(5);
        return view('classroom.classwork.index', ['classroom' => $classroom, 'classworks' => $classwork]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request, Classroom $classroom)
    {
        $response = Gate::inspect('classworks.create', [$classroom]);
        if (!$response->allowed()) {
            abort(403, $response->message() ?? '');
        }
        // Gate::authorize('classworks.create', [$classroom]);

        $type = $this->getType($request)->value;
        $topics = $classroom->topics;
        $classwork = new Classwork();
        return view('classroom.classwork.create', compact('classroom', 'type', 'topics', 'classwork'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Classroom $classroom)
    {
        //
        if (Gate::denies('classworks.create', [$classroom])) abort(403);
        // dd($request->all());
        $type = $this->getType($request)->value;
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'discription' => ['nullable', 'string'],
            'topic_id' => ['nullable', 'int', 'exists:topics,id'],
            'options.grade' => [Rule::requiredIf(fn () => $type == 'assignment'), 'numeric', 'min:0'],
            'options.due' => ['nullable', 'date', 'after:published_at'],
        ]);
        $request->merge([
            'user_id' => Auth::id(),
            'type'    => $type,
            // 'classroom_id' => $classroom->id,
        ]);
        try {
            $classwork = new Classwork();
            DB::transaction(function () use ($classroom, $classwork, $request) {
                // $data = [
                //     'user_id'   => Auth::id(),
                //     'type'      => $type,
                //     'title'     => $request->input('title'),
                //     'description'     => $request->input('description'),
                //     'topic_id'     => $request->input('topic_id'),
                //     'published_at'     => $request->input('published_at', now()),
                //     'options'   => [
                //         'grade' => $request->input('grade'),
                //         'due'   => $request->input('due'),
                //     ],
                // ];

                $classwork = $classroom->classworks()->create($request->all());
                $classwork->users()->attach($request->input('students'));
                // event(new ClassworkCreated($classwork));
                ClassworkCreated::dispatch($classwork); //تأدي نفس السطر الي فوقها
            });
        } catch (\Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
        // $classwork = Classwork::create($request->all());
        return redirect()->route('classroom.classwork.index', $classroom->id)
            ->with('success', 'Classwork created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Classroom $classroom, Classwork $classwork)
    {
        //
        Gate::authorize('classworks.view', [$classwork]);
        // $classwork->load('comments.user');
        $submissions = Auth::user()->submission()->where('classwork_id', $classwork->id)->get();
        return view('classroom.classwork.show', compact('classroom', 'classwork', 'submissions'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Classroom $classroom, Classwork $classwork)
    {
        //
        $type = $classwork->type->value;
        $topics = $classroom->topics;
        $assigned = $classwork->users()->pluck('id')->toArray();
        return view('classroom.classwork.edit', compact('classroom', 'type', 'topics', 'classwork', 'assigned'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Classroom $classroom, Classwork $classwork)
    {
        $type = $classwork->type;
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'discription' => ['nullable', 'string'],
            'topic_id' => ['nullable', 'int', 'exists:topics,id'],
            'options.grade' => [Rule::requiredIf(fn () => $type == 'assignment'), 'numeric', 'min:0'],
            'options.due' => ['nullable', 'date', 'after:published_at'],
        ]);

        // $data = [
        //     'user_id'   => Auth::id(),
        //     'title'     => $request->input('title'),
        //     'description'     => $request->input('description'),
        //     'topic_id'     => $request->input('topic_id'),
        //     'published_at'     => $request->input('published_at', now()),
        //     'options'   => [
        //         'grade' => $request->input('grade'),
        //         'due'   => $request->input('due'),
        //     ],
        // ];


        $classwork->update($request->all());
        $classwork->users()->sync($request->input('students'));
        return back()
            ->with('success', 'Classwork updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classroom $classroom, Classwork $classwork)
    {
        //
    }
}
