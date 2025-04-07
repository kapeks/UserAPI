<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Position;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Position::insert([
            ['id' => 1, 'name' => 'Lawyer'],
            ['id' => 2, 'name' => 'Content manager'],
            ['id' => 3, 'name' => 'Security'],
            ['id' => 4, 'name' => 'Designer'],
        ]);
    }
}
