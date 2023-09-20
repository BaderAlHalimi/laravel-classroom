<?php use App\Models\Topic; ?>
@extends('layout.master')
@section('title', "classroom | $data->name")
@push('styles')
    <style>
        #sitting-post {
            text-align: center;
            /* padding: 10px; */
            /* background-color: red; */
        }

        #sitting-post:hover {
            background-color: rgba(128, 128, 128, 0.339);
            transition: 0.5s;
        }

        .post .card:hover {
            background-color: rgba(128, 128, 128, 0.339);
            transition: 0.5s;
        }

        #addTopic {
            display: none;
            border: none;
            background-color: rgba(128, 128, 128, 0.51);
            height: 100vh;
            padding: 20%;
            position: fixed;
            width: 100%;
            z-index: 10;
            top: 0;
            right: 0;
        }

        #editTopic {
            display: none;
            border: none;
            background-color: rgba(128, 128, 128, 0.51);
            height: 100vh;
            padding: 20%;
            position: fixed;
            width: 100%;
            z-index: 10;
            top: 0;
            right: 0;
        }

        #topic {
            z-index: 100;
        }

        #addTopicButton {
            width: 100%;
            height: 100vh;
            position: absolute;
            top: 0;
            right: 0;
            background: none;
            border: none;
        }

        #editTopicButton {
            width: 100%;
            height: 100vh;
            position: absolute;
            top: 0;
            right: 0;
            background: none;
            border: none;
        }
    </style>
@endpush

