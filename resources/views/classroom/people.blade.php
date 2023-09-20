@extends('layout.master')
@section('title', 'people')
@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-center g-2">
            <h1>{{ $classroom->name }} People</h1>
        </div>
        <div class="row justify-content-center align-items-center g-2">
            <div class="table-responsive">
                <x-alert name="success" class="alert-success"/>
                <x-alert name="error" class="alert-danger"/>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Role</th>
                            <th scope="col">joined at</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 0;
                        @endphp
                        @foreach ($classroom->users as $user)
                            <tr class="">
                                <td scope="row">{{ ++$i }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->pivot->role }}</td>
                                <td>{{ $user->pivot->created_at->diffForHumans() }}</td>
                                <td><form action="{{ route('classroom.people.destroy',['classroom'=>$classroom->id]) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                                    <button type="submit" class="btn btn-sm btn-danger">Remove</button>
                                </form></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
