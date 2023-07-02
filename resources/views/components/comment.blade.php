@props(['comment'])

<article>
    <div>
        <img src="https://i.pravatar.cc/100?u={{ $comment->id }}" />
    </div>
    <div>
        <header>
            <h3>{{ $comment->author->username }}</h3>
            <p>{{ $comment->created_at }}</p>
        </header>
        {!! $comment->body !!}
    </div>
</article>

