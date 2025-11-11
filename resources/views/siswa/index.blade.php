@extends('layouts.app')

@section('title', 'Data Siswa')

@section('content')
    <div class="max-w-7xl mx-auto mt-10">
        {{-- Header --}}
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-700">Daftar Siswa</h1>
            <div class="flex gap-3">
                <a href="{{ route('siswa.trash') }}"
                    class="bg-gray-600 text-white py-2 px-4 rounded-lg hover:bg-gray-700 transition">
                    🗑 Recycle Bin
                </a>
                <a href="{{ route('siswa.create') }}"
                    class="bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition">
                    + Tambah Siswa
                </a>
            </div>
        </div>

        {{-- Flash message --}}
        @if(session('success'))
            <div class="bg-green-100 text-green-700 px-4 py-2 rounded-md mb-4">
                {{ session('success') }}
            </div>
        @endif

        {{-- Table --}}
        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="w-full text-left">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="py-3 px-4 text-gray-600 font-semibold">Foto</th>
                        <th class="py-3 px-4 text-gray-600 font-semibold">NIS</th>
                        <th class="py-3 px-4 text-gray-600 font-semibold">Nama Lengkap</th>
                        <th class="py-3 px-4 text-gray-600 font-semibold">Kelas</th>
                        <th class="py-3 px-4 text-gray-600 font-semibold text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($semuaSiswa as $item)
                        <tr class="border-b hover:bg-gray-50">
                            {{-- Foto --}}
                            <td class="py-3 px-4">
                                <img src="{{ $item->foto ? asset($item->foto) : asset('images/default-avatar.png') }}"
                                    alt="{{ $item->nama_lengkap }}" class="w-12 h-12 rounded-md object-cover border shadow-sm">
                            </td>

                            {{-- Info utama --}}
                            <td class="py-3 px-4 font-mono">{{ $item->nis }}</td>
                            <td class="py-3 px-4 font-semibold text-gray-700">{{ $item->nama_lengkap }}</td>
                            <td class="py-3 px-4 text-gray-600">{{ $item->kelas->nama_kelas ?? '-' }}</td>

                            {{-- Aksi --}}
                            <td class="px-4 flex justify-center py-5">
                                <a href="{{ route('siswa.show', $item->id) }}"
                                    class="p-2 bg-blue-100 text-blue-600 rounded-s-xl hover:bg-blue-600 hover:text-white transition-all"
                                    title="Detail">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor" stroke-width="2">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8S1 12 1 12z" />
                                        <circle cx="12" cy="12" r="3" />
                                    </svg>
                                </a>

                                <a href="{{ route('siswa.edit', $item->id) }}"
                                    class="p-2 bg-yellow-100 text-yellow-600 hover:bg-yellow-500 hover:text-white transition-all"
                                    title="Edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor" stroke-width="2">
                                        <path d="M15.232 5.232a2.828 2.828 0 114 4L7.5 21H3v-4.5l12.232-12.268z" />
                                    </svg>
                                </a>

                                <form action="{{ route('siswa.destroy', $item->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin mau hapus data ini?')" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="p-2 bg-red-100 text-red-600 rounded-e-xl hover:bg-red-600 hover:text-white transition-all"
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
                    @empty
                        <tr>
                            <td colspan="5" class="py-3 px-4 text-center text-gray-500">Belum ada data siswa.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection