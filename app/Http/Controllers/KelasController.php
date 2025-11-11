<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        $semuaKelas = Kelas::all();
        return view('kelas.index', compact('semuaKelas'));
    }

    // CREATE (Form Tambah)
    public function create()
    {
        return view('kelas.create');
    }

    // STORE (Proses Simpan)
    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:100',
            'wali_kelas' => 'required|string|max:255',
        ]);

        Kelas::create([
            'nama_kelas' => $request->nama_kelas,
            'wali_kelas' => $request->wali_kelas,
        ]);

        return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil ditambahkan.');
    }

    // SHOW (Detail)
    public function show(Kelas $kelas)
    {
        $kelas->load('siswa');
        return view('kelas.show', compact('kelas'));
    }

    // EDIT (Form Ubah)
    public function edit(Kelas $kelas)
    {
        return view('kelas.edit', compact('kelas'));
    }

    // UPDATE (Proses Ubah)
    public function update(Request $request, Kelas $kelas)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:100',
            'wali_kelas' => 'required|string|max:255',
        ]);

        $kelas->update([
            'nama_kelas' => $request->nama_kelas,
            'wali_kelas' => $request->wali_kelas,
        ]);

        return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil diubah.');
    }

    // DELETE (Proses Hapus)
    public function destroy(Kelas $kelas)
    {
        $kelas->delete();
        return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil dihapus.');
    }
}
