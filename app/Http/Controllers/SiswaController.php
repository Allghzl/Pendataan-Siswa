<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Kelas;
use Illuminate\Support\Facades\Storage;

class SiswaController extends Controller
{
    // ✅ Menampilkan semua siswa
    public function index()
    {
        $semuaSiswa = Siswa::with('kelas')->get();
        return view('siswa.index', compact('semuaSiswa'));
    }

    // ✅ Menampilkan detail siswa (support foto + kelas)
    public function show($id)
    {
        $siswa = Siswa::withTrashed()->with('kelas')->findOrFail($id);
        return view('siswa.detail', compact('siswa'));
    }

    public function create()
    {
        $semuaKelas = Kelas::all(['id', 'nama_kelas', 'wali_kelas']);
        return view('siswa.create', compact('semuaKelas'));
    }

    // ✅ Store siswa + upload foto
    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required|numeric|unique:siswa,nis',
            'nama_lengkap' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'kelas_id' => 'required|exists:kelas,id',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
        ]);

        $data = $request->only([
            'nis', 'nama_lengkap', 'jenis_kelamin', 'alamat', 'tanggal_lahir', 'kelas_id'
        ]);

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('public/foto_siswa');
            $data['foto'] = Storage::url($path);
        }

        Siswa::create($data);

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil ditambahkan!');
    }

    // ✅ Edit siswa
    public function edit($id)
    {
        $siswa = Siswa::findOrFail($id);
        $semuaKelas = Kelas::all();
        return view('siswa.edit', compact('siswa', 'semuaKelas'));
    }

    // ✅ Update + update foto baru
    public function update(Request $request, $id)
    {
        $request->validate([
            'nis' => 'required|numeric',
            'nama_lengkap' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'kelas_id' => 'required|exists:kelas,id',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
        ]);

        $siswa = Siswa::findOrFail($id);

        $data = $request->only([
            'nis', 'nama_lengkap', 'jenis_kelamin', 'alamat', 'tanggal_lahir', 'kelas_id'
        ]);

        if ($request->hasFile('foto')) {
            if ($siswa->foto) {
                Storage::delete(str_replace('/storage/', 'public/', $siswa->foto));
            }
            $path = $request->file('foto')->store('public/foto_siswa');
            $data['foto'] = Storage::url($path);
        }

        $siswa->update($data);

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil diperbarui!');
    }

    // ✅ Soft Delete
    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);
        $siswa->delete();
        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil dihapus!');
    }

    // ✅ Recycle Bin
    public function trash()
    {
        $siswaTerhapus = Siswa::onlyTrashed()->latest()->get();
        return view('siswa.trash', compact('siswaTerhapus'));
    }

    // ✅ Restore
    public function restore($id)
    {
        $siswa = Siswa::onlyTrashed()->findOrFail($id);
        $siswa->restore();
        return redirect()->route('siswa.trash')->with('success', 'Data berhasil direstore!');
    }

    // ✅ Delete Permanent
    public function forceDelete($id)
    {
        $siswa = Siswa::onlyTrashed()->findOrFail($id);

        if ($siswa->foto) {
            Storage::delete(str_replace('/storage/', 'public/', $siswa->foto));
        }

        $siswa->forceDelete();
        return redirect()->route('siswa.trash')->with('success', 'Data berhasil dihapus permanen!');
    }
}
