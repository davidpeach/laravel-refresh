<x-layout>
    <h1>{{ $category->name }}</h1>
    @foreach ($category->posts as $post)
        <h2>
            <a href="/posts/{{ $post->slug }}">{{ $post->title }}</a>
        </h2>
    @endforeach
</x-layout>
