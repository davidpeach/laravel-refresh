@props([
    'activity',
])
<h2>
    <a href="{{ $activity->permalink }}">
        {{ $activity->feedable->title }}
    </a>
</h2>
{!! $activity->feedable->excerpt !!}
@unless($activity->feedable->images->isEmpty())
    @foreach($activity->feedable->images as $image)
        <img src="/storage/{{ $image->path }}" />
    @endforeach
@endunless
@unless($activity->tags->isEmpty())
    <p>
        @foreach($activity->tags as $tag)
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
