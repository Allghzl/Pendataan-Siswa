@extends('layouts.app')

@section('title', 'Data Siswa')

@section('content')

<div class="max-w-7xl mx-auto mt-10">
    <div class="flex justify-between items-center mb-5">
        <h1 class="text-2xl font-bold text-gray-700">Daftar Siswa</h1>
        <a href="{{ route('siswa.create') }}"
            class="bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition duration-200">
            + Tambah Siswa
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 px-4 py-2 rounded-md mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="w-full text-left">
            <thead class="bg-gray-100">
                <tr>
                    <th class="py-3 px-4 text-gray-600 font-semibold">No</th>
                    <th class="py-3 px-4 text-gray-600 font-semibold">NIS</th>
                    <th class="py-3 px-4 text-gray-600 font-semibold">Nama Lengkap</th>
                    <th class="py-3 px-4 text-gray-600 font-semibold">Jenis Kelamin</th>
                    <th class="py-3 px-4 text-gray-600 font-semibold">Alamat</th>
                    <th class="py-3 px-4 text-gray-600 font-semibold">Tanggal Lahir</th>
                    <th class="py-3 px-4 text-gray-600 font-semibold">Kelas</th>
                    <th class="py-3 px-4 text-gray-600 font-semibold">Wali Kelas</th>
                    <th class="py-3 px-4 text-gray-600 font-semibold">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($siswa as $index => $item)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-3 px-4">{{ $index + 1 }}</td>
                        <td class="py-3 px-4">{{ $item->nis }}</td>
                        <td class="py-3 px-4">{{ $item->nama_lengkap }}</td>
                        <td class="py-3 px-4">{{ $item->jenis_kelamin }}</td>
                        <td class="py-3 px-4">{{ $item->alamat }}</td>
                        <td class="py-3 px-4">{{ $item->tanggal_lahir }}</td>
                        <td class="py-3 px-4">{{ $item->kelas }}</td>
                        <td class="py-3 px-4">{{ $item->wali_kelas }}</td>

                        <td class="py-3 px-4 flex gap-3">
                            <a href="{{ route('siswa.edit', $item->id) }}"
                               class="text-yellow-600 hover:text-yellow-800 font-medium">
                                Edit
                            </a>

                            <form action="{{ route('siswa.destroy', $item->id) }}" 
                                method="POST"
                                onsubmit="return confirm('Hapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="text-red-600 hover:text-red-800 font-medium">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="py-5 text-center text-gray-500">
                            Tidak ada data siswa.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
