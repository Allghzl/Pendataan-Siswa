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
<<<<<<< HEAD:database/migrations/2025_11_04_041852_create_siswa_table.php
    {
        Schema::create('siswa', function (Blueprint $table) {
            $table->id();
            $table->string('nis')->unique();
            $table->string('nama_lengkap');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->text('alamat')->nullable();
            $table->date('tanggal_lahir')->nullable();
            // Ini adalah Foreign Key
            $table->foreignId('kelas_id')
                ->nullable() // Boleh null jika siswa belum punya kelas
                ->constrained('kelas') // Merujuk ke tabel 'kelas'
                ->onDelete('set null'); // Jika kelas dihapus, 'kelas_id' siswa jadi NULL
            $table->timestamps();
        });
    }
=======
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
>>>>>>> d23261ab4ee51946393284d01f95edff4f38cc2f:database/migrations/2025_11_04_041852_create_siswas_table.php

public function down(): void
{
    Schema::dropIfExists('siswas');
}

};
