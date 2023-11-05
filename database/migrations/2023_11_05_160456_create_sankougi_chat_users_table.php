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
        Schema::create('sankougi_chat_users', function (Blueprint $table) {
            $table->bigIncrements('chat_user_id')->uniqid();
            $table->bigInteger('user_id');
            $table->text('content')->nullable()->comment('自己紹介');
            $table->bigInteger('follow_count')->nullable()->comment('フォロー数');
            $table->bigInteger('follower_count')->nullable()->comment('フォロワー数');
            $table->text('image_header')->nullable()->comment('ヘッダー画像');
            $table->text('image_avatar')->nullable()->comment('アバター画像');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sankougi_chat_users');
    }
};
