<!DOCTYPE html>
<html lang="DE">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>ESW Waschmaschinen</title>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <script src="{{ asset(('js/app.js')) }}"></script>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    </head>
    <body>
    @foreach($machines as $machine)
        {{ $machine->name }}
        @if($machine->state == \App\Enums\MachineStateEnum::Running)
            <x-countdown :expires="$machine->ready_at">
                <span x-text="timer.hours">{{ $component->hours() }}</span>
                :
                <span x-text="timer.minutes">{{ $component->minutes() }}</span>
            </x-countdown>

        @endif
    @endforeach

    </body>
</html>
