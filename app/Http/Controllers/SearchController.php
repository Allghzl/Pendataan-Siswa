<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __invoke(Request $request)
    {
        $term = trim($request->query('q', ''));

        if ($term === '') {
            return response()->json([
                'siswa' => [],
                'kelas' => [],
            ]);
        }

        $siswa = Siswa::query()
            ->with('kelas')
            ->where(function ($query) use ($term) {
                $query->where('nama_lengkap', 'like', "%{$term}%")
                    ->orWhere('nis', 'like', "%{$term}%");
            })
            ->orderBy('nama_lengkap')
            ->limit(5)
            ->get()
            ->map(function ($siswa) {
                return [
                    'id' => $siswa->id,
                    'nama' => $siswa->nama_lengkap,
                    'nis' => $siswa->nis,
                    'kelas' => $siswa->kelas->nama_kelas ?? '-',
                    'detail_url' => route('siswa.details', $siswa->id),
                ];
            });

        $kelas = Kelas::query()
            ->withCount('siswa')
            ->where(function ($query) use ($term) {
                $query->where('nama_kelas', 'like', "%{$term}%")
                    ->orWhere('wali_kelas', 'like', "%{$term}%");
            })
            ->orderBy('nama_kelas')
            ->limit(5)
            ->get()
            ->map(function ($kelas) {
                return [
                    'id' => $kelas->id,
                    'nama' => $kelas->nama_kelas,
                    'wali_kelas' => $kelas->wali_kelas,
                    'jumlah_siswa' => $kelas->siswa_count,
                    'detail_url' => route('kelas.show', $kelas->id),
                ];
            });

        return response()->json([
            'siswa' => $siswa,
            'kelas' => $kelas,
        ]);
    }
}
