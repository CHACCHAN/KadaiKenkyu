<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PickUp;

class PickUpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PickUp::create([
            'title' => 'プログラミングコンテスト全国二位！',
            'content' => '今年のプログラミングコンテストでCチームが全国二位になりました!',
            'type' => 'お知らせ',
            'image' => 'sample_header.jpeg',
        ]);
    }
}
