@extends('layouts.app')

@section('title', 'Data Kelas')

@section('content')
    <div class="max-w-7xl mx-auto mt-10">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-700">Daftar Kelas</h1>
            <a href="{{ route('kelas.create') }}"
                class="bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition">
                + Tambah Kelas
            </a>
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

                            {{-- Aksi --}}
                            <td class="py-3 px-4 flex justify-center">
                                {{-- Toggle --}}
                                <button @click="open = !open"
                                    class="p-2 bg-blue-100 text-blue-600 rounded-s-xl hover:bg-blue-600 hover:text-white transition"
                                    title="Lihat Siswa">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>

                                {{-- Edit --}}
                                <a href="{{ route('kelas.edit', $kelas->id) }}"
                                    class="p-2 bg-yellow-100 text-yellow-600 hover:bg-yellow-500 hover:text-white transition"
                                    title="Edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor" stroke-width="2">
                                        <path d="M15.232 5.232a2.828 2.828 0 114 4L7.5 21H3v-4.5l12.232-12.268z" />
                                    </svg>
                                </a>

                                {{-- Delete --}}
                                <form action="{{ route('kelas.destroy', $kelas->id) }}" method="POST"
                                    onsubmit="return confirm('Hapus data ini?')" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="p-2 bg-red-100 text-red-600 rounded-e-xl hover:bg-red-600 hover:text-white transition"
                                        title="Hapus">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
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