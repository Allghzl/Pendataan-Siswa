@extends('layouts.app')

@section('title', 'Data Kelas')

@section('content')
    <div class="max-w-7xl mx-auto mt-10">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-700">Daftar Kelas</h1>

            <div class="flex gap-3">
                {{-- Tombol Recycle Bin --}}
                <a href="{{ route('kelas.trash') }}"
                    class="bg-gray-600 text-white py-2 px-4 rounded-lg hover:bg-gray-700 transition duration-200">
                    🗑 Recycle Bin
                </a>

                {{-- Tombol Tambah Kelas --}}
                <a href="{{ route('kelas.create') }}"
                    class="bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition">
                    + Tambah Kelas
                </a>
            </div>
        </div>

        {{-- Notifikasi --}}
        @if(session('success'))
            <div class="bg-green-100 text-green-700 px-4 py-2 rounded-md mb-4">
                {{ session('success') }}
            </div>
        @endif

        {{-- TABEL KELAS --}}
        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="w-full text-left">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="py-3 px-4 text-gray-600 font-semibold">No</th>
                        <th class="py-3 px-4 text-gray-600 font-semibold">Nama Kelas</th>
                        <th class="py-3 px-4 text-gray-600 font-semibold">Wali Kelas</th>
                        <th class="py-3 px-4 text-gray-600 font-semibold text-center">Aksi</th>
                    </tr>
                </thead>

                @forelse ($semuaKelas as $index => $kelas)
                    <tbody x-data="{ open: false }">
                        {{-- ROW UTAMA --}}
                        <tr class="border-b hover:bg-gray-50 transition">
                            <td class="py-3 px-4">{{ $index + 1 }}</td>
                            <td class="py-3 px-4 font-semibold text-gray-700">
                                {{ $kelas->nama_kelas }}
                            </td>
                            <td class="py-3 px-4 text-gray-600">
                                {{ $kelas->wali_kelas }}
                            </td>

                            <td class="py-3 px-4 flex gap-3">
                                <a href="{{ route('kelas.edit', $item->id) }}"
                                    class="text-yellow-600 hover:text-yellow-800 font-medium">
                                    Edit
                                </a>

                                <form action="{{ route('kelas.destroy', $item->id) }}" method="POST"
                                    onsubmit="return confirm('Hapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 font-medium">
                                        Hapus
                                    </button>
                                </form>

                            </td>
                        </tr>

                        {{-- ROW SISWA --}}
                        <tr x-show="open" x-transition x-cloak>
                            <td colspan="4" class="bg-gray-50 px-6 py-4">
                                @if ($kelas->siswa->isEmpty())
                                    <p class="text-gray-500 text-sm">Belum ada siswa di kelas ini.</p>
                                @else
                                    <div class="grid md:grid-cols-3 sm:grid-cols-2 gap-4">
                                        @foreach ($kelas->siswa as $siswa)
                                            <div
                                                class="flex items-center bg-white border rounded-lg shadow-sm p-3 hover:shadow-md transition">
                                                <img src="{{ $siswa->foto ? asset($siswa->foto) : '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user-round-icon lucide-user-round"><circle cx="12" cy="8" r="5"/><path d="M20 21a8 8 0 0 0-16 0"/></svg>'}}"
                                                    alt="{{ $siswa->nama_lengkap }}"
                                                    class="w-10 h-10 rounded-md object-cover border mr-3">
                                                <div>
                                                    <p class="font-semibold text-gray-800">{{ $siswa->nama_lengkap }}</p>
                                                    <p class="text-sm text-gray-500">{{ $siswa->nis }}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                @empty
                    <tbody>
                        <tr>
                            <td colspan="4" class="py-4 text-center text-gray-500">
                                Tidak ada data kelas tersedia.
                            </td>
                        </tr>
                    </tbody>
                @endforelse
            </table>
        </div>
    </div>
@endsection