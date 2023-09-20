@props(['class', 'name'])

<div>
    <!-- No surplus words or unnecessary actions. - Marcus Aurelius -->
    @if (session()->has($name))
        <div class="alert {{ $class }}" role="alert">
            {{ session($name) }}
        </div>
    @endif

</div>
