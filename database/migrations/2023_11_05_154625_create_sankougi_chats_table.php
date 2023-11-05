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
        Schema::create('sankougi_chats', function (Blueprint $table) {
            $table->bigIncrements('chat_id')->uniqid();
            $table->bigInteger('chat_user_id')->comment('作った人ChatUserID');
            $table->longText('title')->comment('投稿タイトル');
            $table->longText('content')->comment('投稿コンテンツ');
            // ファイルは最大5枚まで投稿可能にする
            $table->text('image')->nullable()->comment('投稿ファイル');
            $table->text('image_two')->nullable()->comment('投稿ファイル2');
            $table->text('image_three')->nullable()->comment('投稿ファイル3');
            $table->text('image_four')->nullable()->comment('投稿ファイル4');
            $table->text('image_five')->nullable()->comment('投稿ファイル5');
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
        Schema::dropIfExists('sankougi_chats');
    }
};
