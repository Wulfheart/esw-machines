<?php

namespace App\Http\Controllers;

use App\Enums\MachineStateEnum;
use App\Models\Machine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MachineController extends Controller
{
    public function showAll(Request $request) {
        Machine::where('ready_at', '<', now())->get()->each(fn(Machine $m) => $this->markMachineAsFinished($m));
        $machines = Machine::all();
        return view('welcome', [
            'machines' => $machines,
        ]);

    }
    public function start(Request $request, Machine $machine){
        if($machine->state !== MachineStateEnum::Empty) {
            return redirect()->to(route('home'));
        }
        $request->validate([
            'time' => ['required', 'int', 'gt:0'],
        ]);

        $machine->state = MachineStateEnum::Running;
        $machine->ready_at = now()->addMinutes($request->get('time'));
        $machine->save();
        return redirect(route('home'));
    }

    public function finish(Request $request, Machine $machine) {
        if($machine->state !== MachineStateEnum::Running) {
            return redirect()->to(route('home'));
        }

        $this->markMachineAsFinished($machine);

        return redirect(route('home'));
    }

    public function empty(Request $request, Machine $machine) {
        if($machine->state !== MachineStateEnum::Done) {
            return redirect()->to(route('home'));
        }

        $machine->state = MachineStateEnum::Empty;
        $machine->save();

        return redirect(route('home'));
    }

    protected function markMachineAsFinished(Machine $machine): void {
        $machine->state = MachineStateEnum::Done;
        $machine->ready_at = null;
        $machine->save();
    }
}
