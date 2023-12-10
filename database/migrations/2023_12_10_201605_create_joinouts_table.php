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
        Schema::create('joinouts', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->biginteger('user_id');
            $table->text('joinout_room_id');
            $table->text('class_id');
            $table->text('first_name');
            $table->text('last_name');
            $table->text('first_date');
            $table->text('last_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('joinouts');
    }
};
