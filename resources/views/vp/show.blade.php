<x-layout-design>
    <h1>{{ $photo->title }}</h1>
    @unless($photo->images->isEmpty())
        @foreach($photo->images as $image)
            <img src="/storage/{{ $image->path }}" />
        @endforeach
    @endunless
    {!! $photo->body !!}
</x-layout-design>

