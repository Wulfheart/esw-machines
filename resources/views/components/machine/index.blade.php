<?php /** @var \App\Models\Machine $machine */?>
@props(['machine'])

<li class="col-span-1 flex flex-col text-center bg-white rounded-lg shadow divide-y divide-gray-200">
    <div @class([
        'w-full h-4 rounded-t-lg',
        'bg-green-500' => $machine->state === \App\Enums\MachineStateEnum::Empty,
        'bg-red-500' => $machine->state === \App\Enums\MachineStateEnum::Running,
        'bg-yellow-500' => $machine->state === \App\Enums\MachineStateEnum::Done,
])></div>
    <div class="flex-1 flex flex-col p-8">
{{--        <img class="w-32 h-32 flex-shrink-0 mx-auto rounded-full" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=4&w=256&h=256&q=60" alt="">--}}
        <h3 class="mt-6 text-gray-900 font-medium">{{ $machine->name }}</h3>
        <dl class="mt-1 flex-grow flex flex-col justify-between">
            <dd class="">
                <span @class([
                    'px-2 py-1 text-xs font-medium rounded-full',
                    'text-green-800  bg-green-100' => $machine->state === \App\Enums\MachineStateEnum::Empty,
                    'text-red-800  bg-red-100' => $machine->state === \App\Enums\MachineStateEnum::Running,
                    'text-yellow-800  bg-yellow-100' => $machine->state === \App\Enums\MachineStateEnum::Done,
                ])>
                    @if($machine->state === \App\Enums\MachineStateEnum::Empty)
                        Frei
                    @endif
                    @if($machine->state === \App\Enums\MachineStateEnum::Running)
                            Läuft
                    @endif
                    @if($machine->state === \App\Enums\MachineStateEnum::Done)
                            Fertig
                    @endif
                </span>
            </dd>
            <dd class="text-gray-500 text-sm mt-3">
                @if($machine->state === \App\Enums\MachineStateEnum::Running)
                    <x-countdown :expires="$machine->ready_at">
                        <span x-text="timer.hours">{{ $component->hours() }}</span>
                        :
                        <span x-text="timer.minutes">{{ $component->minutes() }}</span>
                    </x-countdown>
                @else
                    {{-- Just there so there is no shift if a countdown is added --}}
                    <x-countdown :expires="now()" class="invisible">
                        <span x-text="timer.hours">{{ $component->hours() }}</span>
                        :
                        <span x-text="timer.minutes">{{ $component->minutes() }}</span>
                    </x-countdown>
                @endif
            </dd>
        </dl>
    </div>
    <div>
        <div class="flex">
            @if($machine->state === \App\Enums\MachineStateEnum::Empty)
                <form class="w-0 flex-1 flex" method="POST" action="{{ route('machine.start', $machine) }}">
                    <select name="time" id="dfg " class="w-1/2 text-center" >
                        <option value="{{ 0.5 * \Carbon\Carbon::MINUTES_PER_HOUR }}">0:30</option>
                        <option value="{{ 1 * \Carbon\Carbon::MINUTES_PER_HOUR }}">1:00</option>
                        <option value="{{ 1.5 * \Carbon\Carbon::MINUTES_PER_HOUR }}">1:30</option>
                        <option value="{{ 2 * \Carbon\Carbon::MINUTES_PER_HOUR }}" selected>2:00</option>
                        <option value="{{ 2.5 * \Carbon\Carbon::MINUTES_PER_HOUR }}">2:30</option>
                        <option value="{{ 3 * \Carbon\Carbon::MINUTES_PER_HOUR }}">3:00</option>
                        <option value="{{ 3.5 * \Carbon\Carbon::MINUTES_PER_HOUR }}">3:30</option>
                    </select>
                    @csrf
                    <button type="submit" class="relative -mr-px w-0 flex-1 inline-flex items-center justify-center py-4 text-sm text-gray-700 font-medium border border-transparent rounded-bl-lg hover:text-gray-500">
                        Starten
                    </button>
                </form>
            @endif
            @if($machine->state === \App\Enums\MachineStateEnum::Running)
                    <form class="w-0 flex-1 flex" method="POST" action="{{ route('machine.done', $machine) }}">
                        @csrf
                        <button type="submit" class="relative -mr-px w-0 flex-1 inline-flex items-center justify-center py-4 text-sm text-gray-700 font-medium border border-transparent rounded-bl-lg hover:text-gray-500">
                            Abbrechen
                        </button>
                    </form>
            @endif
            @if($machine->state === \App\Enums\MachineStateEnum::Done)
                    <form class="w-0 flex-1 flex" method="POST" action="{{ route('machine.empty', $machine) }}">
                        @csrf
                        <button type="submit" class="relative -mr-px w-0 flex-1 inline-flex items-center justify-center py-4 text-sm text-gray-700 font-medium border border-transparent rounded-bl-lg hover:text-gray-500">
                            Maschine geleert
                        </button>
                    </form>
            @endif
{{--            <div class="-ml-px w-0 flex-1 flex">--}}
{{--                <a href="tel:+1-202-555-0170" class="relative w-0 flex-1 inline-flex items-center justify-center py-4 text-sm text-gray-700 font-medium border border-transparent rounded-br-lg hover:text-gray-500">--}}
{{--                    <!-- Heroicon name: solid/phone -->--}}

{{--                    Call--}}
{{--                </a>--}}
{{--            </div>--}}
        </div>
    </div>
</li>
