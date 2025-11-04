<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;
<<<<<<< HEAD
    protected $table = 'siswa';
=======
>>>>>>> d23261ab4ee51946393284d01f95edff4f38cc2f

    protected $fillable = [
        'nis',
        'nama',
        'jenis_kelamin',
        'alamat',
        'tanggal_lahir',
        'kelas',
        'wali_kelas'
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class,'kelas_id');
    }
}
