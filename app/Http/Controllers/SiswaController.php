<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Kelas;

class SiswaController extends Controller
{
    // 🔹 Menampilkan semua siswa
    public function index()
    {
        $semuaSiswa = Siswa::with('kelas')->get();
        return view('siswa.index', compact('semuaSiswa'));
    }

    // 🔹 Menampilkan detail siswa
    public function show($id)
    {
        $siswa = Siswa::with('kelas')->findOrFail($id);
        return view('siswa.detail', compact('siswa'));
    }

    // 🔹 Form tambah siswa
    public function create()
    {
        $semuaKelas = Kelas::all(['id', 'nama_kelas', 'wali_kelas']);
        return view('siswa.create', compact('semuaKelas'));
    }

    // 🔹 Simpan data siswa baru
    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required|numeric|unique:siswa,nis',
            'nama_lengkap' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'kelas_id' => 'required|exists:kelas,id',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:5120', // validasi tambahan
        ]);

        // Simpan data request ke array
        $data = $request->only([
            'nis',
            'nama_lengkap',
            'jenis_kelamin',
            'alamat',
            'tanggal_lahir',
            'kelas_id',
        ]);

        // Upload foto kalau ada
        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('public/foto_siswa');
            $data['foto'] = str_replace('public/', 'storage/', $path);
        }

        Siswa::create($data);

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil ditambahkan!');
    }

    // 🔹 Form edit siswa
    public function edit($id)
    {
        $siswa = Siswa::findOrFail($id);
        $semuaKelas = Kelas::all();
        return view('siswa.edit', compact('siswa', 'semuaKelas'));
    }

    // 🔹 Update siswa
    public function update(Request $request, $id)
    {
        $request->validate([
            'nis' => 'required|numeric',
            'nama_lengkap' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'kelas_id' => 'required|exists:kelas,id',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:5120', // validasi foto juga
        ]);

        $siswa = Siswa::findOrFail($id);

        $data = $request->only([
            'nis',
            'nama_lengkap',
            'jenis_kelamin',
            'alamat',
            'tanggal_lahir',
            'kelas_id',
        ]);

        if ($request->hasFile('foto')) {
            if ($siswa->foto && file_exists(public_path($siswa->foto))) {
                unlink(public_path($siswa->foto));
            }
            $path = $request->file('foto')->store('public/foto_siswa');
            $data['foto'] = str_replace('public/', 'storage/', $path);
        }

        $siswa->update($data);

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil diperbarui!');
    }

    // DELETE SISWA
    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);

        if ($siswa->foto && file_exists(public_path($siswa->foto))) {
            unlink(public_path($siswa->foto));
        }

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


