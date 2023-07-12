<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Topic;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\MergeValue;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class ClassroomsController extends Controller
{
    //
    function index()
    {
        // $classes = Classroom::all(); // Collection object
        $classes = Classroom::orderBy('name', 'DESC')->get(); // Collection object
        // return 'hello';
        return view(
            'classroom.index',
            [
                'name' => 'Bader Halimi',
                'title' => 'Web Designer',
                'social' => ['facebook', 'youtube', 'twitter', 'instagram'],
                'classes' => $classes
            ]
        );
    }

    function edit($id)
    {
        $data = Classroom::find($id);
        // return 'hello';
        return view('classroom.edit', ['data' => $data]);
    }
    function show($id)
    {
        $topics = Topic::where('classroom_id', $id)->get();
        $data = Classroom::findOrFail($id);
        if (!$data) {
            abort('404');
        }
        // return 'hello';
        return view('classroom.show', ['data' => $data, 'id' => $id,'topics'=>$topics]);
    }
    function create()
    {
        // return 'hello';
        return view('classroom.create');
    }
    function store(Request $request)
    {

        // $classroom = new Classroom();
        // $classroom->name = $request->name;
        // $classroom->section = $request->section;
        // $classroom->subject = $request->subject;
        // $classroom->room = $request->room;
        // $classroom->code = Str::random(9);
        // $classroom->save();
        // $request['code'] = Str::random(8);
        $request->merge(['code' => Str::random(8)]);
        // dd($request->all());
        // exit;
        // $classroom = Classroom::create($request->all());
        Classroom::create($request->all());


        // $classroom = new Classroom();
        // $classroom->fill($request->all())->save();
        // $classroom->forceFill($request->all())->save(); // danger!!




        //PRG; Post Redirect Get
        return redirect()->route('Classroom.index');

        // return 'hello';
        // echo $request->name;
        // dd($request->all());
        // exit;

        // return view('classroom.create');
    }
    function update(Request $request, $id)
    {
        $classroom = Classroom::find($id);
        $classroom->name = $request->name;
        $classroom->section = $request->section;
        $classroom->subject = $request->subject;
        $classroom->room = $request->room;
        $classroom->save();

        //PRG; Post Redirect Get
        return redirect()->route('Classroom.index');

        //Mass Assignment
        // $classroom->update($request->all());
        // $classroom->fill($request->all())->save();
        // $classroom->forceFill($request->all())->save();
    }
    function destroy($id)
    {
        Classroom::destroy($id);

        // Classroom::where('id', '=',$id)->delete();

        // $classroom = Classroom::find($id);
        // $classroom->delete();

        //PRG; Post Redirect Get
        return redirect()->route('Classroom.index');
    }
}
