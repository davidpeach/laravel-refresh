<x-layout-design>
    @foreach($tags as $tag)
        <a href="/tags/{{ $tag->slug }}">{{ $tag->title }}</a>,
    @endforeach
</x-layout-design>
