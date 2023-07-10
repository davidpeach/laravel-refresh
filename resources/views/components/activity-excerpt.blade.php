@props([
    'activity'
])
<div>
    @switch($activity->type)
        @case('article')
            <h2>
                <a href="{{ $activity->permalink }}">{{ $activity->feedable->title }}</a>
            </h2>
            {!! $activity->feedable->excerpt !!}
            @break
        @case('note')
            {!! $activity->feedable->body !!}
            <a href="{{ $activity->permalink }}">
                <time>{{ $activity->created_at->format('d M -- Y') }}</time>
            </a>
            @break
    @endswitch
</div>
