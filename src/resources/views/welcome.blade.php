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
    <body class="bg-gray-100 p-5">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 min-h-screen space-y-10">

        <ul role="list" class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
            @foreach($machines as $machine)
                @if($machine->state == \App\Enums\MachineStateEnum::Empty)
                    <x-machine.empty :machine="$machine"/>
                @endif
                @if($machine->state == \App\Enums\MachineStateEnum::Running)
                    <x-machine.running :machine="$machine"/>
                @endif
                @if($machine->state == \App\Enums\MachineStateEnum::Done)
                    <x-machine.done :machine="$machine"/>
                @endif
            @endforeach
        </ul>
    </div>

    </body>
</html>
