<x-layout-design>
    @foreach ($activities as $activity)
        <x-activity-excerpt :activity="$activity" />
    @endforeach
</x-layout-design>

