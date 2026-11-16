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
        Schema::create('tawarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bounty_id')->constrained('bounties')->cascadeOnDelete();
            $table->foreignId('penawar_id')->constrained('users');
            $table->integer('harga');
            $table->unsignedSmallInteger('lama_hari');
            $table->text('catatan');
            $table->string('status')->default('menunggu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tawarans');
    }
};
