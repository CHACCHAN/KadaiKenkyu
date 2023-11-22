<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SankougiChatStampGroup;
use App\Models\SankougiChatStamp;

class StampSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SankougiChatStampGroup::create([
            'chat_user_id' => 1,
            'stamp_title' => 'かんちょうスタンプ',
            'stamp_content' => 'みんなのアイドルかんちょうの公式スタンプです',
            'offical' => true,
        ]);

        for($i = 1; $i <= 6; $i++)
        {
            SankougiChatStamp::create([
                'sankougi_chat_stamp_group_id' => 1,
                'image' => 'stamp' . $i . '.png',
            ]);
        }
    }
}
