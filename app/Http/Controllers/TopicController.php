<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    //
    function store(Request $request, $url, $id = null)
    {
        $request['classroom_id'] = $id;
        // dd($request->all());
        // exit;
        Topic::create($request->all());
        //PRG; Post Redirect Get
        if (!$id) {
            return redirect()->route($url);
        } else {
            return redirect()->route($url, ['id' => $id]);
        }
    }
    function update(Request $request, $url, $id = null)
    {
        if (!$request->name) {
            if (!$id) {
                return redirect()->route($url);
            } else {
                return redirect()->route($url, ['id' => $id]);
            }
            return;
        }
        $topic = Topic::find($request->id);
        $topic->name = $request->name;
        $topic->user_id = $request->user_id;
        $topic->save();
        //PRG; Post Redirect Get
        if (!$id) {
            return redirect()->route($url);
        } else {
            return redirect()->route($url, ['id' => $id]);
        }
    }
    function index($id)
    {
        return Topic::where('classroom_id', $id)->get();
    }
    function show($id)
    {
    }
    function destroy(Request $request, $url, $id = null)
    {
        Topic::destroy($request->id);

        if (!$id) {
            //PRG; Post Redirect Get
            return redirect()->route($url);
        } else {
            return redirect()->route($url, ['id' => $id]);
        }
    }
}
