@extends('layout.master')
@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-center g-2">
            <h1>{{ $classroom->name }}</h1>
            <h4>{{ $classroom->section }}</h4>
            @can('classworks.create', [$classroom])
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        + create
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item"
                                href="{{ route('classroom.classwork.create', ['classroom' => $classroom->id, 'type' => 'assignment']) }}">Assignment</a>
                        </li>
                        <li><a class="dropdown-item"
                                href="{{ route('classroom.classwork.create', ['classroom' => $classroom->id, 'type' => 'material']) }}">Material</a>
                        </li>
                        <li><a class="dropdown-item"
                                href="{{ route('classroom.classwork.create', ['classroom' => $classroom->id, 'type' => 'question']) }}">Question</a>
                        </li>
                    </ul>
                </div>
            @endcan

        </div>
        <hr>
        <div class="row justify-content-center align-items-center g-2">
            <div class="accordion" id="accordionExample">
                {{-- @forelse($classworks as $j => $gdh) --}}
                <div class="card mb-3">
                    <div class="card-body">
                        <form action="{{ URL::current() }}" method="get" class="row">
                            <div class="col-11">
                                <input type="text" name="search" id="search" class="form-control"
                                    placeholder="Search...">
                            </div>
                            <div class="col-1">
                                <button type="submit" class="btn btn-primary">Find</button>
                            </div>
                        </form>
                        {{-- <h4>{{ $gdh->first()->topic->name ?? 'public topic' }}</h4> --}}
                        <hr>
                        @php
                            $j = 0;
                        @endphp
                        @foreach ($classworks as $i => $classwork)
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapse{{ ++$j . 'o' . $i }}" aria-expanded="true"
                                        aria-controls="collapse{{ $j . 'o' . $i }}">
                                        {{ $classwork->title }}
                                    </button>
                                </h2>
                                <div id="collapse{{ $j . 'o' . $i }}" class="accordion-collapse collapse"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row justify-content-center align-items-center g-2">
                                            <div class="col-10">
                                                <div class="row justify-content-center align-items-center g-2">
                                                    <div class="col-6">
                                                        {!! $classwork->description !!}
                                                    </div>
                                                    <div class="col-6 row">
                                                        <div class="col-4">
                                                            <div class="fs-3">
                                                                {{ $classwork->assigned_count }}
                                                            </div>
                                                            <br>
                                                            <div class="text-muted">
                                                                {{ __('Assigned') }}
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="fs-3">
                                                                {{ $classwork->turnedin_count }}
                                                            </div>
                                                            <br>
                                                            <div class="text-muted">
                                                                {{ __('Turned in') }}
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="fs-3">
                                                                {{ $classwork->graded_count }}
                                                            </div>
                                                            <br>
                                                            <div class="text-muted">
                                                                {{ __('Graded') }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <a href="{{ route('classroom.classwork.show', ['classroom' => $classroom->id, 'classwork' => $classwork->id]) }}"
                                                    class="btn btn-secondary ms-auto">View</a>
                                                <a href="{{ route('classroom.classwork.edit', ['classroom' => $classroom->id, 'classwork' => $classwork->id]) }}"
                                                    class="btn btn-outline-secondary ms-auto">edit</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        {{ $classworks->withQueryString()->appends(['v' => 1])->links() }}
                    </div>
                </div>
                {{-- @empty
                    <center>
                        <p>No classworks found</p>
                    </center>
                @endforelse --}}

            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        classroomId = "{{ $classworks->first()->classroom_id ?? '' }}";
    </script>
@endpush
