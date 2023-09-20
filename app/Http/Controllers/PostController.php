<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    //
    public function store(Request $request, Classroom $classroom)
    {
        $request->validate([
            'content' => ['required', 'string'],
        ]);
        $request->merge([
            'user_id'=>Auth::id(),
        ]);
        $classroom->posts()->create($request->all());
        return back();
    }
}
