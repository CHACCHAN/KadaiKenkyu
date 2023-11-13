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
        Schema::create('sankougi_chat_threads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('chat_user_id')->comment('所有者ID');
            $table->text('title');
            $table->longText('content');
            $table->text('image')->nullable();
            $table->bigInteger('join_count')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sankougi_chat_threads');
    }
};
