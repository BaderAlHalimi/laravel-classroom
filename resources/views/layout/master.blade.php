<!doctype html>
<html dir="{{ App::isLocale('ar') ? 'rtl' : 'ltr' }}" lang="{{ App::currentLocale() }}">

<head>
    <title>@yield('title', config('app.name'))</title>
    {{-- <title>@yield('title')</title> --}}
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="{{ Storage::disk('uploads')->url('icon.png') }}">

    <!-- Bootstrap CSS v5.2.1 -->
    @if (App::isLocale('ar'))
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.rtl.min.css"
            integrity="sha384-PRrgQVJ8NNHGieOA1grGdCTIt4h21CzJs6SnWH4YMQ6G5F5+IEzOHz67L4SQaF0o" crossorigin="anonymous">
    @else
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    @endif
    <style>
        .active {
            border-bottom: 2px solid green;
        }

        .nav-item:first-child:hover {
            background-color: rgba(0, 128, 0, 0.266);
            transition: 0.5s;
        }

        .nav-item:hover {
            background-color: rgba(122, 122, 122, 0.439);
            transition: 0.5s;
        }

        .light-gray-bg {
            background-color: #f8f8f8;
            /* Light gray color code */
        }
    </style>
    @stack('styles')
</head>

<body>
    <header>
        <!-- place navbar here -->
        <nav class="navbar navbar-expand-sm navbar-light bg-light {{ !isset($id) ? 'pt-3 pb-2' : '' }}">
            <div class="container">
                <a class="navbar-brand" href="{{ route('classroom.index') }}">{{ Config::get('app.name') }}</a>

                <div class="collapse navbar-collapse" id="collapsibleNavId">
                    <ul class="navbar-nav ms-auto me-auto mt-2 mt-lg-0">
                        @if ($id = $classroom->id ?? ($id ?? null))
                            <li class="nav-item pt-2">
                                <a class="nav-link active" href="{{ route('classroom.show', ['id' => $id]) }}"
                                    aria-current="page">Sharing Square</a>
                            </li>
                            <li class="nav-item pt-2">
                                <a class="nav-link"
                                    href="{{ route('classroom.classwork.index', ['classroom' => $id]) }}">Classwork</a>
                            </li>
                            <li class="nav-item pt-2">
                                <a class="nav-link"
                                    href="{{ route('classroom.people', ['classroom' => $id]) }}">users</a>
                            </li>
                        @endif
                        <x-user-notifications-menu count="5" />
                    </ul>
                    <div class="d-flex my-2 my-lg-0">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                    </div>
                </div>
            </div>
        </nav>
        <br>
    </header>
    @yield('content')
    <footer>
        <!-- place footer here -->
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
        integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
    <script>
        var classroomId;
        const userId = "{{ Auth::id() }}";
    </script>
    @stack('scripts')
    @vite(['resources/js/app.js'])
</body>

</html>
