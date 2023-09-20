@extends('layout.master')
@section('title', 'classroom')
@section('content')
    <main class="container">
        @if ($success)
            <div class="alert alert-success" role="alert">
                <strong>!</strong> {{ $success }}
            </div>
        @endif
        <h3>{{ __("Classrooms") }}</h3>
        <a href="{{ route('classroom.create') }}" class="btn btn-warning my-2">{{ __("create classroom") }}</a>
        <div class="row">
            @foreach ($classes as $item)
                <div class="col-4">
                    <x-classroom-card :item=$item />
                </div>
            @endforeach
        </div>
    </main>
@endsection
