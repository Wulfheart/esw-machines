<?php

namespace App\Enums;

enum MachineStateEnum: string
{
    case Empty = 'empty';
    case Running = 'running';
    case Done = 'done';
}