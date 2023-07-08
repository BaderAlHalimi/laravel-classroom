<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClassroomsController extends Controller
{
    //
    function index()
    {
        // return 'hello';
        return view('classroom', ['name' => 'Bader Halimi','title'=>'Web Designer','social'=>['facebook','youtube','twitter','instagram']]);
    }
}
