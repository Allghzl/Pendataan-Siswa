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
    Schema::create('siswas', function (Blueprint $table) {
        $table->id();
        $table->string('nis')->unique();
        $table->string('nama');
        $table->string('jenis_kelamin');
        $table->text('alamat')->nullable();
        $table->date('tanggal_lahir')->nullable();
        $table->string('kelas'); 
        $table->string('wali_kelas');
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('siswas');
}

};
