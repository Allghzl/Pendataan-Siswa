<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        $dataKelas = Kelas::all();
        return view('kelas.index', ['semuaKelas' => $dataKelas]);
    }
    // CREATE (Form Tambah)
    public function create()
    {
        return view('kelas.create');
    }
    // STORE (Proses Simpan)
    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'nama_kelas' => 'required|string|max:100',
            'wali_kelas' => 'required|string|max:255',
        ]);
        // Simpan ke database
        Kelas::create($request->all());
        return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil
ditambahkan.');
    }
    // SHOW (Detail) - Boleh diskip jika tidak perlu
    public function show(Kelas $kela) // $kela adalah variabel dari model binding
    {
        //
    }
    // EDIT (Form Ubah)
    public function edit(Kelas $kela) // Otomatis find $id
    {
        return view('kelas.edit', ['kelas' => $kela]);
    }
    // UPDATE (Proses Ubah)
    public function update(Request $request, Kelas $kela)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:100',
            'wali_kelas' => 'required|string|max:255',
        ]);
        // Update data
        $kela->update($request->all());
        return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil
diubah.');
    }
    // DELETE (Proses Hapus)
    public function destroy(Kelas $kela)
    {
        // Hapus data
        $kela->delete();
        return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil
dihapus.');
    }
}
