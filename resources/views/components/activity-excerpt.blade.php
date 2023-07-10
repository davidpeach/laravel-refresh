@props([
    'activity'
])
<div>
    @if ($activity->feedable->title)
    <h2>{{ $activity->feedable->title }}</h2>
    @endif

    {!! $activity->feedable->body !!}
</div>
