<x-layout>
    <p>
        <a href="/?category={{ $post->category->slug }}">{{ $post->category->name }}</a>
    </p>
    <h1 class="post-title">{{ $post->title }}</h1>
    <div>
        {!! $post->body !!}
    </div>
</x-layout>