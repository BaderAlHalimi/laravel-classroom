@extends('layout.master')
@section('title', 'classroom | create')
@section('content')
    <main>
        <div class="container">
            <div class="row justify-content-center align-items-center g-2">
                <x-public-error-form :errors="$errors" />

                <div class="container">
                    <form method="POST" action="{{ route('classroom.store') }}" enctype="multipart/form-data">
                        {{-- <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        {{ csrf_field() }} --}}
                        @csrf
                        <x-form-component name="name" label="Class Name" />
                        <x-form-component name="section" label="Section" />
                        <x-form-component name="subject" label="Subject" />
                        <x-form-component name="room" label="Room" />
                        <div class="form-floating mb-3">
                            <select class="form-control" name="theme" id="theme">
                                <option value="https://gstatic.com/classroom/themes/img_bookclub.jpg">green study</option>
                                <option value="https://gstatic.com/classroom/themes/img_backtoschool.jpg">blue study
                                </option>
                            </select>
                        </div>

                        <x-form-component name="cover_image" type="file" label="cover_image" />
                        {{-- <div class="form-floating mb-3">
                            <input type="text" @class(['form-control', 'is-invalid' => $errors->has('name')]) name="name" id="name"
                                placeholder="Class Name" value="{{ old('name') }}">
                            <label for="name">Class Name</label>
                            <x-error-form name="name" message={{ $message }} />
                        </div> --}}
                        {{-- <div class="form-floating mb-3">
                            <input type="text" @class(['form-control', 'is-invalid' => $errors->has('section')]) name="section" id="section"
                                placeholder="Section" value="{{ old('section') }}">
                            <label for="section">Section</label>
                            <x-error-form name="section" message={{ $message }} />

                        </div> --}}
                        {{-- <div class="form-floating mb-3">
                            <input type="text" @class(['form-control', 'is-invalid' => $errors->has('subject')]) name="subject" id="subject"
                                placeholder="Subject" value="{{ old('subject') }}">
                            <label for="subject">Subject</label>
                            <x-error-form name="subject" message={{ $message }} />
                        </div> --}}

                        {{-- <div class="form-floating mb-3">
                            <input type="text" @class(['form-control', 'is-invalid' => $errors->has('room')]) name="room" id="room"
                                placeholder="Room" value="{{ old('room') }}">
                            <label for="room">Room</label>
                            <x-error-form name="room" message={{ $message }} />
                        </div> --}}
                        {{-- <div class="form-floating mb-3">
                            <select class="form-control" name="theme" id="theme">
                                <option value="https://gstatic.com/classroom/themes/img_bookclub.jpg">green study</option>
                                <option value="https://gstatic.com/classroom/themes/img_backtoschool.jpg">blue study
                                </option>
                            </select>
                        </div>

                        {{-- <div class="form-floating mb-3">
                            <input type="file" @class(['form-control', 'is-invalid' => $errors->has('cover_image')]) name="cover_image" id="cover_image"
                                placeholder="cover_image">
                            <label for="cover_image" class="col-4 col-form-label">cover_image</label>
                            <x-error-form name="cover_image" message={{ $message }} />
                        </div> --}}

                        <div>
                            <button type="submit" class="btn btn-primary">create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
