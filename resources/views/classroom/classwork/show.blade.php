@extends('layout.master')
@section('title', 'classwork | create')
@section('content')
    <main>
        <div class="container">
            <div class="row justify-content-center align-items-center g-2">
                <x-public-error-form :errors="$errors" />
                <h1>{{ $classroom->name }} (#{{ $classroom->id }})</h1>
                <h3>{{ $classwork->title }}</h3>
                <hr>
                <div>
                    {!! $classwork->description !!}
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-8">

                            <x-alert name="success" class="alert-success" />
                            <x-alert name="error" class="alert-danger" />
                            <form method="POST" action="{{ route('comments.store') }}">
                                @csrf
                                <input type="hidden" name="id" value="{{ $classwork->id }}">
                                <input type="hidden" name="type" value="classwork">
                                <div class="row">
                                    <div class="form-floating mb-3 col-10">
                                        {{-- <textarea name="" id="" cols="30" rows="10"></textarea> --}}
                                        <textarea rows="5" @class(['form-control', 'is-invalid' => $errors->has('content')]) name="content" id="content" placeholder="Comment">{{ old('content') }}</textarea>
                                        <label for="content" class="px-4">Comment</label>
                                        <x-error-form name="content" message={{ $message }} />
                                    </div>

                                    <div class="form-floating mb-3 col-2">
                                        <button type="submit" class="btn btn-primary px-4">sent</button>
                                    </div>
                                </div>
                                <hr>
                                @foreach ($classwork->comments as $comment)
                                    <div class="row">
                                        <div class="col-1"><img style="border-radius: 100px;"
                                                src="https://ui-avatars.com/api/?name={{ $comment->user->name }}"
                                                alt=""></div>
                                        <div class="col-11">
                                            <p>By: {{ $comment->user->name }}, Time:
                                                {{ $comment->created_at->diffForHumans(null, true, true) }}</p>
                                            <p>{{ $comment->content }}</p>

                                        </div>
                                        <hr>
                                    </div>
                                @endforeach
                            </form>
                        </div>
                        <div class="col-4">
                            @can('submissions.create', [$classwork])
                                <div class="bordered rounded p-3 bg-light">
                                    <h4>Submit</h4>
                                    @if ($submissions->count())
                                        <ul>
                                            @foreach ($submissions as $sbmt)
                                                <li><a href="{{ route('submissions.file', $sbmt->id) }}">File:
                                                        {{ $loop->iteration }}</a></li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <form action="{{ route('submissions.store', $classwork->id) }}" method="post"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-floating mb-3 col-10">
                                                {{-- <textarea name="" id="" cols="30" rows="10"></textarea> --}}
                                                <input type="file" multiple
                                                    accept="image/*,application/pdf,text/plain"
                                                    @class(['form-control', 'is-invalid' => $errors->has('files.0')]) name="files[]" id="files"
                                                    placeholder="Select Files" />
                                                <label for="files" class="px-4">Select Files</label>
                                                <x-error-form name="files.0" message={{ $message }} />
                                            </div>

                                            <div class="form-floating mb-3 col-2">
                                                <button type="submit" class="btn btn-primary px-4">Submit</button>
                                            </div>
                                        </form>
                                    @endif

                                </div>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </main>
@endsection
