@props([
    'activity'
])
<div>
    @switch($activity->type)
        @case('article')
            <h2>
                <a href="{{ $activity->permalink }}">{{ $activity->feedable->title }}</a>
            </h2>
            <time>{{ $activity->published_at }}</time>
            {!! $activity->feedable->excerpt !!}
            @unless($activity->feedable->images->isEmpty())
                @foreach($activity->feedable->images as $image)
                    <img src="/storage/{{ $image->path }}" />
                @endforeach
            @endunless
            @unless($activity->feedable->tags->isEmpty())
                <p>
                @foreach($activity->feedable->tags as $tag)
                    <a href="/tags/{{ $tag->slug }}">{{ $tag->title }}</a>,
                @endforeach
                </p>
            @endunless
            @break
        @case('note')
            <p>{{ $activity->feedable->body }} </p>
            @unless($activity->feedable->images->isEmpty())
                @foreach($activity->feedable->images as $image)
                    <img src="/storage/{{ $image->path }}" />
                @endforeach
            @endunless
            @unless($activity->feedable->tags->isEmpty())
                <p>
                @foreach($activity->feedable->tags as $tag)
                    <a href="/tags/{{ $tag->slug }}">{{ $tag->title }}</a>,
                @endforeach
                </p>
            @endunless
            @unless($activity->feedable->syndications->isEmpty())
                @foreach($activity->feedable->syndications as $syndication)
                    <p><a href="{{ $syndication->external_url }}">Syndicated</a></p>
                @endforeach
            @endunless

            <p>
            <a href="{{ $activity->permalink }}">
                <time>{{ $activity->published_at }}</time>
            </a>
            </p>
            @break
    @endswitch
</div>
