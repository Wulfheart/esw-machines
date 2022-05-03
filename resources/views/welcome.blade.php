<!DOCTYPE html>
<html lang="DE">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>ESW Waschmaschinen</title>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <script src="{{ asset(('js/app.js')) }}" defer></script>
    </head>
    <body class="bg-gray-100 p-5 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 ">
        <div class="md:flex md:items-center md:justify-between py-10">
            <div class="flex-1 min-w-0 flex flex-wrap items-baseline">
                <h2 class="text-3xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate mr-2">ESW Wäscheraum</h2>
                <p class="mt-1 text-sm text-gray-500 truncate">Letztes Update <x-carbon :date="$last_update" human></x-carbon></p>
            </div>
        </div>

        <ul role="list" class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 pb-12">
            @foreach($machines as $machine)
                <x-machine :machine="$machine"></x-machine>
            @endforeach
        </ul>
    </div>

    </body>
</html>
