<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\JoinOut;
use App\Models\JoinOutRoom;

class JoinOutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JoinOutRoom::create([
            'room' => '電子計算機実習室',
        ]);
        JoinOutRoom::create([
            'room' => '情報総合室',
        ]);
    }
}
