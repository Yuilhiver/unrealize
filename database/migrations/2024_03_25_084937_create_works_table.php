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
        Schema::create('works', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('title', 25);
            $table->text('description');
            $table->string('shortDescription', 130);
            $table->foreignId('worktype_id')->references('id')->on('worktypes');
            $table->foreignId('workgenre_id')->references('id')->on('workgenres');
            $table->foreignId('version_id')->references('id')->on('versions');
            $table->string('additionalImgs',1024);
            $table->integer('rating', 0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('works');
    }
};
