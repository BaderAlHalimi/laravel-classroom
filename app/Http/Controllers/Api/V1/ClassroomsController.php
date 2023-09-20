<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ClassroomCollection;
use App\Models\Classroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\Rule;
use Throwable;

class ClassroomsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!Auth::guard('sanctum')->user()->tokenCan('classrooms.read')) {
            abort(403);
        }
        $classrooms = Classroom::with('user:id,name')
            ->with('topics')
            ->withCount('students as students')
            ->paginate(5);
        // return response()->json($classrooms, 400, [
        //     'x-test' => 'test',
        // ]);
        return new ClassroomCollection($classrooms);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!Auth::guard('sanctum')->user()->tokenCan('classrooms.create')) {
            abort(403);
        }
        // try {
        $request->validate([
            'name' => ['required'],
        ]);
        // } catch (Throwable $e) {
        //     return Response::json(['message'=>$e->getMessage()],422);
        // }
        $classroom = Classroom::create($request->all());
        return Response::json([
            'code' => 100,
            'message' => __('Classroom created.'),
            'classroom' => $classroom,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Classroom $classroom)
    {
        //
        if (!Auth::guard('sanctum')->user()->tokenCan('classrooms.read')) {
            abort(403);
        }
        return response()->json($classroom->load('user')->loadCount('students as students'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Classroom $classroom)
    {
        //
        if (!Auth::guard('sanctum')->user()->tokenCan('classrooms.update')) {
            abort(403);
        }
        $request->validate([
            'name' => [
                'sometimes', 'required',
                // "unique:classrooms,name,$classroom->id",
                Rule::unique('classrooms', 'name')->ignore($classroom->id)
            ],
            'section' => ['sometimes', 'required'],
        ]);
        $classroom->update($request->all());
        return [
            'code' => 100,
            'message' => __('Classroom Updated.'),
            'classroom' => $classroom,
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        if (!Auth::guard('sanctum')->user()->tokenCan('classrooms.delete')) {
            abort(403);
        }
        Classroom::destroy($id);
        return Response::json([],204);
    }
}
