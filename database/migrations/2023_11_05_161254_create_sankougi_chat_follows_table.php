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
        Schema::create('sankougi_chat_follows', function (Blueprint $table) {
            $table->bigIncrements('id')->uniqid();
            $table->bigInteger('chat_user_id')->comment('フォロー先ID');
            $table->bigInteger('follow_id')->nullable()->comment('フォロー者ID');
            $table->bigInteger('follower_id')->nullable()->comment('フォロワー者ID');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sankougi_chat_follows');
    }
};
