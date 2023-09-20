@extends('layout.master')
@section('title', 'classroom | edit')
@section('content')
    <main>
        <div class="container">
            <div class="row justify-content-center align-items-center g-2">
                <div class="container">
                    <form method="POST" action="{{ route('classroom.update', $data->id) }}" enctype="multipart/form-data">
                        {{-- <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        {{ csrf_field() }} --}}
                        @csrf
                        <!-- Form Method Sppofing -->
                        {{-- <input type="hidden" name="_method" value="put"> --}}
                        {{-- {{ method_field('put') }} --}}
                        @method('put')
                        <x-form-component name="name" label="Class Name" value="{{ $data->name }}" />
                        <x-form-component name="section" label="Section" value="{{ $data->section }}" />
                        <x-form-component name="subject" label="Subject" value="{{ $data->subject }}" />
                        <x-form-component name="room" label="Room" value="{{ $data->room }}" />
                        <div class="form-floating mb-3">
                            <select class="form-control" name="theme" id="theme">
                                <option value="https://gstatic.com/classroom/themes/img_bookclub.jpg">green study</option>
                                <option value="https://gstatic.com/classroom/themes/img_backtoschool.jpg">blue study
                                </option>
                            </select>
                        </div>

                        <x-form-component name="cover_image" type="file" label="cover_image" />

                        {{-- <h1>{{ $data->id }}</h1> --}}
                        {{-- <div class="form-floating mb-3">
                            <input type="text" @class(['form-control', 'is-invalid' => $errors->has('name')]) name="name" id="name"
                                value="{{ old('name',$data->name) }}" placeholder="Class Name">
                            <label for="name">Class Name</label>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" @class(['form-control', 'is-invalid' => $errors->has('section')]) name="section" id="section"
                                value="{{ old('section',$data->section) }}" placeholder="Section">
                            <label for="section">Section</label>
                            @error('section')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" @class(['form-control', 'is-invalid' => $errors->has('subject')]) name="subject" id="subject"
                                value="{{ old('subject',$data->subject) }}" placeholder="Subject">
                            <label for="subject">Subject</label>
                            @error('subject')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" @class(['form-control', 'is-invalid' => $errors->has('room')]) name="room" id="room" placeholder="Room"
                                value="{{ old('room',$data->room) }}">
                            <label for="room">Room</label>
                            @error('room')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <input type="file" @class(['form-control', 'is-invalid' => $errors->has('cover_image')]) name="cover_image" id="cover_image">
                            <label for="cover_image" class="col-4 col-form-label">cover_image</label>
                            @error('cover_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div> --}}

                        <div class="form-floating mb-3">
                            <button type="submit" class="btn btn-primary">edit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
