@extends('layouts.app')

@section('title', 'Recycle Bin Kelas')

@section('content')

<div class="max-w-7xl mx-auto mt-10">

    <div class="flex justify-between items-center mb-5">
        <h1 class="text-2xl font-bold text-gray-700">🗑 Data Kelas Terhapus</h1>

        <a href="{{ route('kelas.index') }}"
            class="bg-gray-600 text-white py-2 px-4 rounded-lg hover:bg-gray-700 transition duration-200">
            ⬅ Kembali
        </a>
    </div>

    @if (session('success'))
        <div class="bg-green-100 text-green-700 px-4 py-2 rounded-md mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="w-full text-left">
            <thead class="bg-gray-100">
                <tr>
                    <th class="py-3 px-4 text-gray-600 font-semibold">Nama Kelas</th>
                    <th class="py-3 px-4 text-gray-600 font-semibold">Wali Kelas</th>
                    <th class="py-3 px-4 text-gray-600 font-semibold text-center">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($kelasTerhapus as $kls)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-3 px-4">{{ $kls->nama_kelas }}</td>
                        <td class="py-3 px-4">{{ $kls->wali_kelas }}</td>
                        <td class="py-3 px-4 flex gap-3 justify-center">

                            {{-- Restore --}}
                            <form action="{{ route('kelas.restore', $kls->id) }}" method="POST"
                                onsubmit="return confirm('Pulihkan data ini?')">
                                @csrf
                                @method('PATCH')
                                <button class="text-green-600 hover:text-green-800 font-medium">
                                    ♻ Restore
                                </button>
                            </form>

                            {{-- Delete Permanen --}}
                            <form action="{{ route('kelas.forceDelete', $kls->id) }}" method="POST"
                                onsubmit="return confirm('Hapus permanen data ini? Tindakan tidak dapat dibatalkan!')">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600 hover:text-red-800 font-medium">
                                    ❌ Delete Permanen
                                </button>
                            </form>

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="py-4 px-4 text-center text-gray-500">
                            Tidak ada data terhapus.
                        </td>
                    </tr>
                @endforelse
            </tbody>

        </table>
    </div>
</div>

@endsection
