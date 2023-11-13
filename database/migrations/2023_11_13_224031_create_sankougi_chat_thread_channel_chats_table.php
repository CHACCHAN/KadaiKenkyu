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
        Schema::create('sankougi_chat_thread_channel_chats', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('sankougi_chat_thread_channel_id');
            $table->bigInteger('chat_user_id')->comment('書込者ID');
            $table->longText('content');
            $table->text('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sankougi_chat_thread_channel_chats');
    }
};
