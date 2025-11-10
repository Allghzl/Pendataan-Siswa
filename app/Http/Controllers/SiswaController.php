<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Kelas;

class SiswaController extends Controller
{
    // Menampilkan semua siswa
    public function index()
    {
        $semuaSiswa = Siswa::with('kelas')->get();
        return view('siswa.index', compact('semuaSiswa'));
    }

    // Form tambah siswa
    public function create()
    {
        $semuaKelas = Kelas::all(['id', 'nama_kelas', 'wali_kelas']);
        return view('siswa.create', compact('semuaKelas'));
    }

    // Simpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required|numeric|unique:siswa,nis',
            'nama_lengkap' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'kelas_id' => 'required|exists:kelas,id',
        ]);

        Siswa::create([
            'nis' => $request->nis,
            'nama_lengkap' => $request->nama_lengkap,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
            'tanggal_lahir' => $request->tanggal_lahir,
            'kelas_id' => $request->kelas_id,
        ]);

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil ditambahkan.');
    }

    // Edit siswa
    public function edit($id)
    {
        $siswa = Siswa::findOrFail($id);
        $semuaKelas = Kelas::all();
        return view('siswa.edit', compact('siswa', 'semuaKelas'));
    }

    // Update siswa
    public function update(Request $request, $id)
    {
        $request->validate([
            'nis' => 'required|numeric',
            'nama_lengkap' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'kelas_id' => 'required|exists:kelas,id',
        ]);

        $siswa = Siswa::findOrFail($id);
        $siswa->update($request->all());

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil diperbarui!');
    }

    // Hapus siswa
    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);
        $siswa->delete();

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil dihapus!');
    }

    public function restore($id)
    {
    $siswa = Siswa::onlyTrashed()->findOrFail($id);
    $siswa->restore();

    return redirect()->back()->with('success', 'Data berhasil direstore!');
    }

    public function forceDelete($id)
    {
    $siswa = Siswa::onlyTrashed()->findOrFail($id);
    $siswa->forceDelete();

    return redirect()->back()->with('success', 'Data berhasil dihapus permanen!');
    }

    public function trash()
    {
    $siswaTerhapus = Siswa::onlyTrashed()->get();

    return view('siswa.index', [
        'semuaSiswa' => Siswa::all(),
        'siswaTerhapus' => $siswaTerhapus
    ]);
    }

    public function show($id)
    {
    $siswa = Siswa::withTrashed()->findOrFail($id);
    return view('siswa.show', compact('siswa'));
    }


}


