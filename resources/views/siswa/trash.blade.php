@extends('layouts.app')

@section('title', 'Recycle Bin Siswa')

@section('content')
<div class="max-w-7xl mx-auto mt-10">
    
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold text-gray-700">Recycle Bin Siswa</h1>
        <a href="{{ route('siswa.index') }}"
            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
            ⬅ Kembali
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="w-full text-left">
            <thead class="bg-red-100">
                <tr>
                    <th class="py-3 px-4">Nama Lengkap</th>
                    <th class="py-3 px-4">Dihapus Pada</th>
                    <th class="py-3 px-4">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($siswaTerhapus as $item)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-3 px-4">{{ $item->nama_lengkap }}</td>
                        <td class="py-3 px-4">{{ $item->deleted_at->format('d F Y H:i') }}</td>

                        <td class="py-3 px-4 flex gap-3">
                            {{-- Restore --}}
                            <form action="{{ route('siswa.restore', $item->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="text-green-600 hover:text-green-800 font-medium">
                                    ♻ Restore
                                </button>
                            </form>

                            {{-- Force Delete --}}
                            <form action="{{ route('siswa.forceDelete', $item->id) }}" method="POST"
                                onsubmit="return confirm('Hapus permanen data ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 font-medium">
                                    ❌ Hapus Permanen
                                </button>
                            </form>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="py-3 px-4 text-center text-gray-500">
                            Tidak ada data terhapus
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
