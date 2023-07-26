@props([
    'activity',
])
<h2>
    <a href="{{ $activity->permalink }}">{{ $activity->feedable->title }}</a>
</h2>
<time>{{ $activity->published_at }}</time>
{!! $activity->feedable->excerpt ?? $activity->feedable->body !!}
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
