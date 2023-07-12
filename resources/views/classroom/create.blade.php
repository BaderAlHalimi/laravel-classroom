@extends('classroom.master')
@section('title', 'Classroom | create')
@section('content')
    <main>
        <div class="container">
            <div class="row justify-content-center align-items-center g-2">
                <div class="container">
                    <form method="POST" action="{{ route('Classroom.store') }}">
                        {{-- <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        {{ csrf_field() }} --}}
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="name" id="name" placeholder="Class Name">
                            <label for="name">Class Name</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="section" id="section" placeholder="Section">
                            <label for="section">Section</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject">
                            <label for="subject">Subject</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="room" id="room" placeholder="Room">
                            <label for="room">Room</label>
                        </div>
                        <div class="form-floating mb-3">
                            <select class="form-control" name="theme" id="theme">
                                <option value="https://gstatic.com/classroom/themes/img_bookclub.jpg">green study</option>
                                <option value="https://gstatic.com/classroom/themes/img_backtoschool.jpg">blue study
                                </option>
                            </select>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="file" class="form-control" name="cover_image" id="cover_image"
                                placeholder="cover_image">
                            <label for="cover_image" class="col-4 col-form-label">cover_image</label>
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
