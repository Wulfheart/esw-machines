<?php

namespace App\Models;

use App\Enums\MachineStateEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Machine extends Model
{
    // use HasFactory;

    protected $casts = [
        'ready_at' => 'datetime',
        'state' => MachineStateEnum::class,
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'ready_at'
    ];
}
