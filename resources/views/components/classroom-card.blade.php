<?php use App\Models\classroom; ?>
<div class="card">
    <div class="card-header">
        <img style="width: 100%" src="{{ Storage::disk(Classroom::$disk)->url($item->cover_image_path) }}" alt="image">
    </div>
    {{-- <img class="card-img-top" src="holder.js/100x180/" alt="Title"> --}}
    <div class="card-body">
        <h4 class="card-title">{{ $item->name }} <sup><span class="badge bg-primary">New</span></sup></h4>
        <p class="card-text">{{ $item->section }}</p>
        <p class="card-text">{{ $item->subject }}</p>
        <p class="card-text">{{ $item->room }}</p>
        <p class="card-text">{{ $item->code }}</p>
        <a href="{{ route('classroom.show', ['id' => $item->id]) }}" class="btn btn-primary">{{ __("show") }}</a>
        <a href="{{ route('classroom.edit', ['id' => $item->id]) }}" class="btn btn-secondary">{{ __("edit") }}</a>
        <form style="display: inline-block;" method="post"
            action="{{ route('classroom.delete', ['id' => $item->id]) }}">
            @csrf
            @method('delete')
            <input type="submit" class="btn btn-danger" value="{{ __("delete") }}">
        </form>
    </div>
</div>
