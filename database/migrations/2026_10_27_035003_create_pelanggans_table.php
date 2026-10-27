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
    Schema::create('pelanggan', function (Blueprint $table) {
    $table->id();
    $table->string('nama');
    $table->string('email')->nullable();
    $table->string('no_hp')->nullable();
    $table->text('alamat')->nullable();
    $table->date('tanggal_lahir')->nullable();
    $table->string('jenis_kelamin')->nullable();
    $table->string('level_member')->default('basic');
    $table->string('status')->default('aktif');
    $table->date('tanggal_bergabung')->nullable();
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelanggan');
    }
};
