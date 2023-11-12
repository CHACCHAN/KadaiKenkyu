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
        Schema::create('sankougi_chat_comments', function (Blueprint $table) {
            $table->bigIncrements('id')->uniqid();
            $table->bigInteger('chat_user_id');
            $table->bigInteger('chat_id');
            $table->longText('content');
            $table->text('image')->nullable()->comment('投稿ファイル');
            $table->bigInteger('good_count')->nullable()->comment('いいね数');
            $table->bigInteger('bad_count')->nullable()->comment('わるい数');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sankougi_chat_comments');
    }
};
