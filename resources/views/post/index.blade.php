<x-layout>

    <form action"#" method="get">
        <input type="search" name="q" value="{{ request('q') }}" />
        <button type="submit">Search</button>
    </form>

    @foreach ($posts as $post)
        <h2>
        <a href="/posts/{{ $post->slug }}">
            {{ $post->title }}
        </a>
        </h2>
        <p>Posted in <a href="/?category={{ $post->category->slug }}">{{ $post->category->name }}</a></p>
        <time>{{ $post->published_at }}</time>
        <p>{{ $post->excerpt }}</p>
    @endforeach
</x-layout>
