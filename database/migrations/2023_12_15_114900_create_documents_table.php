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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('docname');
            $table->string('status');
            $table->unsignedBigInteger('review_leader_id')->nullable();
            $table->unsignedBigInteger('reviewer1_id')->nullable();
            $table->unsignedBigInteger('reviewer2_id')->nullable();
            $table->unsignedBigInteger('reviewer3_id')->nullable();
            $table->unsignedBigInteger('user_id');

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('review_leader_id')->references('id')->on('users');
            $table->foreign('reviewer1_id')->references('id')->on('users');
            $table->foreign('reviewer2_id')->references('id')->on('users');
            $table->foreign('reviewer3_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
