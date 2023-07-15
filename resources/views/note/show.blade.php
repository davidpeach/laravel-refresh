<x-layout-design>
    <p> {{ $note->body }} </p>
    @unless($note->images->isEmpty())
        @foreach($note->images as $image)
            <img src="/storage/{{ $image->path }}" />
        @endforeach
    @endunless
</x-layout-design>

