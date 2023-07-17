@extends('layout.master')
@section('title', 'classroom | create')
@section('content')
    <main>
        <div class="container">
            <div class="row justify-content-center align-items-center g-2">
                {{-- <div class="alert alert-danger" role="alert">
                    <ul>
                        @foreach ($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div> --}}

                <div class="container">
                    <form method="POST" action="{{ route('classroom.store') }}" enctype="multipart/form-data">
                        {{-- <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        {{ csrf_field() }} --}}
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="text" @class(['form-control', 'is-invalid' => $errors->has('name')]) name="name" id="name"
                                placeholder="Class Name" value="{{ old('name') }}">
                            <label for="name">Class Name</label>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" @class(['form-control', 'is-invalid' => $errors->has('section')]) name="section" id="section"
                                placeholder="Section" value="{{ old('section') }}">
                            <label for="section">Section</label>
                            @error('section')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" @class(['form-control', 'is-invalid' => $errors->has('subject')]) name="subject" id="subject"
                                placeholder="Subject" value="{{ old('subject') }}">
                            <label for="subject">Subject</label>
                            @error('subject')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" @class(['form-control', 'is-invalid' => $errors->has('room')]) name="room" id="room"
                                placeholder="Room" value="{{ old('room') }}">
                            <label for="room">Room</label>
                            @error('room')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <select class="form-control" name="theme" id="theme">
                                <option value="https://gstatic.com/classroom/themes/img_bookclub.jpg">green study</option>
                                <option value="https://gstatic.com/classroom/themes/img_backtoschool.jpg">blue study
                                </option>
                            </select>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="file" @class(['form-control', 'is-invalid' => $errors->has('cover_image')]) name="cover_image" id="cover_image"
                                placeholder="cover_image">
                            <label for="cover_image" class="col-4 col-form-label">cover_image</label>
                            @error('cover_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <button type="submit" class="btn btn-primary">create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
