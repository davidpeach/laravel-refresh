<x-layout-design>
    {!! $note->body !!}
    @unless($note->images->isEmpty())
        @foreach($note->images as $image)
            <img src="/storage/{{ $image->path }}" />
        @endforeach
    @endunless
</x-layout-design>

