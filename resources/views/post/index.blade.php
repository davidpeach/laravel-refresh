<x-layout>
    @foreach ($posts as $post)
        <a href="/posts/{{ $post->slug }}">
            {{ $post->title }}
        </a>
    @endforeach
</x-layout>
