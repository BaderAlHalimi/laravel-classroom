<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClassroomRequest;
use App\Models\classroom;
use App\Models\Topic;
use Exception;
use GuzzleHttp\Psr7\Query;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\MergeValue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Throwable;

class classroomsController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('subscribed')->only('create','store');
    }
    function index()
    {
        // $classes = classroom::all(); // Collection object
        $classes = classroom::orderBy('name', 'DESC')->get(); // Collection object
        $id = Auth::id();
        // return 'hello';
        return view(
            'classroom.index',
            [
                'success' => session('success'),
                'classes' => $classes,
                'id' => $id,
            ]
        );
    }

    function edit($id)
    {
        $data = classroom::findOrFail($id);
        if (!$data) {
            abort(404, "this classroom not found!");
        }
        // return 'hello';
        return view('classroom.edit', ['data' => $data]);
    }
    function show($id)
    {
        $topics = Topic::where('classroom_id', $id)->get();
        $data = classroom::where('id', $id)->first();
        if (!$data) {
            abort('404');
        }
        // dd($data);
        $classworks = $data->classworks;
        // return 'hello';
        $response = response()->view('classroom.show', ['data' => $data, 'id' => $id, 'topics' => $topics, 'classworks' => $classworks]);
        $response->header('Cache-Control', 'public, max-age=600'); // تعيين Cache-Control بالقيم المناسبة
        return $response;
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
        $validated['user_id'] = Auth::id();
        // $request->merge(['code' => Str::random(8)]);
        // dd($request->all());
        // exit;
        // $classroom = classroom::create($request->all());
        DB::beginTransaction();
        try {
            $classroom = classroom::create($validated);
            DB::table('classroom_user')->insert([
                'classroom_id'  => $classroom->id,
                'user_id'       => Auth::id(),
                'role'          => 'teacher'
            ]);
            DB::commit();
        } catch (QueryException $e) {
            DB::rollBack();
            return back()
                ->with('error', $e->getMessage())
                ->withInput();
        }


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
    function destroy($id)
    {
        $classroom = Classroom::find($id);
        // classroom::destroy($id);

        // classroom::where('id', '=',$id)->delete();

        // $classroom = classroom::find($id);
        DB::beginTransaction();
        try {
            $classroom->delete();
            Storage::disk(classroom::$disk)->delete($classroom->cover_image_path);
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();
            // dd($e->getMessage());
        }


        //PRG; Post Redirect Get
        return redirect()->route('classroom.index');
    }
}
