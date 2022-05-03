<?php /** @var \App\Models\Machine $machine */?>
@props(['machine'])
<x-machine :machine="$machine">


<x-countdown :expires="$machine->ready_at">
    <span x-text="timer.hours">{{ $component->hours() }}</span>
    :
    <span x-text="timer.minutes">{{ $component->minutes() }}</span>
</x-countdown>
</x-machine>
