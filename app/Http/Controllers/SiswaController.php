<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;

class SiswaController extends Controller
{
    // Menampilkan semua data siswa
    public function index()
    {
        $semuaSiswa = Siswa::all();
        return view('siswa.index', ['siswa' => $semuaSiswa]);
    }

    // Form tambah data siswa
    public function create()
    {
        return view('siswa.create');
    }

    // Simpan data siswa baru
   public function store(Request $request)
{
    $request->validate([
        'nis' => 'required|numeric|unique:siswas,nis',
        'nama' => 'required',
        'jenis_kelamin' => 'required',
        'alamat' => 'required',
        'tanggal_lahir' => 'required|date',
        'kelas' => 'required',
        'wali_kelas' => 'required'
    ]);

    Siswa::create([
        'nis' => $request->nis,
        'nama' => $request->nama,
        'jenis_kelamin' => $request->jenis_kelamin,
        'alamat' => $request->alamat,
        'tanggal_lahir' => $request->tanggal_lahir,
        'kelas' => $request->kelas,
        'wali_kelas' => $request->wali_kelas,
    ]);

    return redirect()->route('siswa.index')
        ->with('success', 'Data siswa berhasil ditambahkan');
}


    // Form edit siswa berdasarkan id
    public function edit($id)
    {
        $siswa = Siswa::findOrFail($id);
        return view('siswa.edit', compact('siswa'));
    }

    // Update data siswa
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'kelas' => 'required',
            'nis' => 'required|numeric'
        ]);

        $siswa = Siswa::findOrFail($id);
        $siswa->update([
            'nama' => $request->nama,
            'kelas' => $request->kelas,
            'nis' => $request->nis,
        ]);

        return redirect()->route('siswa.index')
            ->with('success', 'Data siswa berhasil diperbarui');
    }

    public function show($id)
{
    $siswa = Siswa::findOrFail($id);
    return view('siswa.show', compact('siswa'));
}

    // Hapus data siswa
    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);
        $siswa->delete();

        return redirect()->route('siswa.index')
            ->with('success', 'Data siswa berhasil dihapus');
    }
}
