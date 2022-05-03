<?php

namespace Database\Seeders;

use App\Models\Machine;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $names = [
            'Waschmaschine 1',
            'Waschmaschine 2',
            'Waschmaschine 3',
            'Trockner 4',
            'Trockner 5',
        ];

        foreach ($names as $name) {
            Machine::create(['name' => $name]);
        }
    }
}
