<?php

namespace App\Models;

use App\Enums\MachineStateEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Machine extends Model
{
    // use HasFactory;

    protected $casts = [
        'state' => MachineStateEnum::class,
    ];
}
