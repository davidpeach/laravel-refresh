<x-layout-design>
    @foreach ($activities as $activity)
        <x-activity-excerpt :activity="$activity" />
    @endforeach

    {!! $activities->links() !!}
</x-layout-design>

