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
        Schema::create('bounties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pembuat_id')->constrained('users');
            $table->foreignId('pengerja_id')->nullable()->constrained('users');
            $table->string('judul');
            $table->text('deskripsi');
            $table->string('kategori');
            $table->integer('budget');
            $table->integer('harga_deal')->nullable();
            $table->date('tenggat');
            $table->string('status')->default('terbuka');
            $table->string('hasil_link')->nullable();
            $table->text('hasil_catatan')->nullable();
            $table->string('kode_otp', 6)->nullable();
            $table->dateTime('otp_berlaku_sampai')->nullable();
            $table->unsignedTinyInteger('otp_salah')->default(0);
            $table->text('alasan_sengketa')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bounties');
    }
};
