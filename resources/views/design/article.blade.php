<x-layout>
    <div>
        <p>
            <a href="/?category={{ $post->category->slug }}">{{ $post->category->name }}</a>
        </p>
        <h1 class="post-title">{{ $post->title }}</h1>
        <div>
            {!! $post->body !!}
        </div>
    </div>
    <section>
        @auth
        <x-comment-form :post="$post" />
        @endauth
        @foreach($post->comments as $comment)
        <x-comment :comment="$comment" />
        @endforeach
    </section>
</x-layout>

