<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;   

class SiswaController extends Controller {
    public function index() {
        $semuaSiswa = Siswa::all();
        return view('siswa.index', ['siswa' => $semuaSiswa]);
    }
}
