@extends('layout.master')
@section('title', 'classroom')
@section('content')
    <?php use App\Models\classroom; ?>
    <main class="container">
        <h1-6>Example heading<span class="badge bg-primary">New</span></h1-6>
        <p>Welcome {{ $name }}, {{ $title }}</p>
        <p>Social media: </p>
        <ul class="list-group">
            @foreach ($social as $value)
                <li class="list-group-item btn btn-primary my-2">{{ $value }}</li>
            @endforeach
        </ul>
        @if ($success)
            <div class="alert alert-success" role="alert">
                <strong>!</strong> {{ $success }}
            </div>
        @endif

        <a href="{{ route('classroom.create') }}" class="btn btn-warning my-2">create classroom</a>
        <div class="row justify-content-center align-items-center g-2">
            @foreach ($classes as $item)
                <div class="col-4 order-first offset-md-4 ms-auto">
                    <div class="card">
                        <div class="card-header">
                            <img style="width: 100%"
                                src="{{ Storage::disk(Classroom::$disk)->url($item->cover_image_path) }}" alt="image">
                        </div>
                        {{-- <img class="card-img-top" src="holder.js/100x180/" alt="Title"> --}}
                        <div class="card-body">
                            <h4 class="card-title">{{ $item->name }}</h4>
                            <p class="card-text">{{ $item->section }}</p>
                            <p class="card-text">{{ $item->subject }}</p>
                            <p class="card-text">{{ $item->room }}</p>
                            <p class="card-text">{{ $item->code }}</p>
                            <a href="{{ route('classroom.show', ['id' => $item->id]) }}" class="btn btn-primary">show</a>
                            <a href="{{ route('classroom.edit', ['id' => $item->id]) }}" class="btn btn-secondary">edit</a>
                            <form style="display: inline-block;" method="post"
                                action="{{ route('classroom.delete', ['id' => $item->id]) }}">
                                @csrf
                                @method('delete')
                                <input type="submit" class="btn btn-danger" value="delete">
                            </form>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </main>
@endsection
