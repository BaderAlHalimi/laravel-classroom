<!doctype html>
<html lang="en">

<head>
    <title>@yield('title')</title>
    {{-- <title>@yield('title')</title> --}}
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
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
    </style>
</head>

<body>
    <header>
        <!-- place navbar here -->
        <nav class="navbar navbar-expand-sm navbar-light bg-light p-0">
            <div class="container">
                <a class="navbar-brand" href="{{ route('Classroom.index') }}">{{ Config::get('app.name') }}</a>

                <div class="collapse navbar-collapse" id="collapsibleNavId">
                    <ul class="navbar-nav ms-auto me-auto mt-2 mt-lg-0">
                        @if (isset($id))
                            <li class="nav-item pt-2">
                                <a class="nav-link active" href="{{ route('Classroom.show', ['id' => $id]) }}"
                                    aria-current="page">Sharing Square</a>
                            </li>
                            <li class="nav-item pt-2">
                                <a class="nav-link" href="#">Assignments</a>
                            </li>
                            <li class="nav-item pt-2">
                                <a class="nav-link" href="#">users</a>
                            </li>
                        @endif

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
</body>

</html>
