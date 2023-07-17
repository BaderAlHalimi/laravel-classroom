<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClassroomRequest;
use App\Models\classroom;
use App\Models\Topic;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\MergeValue;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class classroomsController extends Controller
{
    //
    function index()
    {
        // $classes = classroom::all(); // Collection object
        $classes = classroom::orderBy('name', 'DESC')->get(); // Collection object
        // return 'hello';
        return view(
            'classroom.index',
            [
                'success' => session('success'),
                'name' => 'Bader Halimi',
                'title' => 'Web Designer',
                'social' => ['facebook', 'youtube', 'twitter', 'instagram'],
                'classes' => $classes
            ]
        );
    }

    function edit($id)
    {
        $data = classroom::find($id);
        // return 'hello';
        return view('classroom.edit', ['data' => $data]);
    }
    function show($id)
    {
        $topics = Topic::where('classroom_id', $id)->get();
        $data = classroom::findOrFail($id);
        if (!$data) {
            abort('404');
        }
        // return 'hello';
        return view('classroom.show', ['data' => $data, 'id' => $id, 'topics' => $topics]);
    }
    function create()
    {
        // return 'hello';
        return view('classroom.create');
    }
    function store(ClassroomRequest $request)
    {
        $validated = $request->validated();
        // $validated = $request->validate([
        //     'name' => 'required|string|max:255|min:4',
        //     'section' => 'nullable|string|max:255',
        //     'subject' => 'nullable|string|max:255',
        //     'room' => 'nullable|string|max:255',
        //     'cover_image' => [
        //         'required',
        //         'image'
        //     ],
        // ]);

        if ($request->hasFile('cover_image')) {
            $file = $request->cover_image;
            $path = $file->store('/cover', classroom::$disk);
            $validated['cover_image_path'] = $path;
        }

        // $classroom = new classroom();
        // $classroom->name = $request->name;
        // $classroom->section = $request->section;
        // $classroom->subject = $request->subject;
        // $classroom->room = $request->room;
        // $classroom->code = Str::random(9);
        // $classroom->save();
        // $request['code'] = Str::random(8);
        $validated['code'] = Str::random(8);
        // $request->merge(['code' => Str::random(8)]);
        // dd($request->all());
        // exit;
        // $classroom = classroom::create($request->all());
        classroom::create($validated);


        // $classroom = new classroom();
        // $classroom->fill($request->all())->save();
        // $classroom->forceFill($request->all())->save(); // danger!!




        //PRG; Post Redirect Get
        return redirect()->route('classroom.index')->with('success', 'create successfully!');

        // return 'hello';
        // echo $request->name;
        // dd($request->all());
        // exit;

        // return view('classroom.create');
    }
    function update(Request $request, $id)
    {
        // dd($request->all());
        // exit;

        $validated = $request->validate([
            'name' => 'required|string|max:255|min:4',
            'section' => 'nullable|string|max:255',
            'subject' => 'nullable|string|max:255',
            'room' => 'nullable|string|max:255',
            'cover_image' => [
                'image',
                // 'max:102400'
                // Rule::dimensions([
                //     'min_width' => 600,
                //     'min_height' => 300
                // ]),
            ],
        ]);


        $classroom = classroom::find($id);
        $classroom->name = $validated['name'];
        $classroom->section = $validated['section'];
        $classroom->subject = $validated['subject'];
        $classroom->room = $validated['room'];

        if ($request->hasFile('cover_image')) {
            $file = $request->cover_image;
            $name = $classroom->cover_image_path ?? (Str::random(40) . '.' . $file->getClientOriginalExtention());
            // $path = $file->store('/cover',basename($name), 'uploads');
            $file->storeAs('/cover', basename($name), [
                'disk' => classroom::$disk
            ]);
            // $classroom->cover_image_path = $path;
        }

        $classroom->save();

        //PRG; Post Redirect Get
        return redirect()->route('classroom.index');

        //Mass Assignment
        // $classroom->update($request->all());
        // $classroom->fill($request->all())->save();
        // $classroom->forceFill($request->all())->save();
    }
    function destroy(classroom $classroom)
    {
        // classroom::destroy($id);

        // classroom::where('id', '=',$id)->delete();

        // $classroom = classroom::find($id);
        $classroom->delete();
        Storage::disk(classroom::$disk)->delete($classroom->cover_image_path);


        //PRG; Post Redirect Get
        return redirect()->route('classroom.index');
    }
}
