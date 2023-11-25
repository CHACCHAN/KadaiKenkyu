<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sankougi_chat_followers', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->text('chat_user_name_id')->comment('フォロワー先ID');
            $table->bigInteger('chat_user_id')->comment('フォロワーのID');
            $table->integer('follower_flag');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sankougi_chat_followers');
    }
};
