@extends('layout.master')
@section('title', 'classroom')
@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-center g-2">
            <div class="col-6 bg-light px-5 py-4">
                <center>
                    <h1>{{ $classroom->name }}</h1>
                    <h3>{{ Auth::user()->name }}</h3>
                    <form action="{{ route('classroom.jstore', ['classroom' => $classroom->id]) }}" method="post">
                        @csrf
                        <input type="submit" class="btn btn-info" value="Join">
                    </form>
                </center>
            </div>
        </div>
    </div>
@endsection
