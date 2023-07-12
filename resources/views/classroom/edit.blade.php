@extends('classroom.master')
@section('title', 'classroom | edit')
@section('content')
    <main>
        <div class="container">
            <div class="row justify-content-center align-items-center g-2">
                <div class="container">
                    <form method="POST" action="{{ route('Classroom.update', $data->id) }}">
                        {{-- <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        {{ csrf_field() }} --}}
                        @csrf
                        <!-- Form Method Sppofing -->
                        {{-- <input type="hidden" name="_method" value="put"> --}}
                        {{-- {{ method_field('put') }} --}}
                        @method('put')

                        {{-- <h1>{{ $data->id }}</h1> --}}
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="name" id="name" value="{{ $data->name }}"
                                placeholder="Class Name">
                            <label for="name">Class Name</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="section" id="section"
                                value="{{ $data->section }}" placeholder="Section">
                            <label for="section">Section</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="subject" id="subject"
                                value="{{ $data->subject }}" placeholder="Subject">
                            <label for="subject">Subject</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="room" id="room" placeholder="Room"
                                value="{{ $data->room }}">
                            <label for="room">Room</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="file" class="form-control" name="cover_image" id="cover_image"
                                placeholder="cover_image">
                            <label for="cover_image" class="col-4 col-form-label">cover_image</label>
                        </div>

                        <div class="form-floating mb-3">
                            <button type="submit" class="btn btn-primary">edit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
