<div class="row">
    <div class="col-md-8">
        <x-form-component name="title" label="title" value="{{ old('title', $classwork->title) }}" />

        <div class="form-floating mb-3">
            {{-- <textarea name="" id="" cols="30" rows="10"></textarea> --}}
            <textarea rows="5" @class(['form-control', 'is-invalid' => $errors->has('description')]) name="description" id="description">{{ old('description', $classwork->description) }}</textarea>
            <x-error-form name="description" message={{ $message }} />
        </div>

        <div>
            <button type="submit" class="btn btn-primary">submit</button>
        </div>

    </div>
    {{-- @dd($classwork->published_date) --}}
    <div class="col-md-4">
        <div class="form-floating mb-3">
            {{-- <textarea name="" id="" cols="30" rows="10"></textarea> --}}
            <input type="date" @class(['form-control', 'is-invalid' => $errors->has('published_at')]) name="published_at" id="published_at"
                placeholder="Publish Date" value="{{ old('published_at', $classwork->published_date ?? '') }}">
            <label for="published_at">Publish Date</label>
            <x-error-form name="published_at" message={{ $message }} />
        </div>
        <div>
            @foreach ($classroom->students as $user)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="{{ $user->id }}" name="students[]"
                        id="std-{{ $user->id }}" @checked(in_array($user->id, $assigned ?? [$user->id]))>
                    <label class="form-check-label" for="std-{{ $user->id }}">
                        {{ $user->name }}
                    </label>
                </div>
            @endforeach
        </div>
        @if ($type == 'assignment')
            <div class="form-floating mb-3">
                {{-- <textarea name="" id="" cols="30" rows="10"></textarea> --}}
                <input type="number" min="0" @class([
                    'form-control',
                    'is-invalid' => $errors->has('options.grade'),
                ]) name="options[grade]" id="grade"
                    placeholder="Grade" value="{{ old('options.grade', $classwork->options['grade'] ?? '') }}">
                <label for="grade">Grade</label>
                <x-error-form name="options.grade" message={{ $message }} />
            </div>
            <div class="form-floating mb-3">
                {{-- <textarea name="" id="" cols="30" rows="10"></textarea> --}}
                <input type="date" @class(['form-control', 'is-invalid' => $errors->has('options.due')]) name="options[due]" id="due"
                    placeholder="Due date" value="{{ old('options.due', $classwork->options['due'] ?? '') }}">
                <label for="due">Due date</label>
                <x-error-form name="options.due" message={{ $message }} />
            </div>
        @endif
        <div class="form-floating mb-3">
            {{-- <textarea name="" id="" cols="30" rows="10"></textarea> --}}
            <select rows="5" @class(['form-control', 'is-invalid' => $errors->has('topic_id')]) name="topic_id" placeholder="Topics" id="topic_id">
                <option value="">Select Topic</option>
                @foreach ($topics as $topic)
                    <option @selected($topic->id == $classwork->topic_id) value="{{ $topic->id }}">{{ $topic->name }}</option>
                @endforeach
            </select>
            <label for="topic_id">Topics</label>
            <x-error-form name="topic_id" message={{ $message }} />
        </div>
    </div>
</div>
@push('scripts')
    <script src="https://cdn.tiny.cloud/1/evqw8zgybaz9h1ukpi5qcps683qv0ef37icy3d3o5xjbo9it/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#description',
            plugins: 'ai tinycomments mentions anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed permanentpen footnotes advtemplate advtable advcode editimage tableofcontents mergetags powerpaste tinymcespellchecker autocorrect a11ychecker typography inlinecss',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | align lineheight | tinycomments | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
            mergetags_list: [{
                    value: 'First.Name',
                    title: 'First Name'
                },
                {
                    value: 'Email',
                    title: 'Email'
                },
            ],
            ai_request: (request, respondWith) => respondWith.string(() => Promise.reject(
                "See docs to implement AI Assistant"))
        });
    </script>
@endpush
