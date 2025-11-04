<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswa';
    protected $fillable = [
        'nis',
        'nama_lengkap',
        'jenis_kelamin',
        'alamat',
        'tanggal_lahir',
        'kelas_id',
    ];

    public function kelas()
    {
<<<<<<< HEAD
        return $this->belongsTo(Kelas::class);
=======
        return $this->belongsTo(Kelas::class, 'kelas_id');
>>>>>>> 9cf48cc3b17dbf079021ede6b846e43f3aafbfd0
    }
}
