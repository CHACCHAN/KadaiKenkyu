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
        Schema::table('sankougi_chat_thread_channel_chats', function (Blueprint $table) {
            $table->text('stamp')->nullable()->after('image');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sankougi_chat_thread_channel_chats', function (Blueprint $table) {
            $table->dropColumn('stamp');
        });
    }
};