@section('content')
    <?php
    // echo 'hello';
    // $topics = Topic::where('classroom_id', $id)->get();
    ?>
    <main>
        <div id="addTopic">
            <button id="addTopicButton" onclick="close()"></button>
            <div class="container p-5">
                <div class="row justify-content-center align-items-center g-2">
                    <div class="col-4 justify-content-center align-items-center">
                        <div id="topic" style='text-align: left;' class="card">
                            <div class="card-body">
                                <form method="POST"
                                    action="{{ route('Topic.store', ['url' => 'classroom.show', 'id' => $id]) }}">
                                    {{-- <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    {{ csrf_field() }} --}}
                                    <h4>Add Topic</h4>
                                    @csrf
                                    <input type="hidden" name="user_id" value="1" />
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" name="name" id="name"
                                            placeholder="Class Name">
                                        <label for="name">Topic Name</label>
                                    </div>

                                    <div class="card-footer">
                                        <input type="submit" class="btn btn-primary" value="create">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="editTopic">
            <button id="editTopicButton" onclick="close()"></button>
            <div class="container p-5">
                <div class="row justify-content-center align-items-center g-2">
                    <div class="col-4 justify-content-center align-items-center">
                        <div id="topic" style='text-align: left;' class="card">
                            <div class="card-body">
                                <form method="POST"
                                    action="{{ route('Topic.update', ['url' => 'classroom.show', 'id' => $id]) }}">
                                    {{-- <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                {{ csrf_field() }} --}}
                                    @csrf
                                    @method('put')
                                    <h4>Edit Topic</h4>
                                    <select class="form-control my-2" id="selectTopic" name="id"
                                        onchange="editChoise()">
                                        <option value="none" selected>select topic</option>
                                        @foreach ($topics as $tpc)
                                            <option value="{{ $tpc->id }}">{{ $tpc->name }}</option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" name="user_id" value="1" />
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" name="name" id="TopicName"
                                            placeholder="Class Name" value="">
                                        <label for="name">Topic Name</label>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <input style="width: 100%;" type="submit" id="editButton"
                                            class="btn btn-primary disabled" value="Done!">
                                    </div>
                                </form>
                                <form class="form-floating mb-3"
                                    action="{{ route('Topic.delete', ['url' => 'classroom.show', 'id' => $id]) }}"
                                    method="POST">
                                    @csrf
                                    @method('delete')
                                    <input id="deleteTopicID" type="hidden" name="id" value="">
                                    <input id="deleteTopicButton" style="width: 100%;" type="submit"
                                        class="btn btn-primary disabled" value="delete">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="alert alert-dark alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong>remember that</strong> Usage data is used for commercial purposes!
            </div>

            <script>
                var alertList = document.querySelectorAll('.alert');
                alertList.forEach(function(alert) {
                    new bootstrap.Alert(alert)
                })
            </script>


            <br />
            <div style="background: url('{{ Storage::disk('uploads')->url($data->cover_image_path) }}');  background-size: cover; border-radius: 25px;"
                class="row justify-content-center align-items-center g-2 text-light px-3">
                <h2 style="margin: 0; margin-top:80px">{{ $data->name }}</h2>
                <h5 style="margin-bottom: 0;"">{{ $data->section }}</h5>
                <span style="margin-top: 0;">{{ $data->code }}</span>
                <div style="margin-bottom:30px;">
                    <button onclick="copy('{{ route('classroom.join', ['classroom' => $data->id]) }}')"
                        class="btn btn-outline-danger">join link</button>
                </div>
            </div>

            <div class="row justify-content-center align-items-top g-2 my-2">
                <div dir="ltr" class="col-4">
                    {{-- <div class="row">
                        <div class="col"> --}}
                    <div class="card my-2">
                        <div class="card-body">
                            <p class="card-text"><span class="bg-success text-light p-1 rounded">Subject:</span>
                                {{ $data->subject }}</p>
                            <div class="row justify-content-center align-items-center g-2">
                                <div class="col-7"><span>Topics:</span> ({{ count($topics) }}/5)</div>
                                <div class="col-5 ps-4 ms-auto">
                                    <button style="display:inline-block;" id="showTopic"
                                        class="btn btn-warning">create</button>
                                    <button style="display:inline-block;" id="editTopicButton2"
                                        class="btn btn-outline-secondary">edit</button>
                                </div>
                            </div>
                            @foreach ($topics as $value)
                                <a style="width:100%" class="px-3 py-2 my-2 btn btn-success"
                                    href="{{ route('Topic.show', ['id' => $value->id]) }}">{{ $value->name }}</a><br>
                            @endforeach
                            {{-- <a style="width:100%" class="px-3 py-2 my-2 btn btn-success" href="#">Materials</a><br> --}}
                        </div>
                    </div>
                    {{-- </div>
                    </div> --}}
                </div>
                <div class="col-8 post">
                    <a style="text-decoration: none; color:black; display: block" class="my-2" href="#">
                        <div class="card" style="  cursor: pointer;">
                            <div class="card-body">
                                <div class="row justify-content-center align-items-center g-2">
                                    <div class="col-1">
                                        <div style="width: 100%;color:white;" class="rounded-circle bg-success">
                                            <svg style="fill:white;" focusable="false" width="100%" height="60px"
                                                viewBox="0 0 24 24" class=" NMm5M hhikbc p-3">
                                                <path d="M7 15h7v2H7zm0-4h10v2H7zm0-4h10v2H7z"></path>
                                                <path
                                                    d="M19 3h-4.18C14.4 1.84 13.3 1 12 1c-1.3 0-2.4.84-2.82 2H5c-.14 0-.27.01-.4.04a2.008 2.008 0 0 0-1.44 1.19c-.1.23-.16.49-.16.77v14c0 .27.06.54.16.78s.25.45.43.64c.27.27.62.47 1.01.55.13.02.26.03.4.03h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-7-.25c.41 0 .75.34.75.75s-.34.75-.75.75-.75-.34-.75-.75.34-.75.75-.75zM19 19H5V5h14v14z">
                                                </path>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="col-11">
                                        <button onclick="formSent()" id="openformtosendpost"
                                            style="background: none;border: none; width:100%; text-align: left; padding:20px;">create
                                            post...</button>
                                        <form hidden id="sentpost" action="{{ route('post.store',['classroom'=>$data->id]) }}" method="post">
                                            @csrf
                                            <div class="row justify-content-center align-items-center g-2">

                                                <div class="col-11 px-4">
                                                    <div class="form-floating mb-3">
                                                        <textarea class="form-control" name="content"
                                                            id="content" placeholder="Text"></textarea>
                                                        <label for="content">Text</label>
                                                    </div>
                                                </div>
                                                <div class="col-1">
                                                    <div id="sitting-post" class="py-3 rounded-circle">
                                                        <button type="submit" class="btn btn-primary">sent</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    <script>
                        function formSent() {
                            document.getElementById('sentpost').removeAttribute("hidden");
                            document.getElementById('openformtosendpost').setAttribute("hidden",true);
                        }
                    </script>
                    @foreach ($classworks as $clw)
                        <a style="text-decoration: none; color:black; display: block" class="my-2" href="#">
                            <div class="card" style="  cursor: pointer;">
                                <div class="card-body">
                                    <div class="row justify-content-center align-items-center g-2">
                                        <div class="col-1">
                                            <div style="width: 100%;color:white;" class="rounded-circle bg-success">
                                                <svg style="fill:white;" focusable="false" width="100%" height="60px"
                                                    viewBox="0 0 24 24" class=" NMm5M hhikbc p-3">
                                                    <path d="M7 15h7v2H7zm0-4h10v2H7zm0-4h10v2H7z"></path>
                                                    <path
                                                        d="M19 3h-4.18C14.4 1.84 13.3 1 12 1c-1.3 0-2.4.84-2.82 2H5c-.14 0-.27.01-.4.04a2.008 2.008 0 0 0-1.44 1.19c-.1.23-.16.49-.16.77v14c0 .27.06.54.16.78s.25.45.43.64c.27.27.62.47 1.01.55.13.02.26.03.4.03h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-7-.25c.41 0 .75.34.75.75s-.34.75-.75.75-.75-.34-.75-.75.34-.75.75-.75zM19 19H5V5h14v14z">
                                                    </path>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="col-10 px-4">
                                            <p style="margin:0;" class="card-text"><span>تم نشر مهمة دراسية جديدة من قبل
                                                    {{ $clw->user->name }}:</span> درجات الامتحان النهائي</p>
                                            <span style="color:grey;">{{ $clw->topic->name }}</span><br>
                                            <span
                                                style="color:grey;">{{ $clw->created_at->diffForHumans(null, true) }}</span>
                                        </div>
                                        <div class="col-1">
                                            <div id="sitting-post" class="py-3 rounded-circle">
                                                <svg focusable="true" width="24" height="24" viewBox="0 0 24 24"
                                                    class=" NMm5M" style="fill:grey">
                                                    <path
                                                        d="M12 8c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z">
                                                    </path>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                    {{-- <a style="text-decoration: none; color:black; display: block" class="my-2" href="#">
                        <div class="card" style="  cursor: pointer;">
                            <div class="card-body">
                                <div class="row justify-content-center align-items-center g-2">
                                    <div class="col-1">
                                        <div style="width: 100%;color:white;" class="rounded-circle bg-success">
                                            <svg style="fill:white;" focusable="false" width="100%" height="60px"
                                                viewBox="0 0 24 24" class=" NMm5M hhikbc p-3">
                                                <path d="M7 15h7v2H7zm0-4h10v2H7zm0-4h10v2H7z"></path>
                                                <path
                                                    d="M19 3h-4.18C14.4 1.84 13.3 1 12 1c-1.3 0-2.4.84-2.82 2H5c-.14 0-.27.01-.4.04a2.008 2.008 0 0 0-1.44 1.19c-.1.23-.16.49-.16.77v14c0 .27.06.54.16.78s.25.45.43.64c.27.27.62.47 1.01.55.13.02.26.03.4.03h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-7-.25c.41 0 .75.34.75.75s-.34.75-.75.75-.75-.34-.75-.75.34-.75.75-.75zM19 19H5V5h14v14z">
                                                </path>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="col-10 px-4">
                                        <p style="margin:0;" class="card-text"><span>تم نشر مهمة دراسية جديدة من قبل
                                                Bader
                                                Halimi:</span> درجات الامتحان النهائي</p>
                                        <span style="color:grey;"><?= date('d/m/Y') ?></span>
                                    </div>
                                    <div class="col-1">
                                        <div id="sitting-post" class="py-3 rounded-circle">
                                            <svg focusable="true" width="24" height="24" viewBox="0 0 24 24"
                                                class=" NMm5M" style="fill:grey">
                                                <path
                                                    d="M12 8c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z">
                                                </path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    <a style="text-decoration: none; color:black; display: block" class="my-2" href="#">
                        <div class="card" style="  cursor: pointer;">
                            <div class="card-body">
                                <div class="row justify-content-center align-items-center g-2">
                                    <div class="col-1">
                                        <div style="width: 100%;color:white;" class="rounded-circle bg-success">
                                            <svg style="fill:white;" focusable="false" width="100%" height="60px"
                                                viewBox="0 0 24 24" class=" NMm5M hhikbc p-3">
                                                <path d="M7 15h7v2H7zm0-4h10v2H7zm0-4h10v2H7z"></path>
                                                <path
                                                    d="M19 3h-4.18C14.4 1.84 13.3 1 12 1c-1.3 0-2.4.84-2.82 2H5c-.14 0-.27.01-.4.04a2.008 2.008 0 0 0-1.44 1.19c-.1.23-.16.49-.16.77v14c0 .27.06.54.16.78s.25.45.43.64c.27.27.62.47 1.01.55.13.02.26.03.4.03h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-7-.25c.41 0 .75.34.75.75s-.34.75-.75.75-.75-.34-.75-.75.34-.75.75-.75zM19 19H5V5h14v14z">
                                                </path>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="col-10 px-4">
                                        <p style="margin:0;" class="card-text"><span>تم نشر مهمة دراسية جديدة من قبل
                                                Bader
                                                Halimi:</span> درجات الامتحان النهائي</p>
                                        <span style="color:grey;"><?= date('d/m/Y') ?></span>
                                    </div>
                                    <div class="col-1">
                                        <div id="sitting-post" class="py-3 rounded-circle">
                                            <svg focusable="true" width="24" height="24" viewBox="0 0 24 24"
                                                class=" NMm5M" style="fill:grey">
                                                <path
                                                    d="M12 8c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z">
                                                </path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a> --}}
                </div>

            </div>
        </div>
    </main>
