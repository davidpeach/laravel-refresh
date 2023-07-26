<x-layout-design>
    <h1>{{ $article->title }}</h1>
    @unless($article->images->isEmpty())
        @foreach($article->images as $image)
            <img src="/storage/{{ $image->path }}" />
        @endforeach
    @endunless
    {!! $article->body !!}
</x-layout-design>
