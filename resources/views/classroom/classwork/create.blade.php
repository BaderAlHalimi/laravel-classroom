@extends('layout.master')
@section('title', 'classwork | create')
@section('content')
    <main>
        <div class="container">
            <div class="row justify-content-center align-items-center g-2">
                <x-public-error-form :errors="$errors" />
                <x-alert name="error" class="alert-danger"/>
                <h1>{{ $classroom->name }} (#{{ $classroom->id }})</h1>
                <h3>Create Classwork</h3>
                <hr>
                <div class="container">
                    <form method="POST" action="{{ route('classroom.classwork.store', [$classroom->id, 'type' => $type]) }}">
                        @csrf
                        
                        @include('classroom.classwork._form')


                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