@endsection
@push('scripts')
    <script>
        function copy(text) {
            var textarea = document.createElement("textarea");
            textarea.value = text;
            document.body.appendChild(textarea);
            textarea.select();
            document.execCommand("copy");
            document.body.removeChild(textarea);
        }
        // استهدف الزر بواسطة معرفه
        const button = document.getElementById('addTopicButton');
        const edit = document.getElementById('editTopicButton');

        // أضف الحدث onClick إلى الزر
        button.onclick = function() {
            // اكتب الوظيفة التي ترغب في تنفيذها هنا
            document.getElementById('addTopic').style.display = "none";
        };
        edit.onclick = function() {
            // اكتب الوظيفة التي ترغب في تنفيذها هنا
            document.getElementById('editTopic').style.display = "none";
        };

        function editChoise() {
            var selector = document.getElementById("selectTopic");
            if (selector.value == 'none') {
                document.getElementById("deleteTopicButton").classList.add('disabled');
                document.getElementById("editButton").classList.add('disabled');
                document.getElementById('TopicName').value = "";
                document.getElementById('deleteTopicID').value = "";
                return;
            } else {
                document.getElementById("deleteTopicButton").classList.remove('disabled');
                document.getElementById("editButton").classList.remove('disabled');
                document.getElementById('TopicName').value = selector.options[selector.selectedIndex].textContent.trim();
                document.getElementById('deleteTopicID').value = selector.value;
            }
        }
        // استهدف الزر بواسطة معرفه
        const button1 = document.getElementById('showTopic');
        const button2 = document.getElementById('editTopicButton2');

        // أضف الحدث onClick إلى الزر
        button1.onclick = function() {
            // اكتب الوظيفة التي ترغب في تنفيذها هنا
            document.getElementById('addTopic').style.display = "block";
        };
        button2.onclick = function() {
            // اكتب الوظيفة التي ترغب في تنفيذها هنا
            document.getElementById('editTopic').style.display = "block";
        };
    </script>
@endpush
