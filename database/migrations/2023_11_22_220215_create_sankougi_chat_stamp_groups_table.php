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
        Schema::create('sankougi_chat_stamp_groups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('chat_user_id');
            $table->text('stamp_title');
            $table->text('stamp_content');
            $table->integer('offical')->comment('公式認定');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sankougi_chat_stamp_groups');
    }
};
