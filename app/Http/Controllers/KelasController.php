<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    // ✅ Menampilkan semua data kelas (kecuali yang terhapus)
    public function index()
    {
        $semuaKelas = Kelas::withoutTrashed()->get();
        return view('kelas.index', compact('semuaKelas'));
    }

    // ✅ Form Tambah
    public function create()
    {
        return view('kelas.create');
    }

    // ✅ Proses Tambah Kelas
    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:100',
            'wali_kelas' => 'required|string|max:255',
        ]);

        Kelas::create($request->only(['nama_kelas', 'wali_kelas']));

        return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil ditambahkan.');
    }

    // ✅ Detail kelas + siswa yang terkait
    public function show($id)
    {
        $kelas = Kelas::with('siswa')->withTrashed()->findOrFail($id);
        return view('kelas.show', compact('kelas'));
    }

    // ✅ Form Edit
    public function edit($id)
    {
        $kelas = Kelas::findOrFail($id);
        return view('kelas.edit', compact('kelas'));
    }

    // ✅ Update Data
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:100',
            'wali_kelas' => 'required|string|max:255',
        ]);

        $kelas = Kelas::findOrFail($id);
        $kelas->update($request->only(['nama_kelas', 'wali_kelas']));

        return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil diubah.');
    }

    // ✅ Soft Delete
    public function destroy($id)
    {
        $kelas = Kelas::findOrFail($id);
        $kelas->delete();

        return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil dihapus.');
    }

    // ✅ Halaman Recycle Bin
    public function trash()
    {
        $kelasTerhapus = Kelas::onlyTrashed()->get();
        return view('kelas.trash', compact('kelasTerhapus'));
    }

    // ✅ Restore
    public function restore($id)
    {
        $kelas = Kelas::onlyTrashed()->findOrFail($id);
        $kelas->restore();

        return redirect()->route('kelas.trash')->with('success', 'Data kelas berhasil dikembalikan!');
    }

    // ✅ Hapus Permanen + siswa yang terkait juga
    public function forceDelete($id)
    {
        $kelas = Kelas::onlyTrashed()->findOrFail($id);

        Siswa::where('kelas_id', $id)->forceDelete();

        $kelas->forceDelete();

        return redirect()->route('kelas.trash')->with('success', 'Data kelas berhasil dihapus permanen!');
    }
}
