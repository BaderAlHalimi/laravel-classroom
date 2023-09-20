@extends('layout.master')
@section('title', 'classwork | create')
@section('content')
    <main>
        <div class="container">
            <div class="row justify-content-center align-items-center g-2">
                <x-public-error-form :errors="$errors" />
                <h1>{{ $classroom->name }} (#{{ $classroom->id }})</h1>
                <h3>Create Classwork</h3>
                <hr>
                <div class="container">
                    <x-alert name="success" class="alert-success"/>
                    <form method="POST" action="{{ route('classroom.classwork.update', [$classroom->id,$classwork->id, 'type' => $type]) }}">
                        @csrf
                        @method('put')
                        
                        @include('classroom.classwork._form')

                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
