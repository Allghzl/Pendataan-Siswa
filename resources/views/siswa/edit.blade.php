@extends('layouts.app')

@section('title', 'Edit Data Siswa')

@section('content')

<div class="max-w-3xl mx-auto mt-10 bg-white shadow-md p-6 rounded-lg">
    <h1 class="text-2xl font-bold text-gray-700 mb-5">Edit Data Siswa</h1>

    <form action="{{ route('siswa.update', $siswa->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block font-semibold text-gray-700">NIS</label>
            <input type="text" name="nis" value="{{ $siswa->nis }}" 
                class="w-full border-gray-300 rounded-md" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold text-gray-700">Nama Lengkap</label>
            <input type="text" name="nama" value="{{ $siswa->nama }}" 
                class="w-full border-gray-300 rounded-md" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold text-gray-700">Jenis Kelamin</label>
            <select name="jenis_kelamin" class="w-full border-gray-300 rounded-md" required>
                <option value="Laki-Laki" {{ $siswa->jenis_kelamin == 'Laki-Laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="Perempuan" {{ $siswa->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>

        <div class="mb-4">
            <label class="block font-semibold text-gray-700">Alamat</label>
            <textarea name="alamat" class="w-full border-gray-300 rounded-md">{{ $siswa->alamat }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block font-semibold text-gray-700">Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" value="{{ $siswa->tanggal_lahir }}" 
                class="w-full border-gray-300 rounded-md">
        </div>

         <div class="mb-4">
            <label class="block font-semibold text-gray-700">Kelas</label>
            <input type="text" name="kelas" value="{{ $siswa->kelas }}" 
                class="w-full border-gray-300 rounded-md">
        </div>

        <div class="mb-4">
            <label class="block font-semibold text-gray-700">Wali Kelas</label>
            <input type="text" name="wali_kelas" value="{{ $siswa->wali_kelas }}" 
                class="w-full border-gray-300 rounded-md">
        </div>

        <div class="flex justify-between mt-6">
            <a href="{{ route('siswa.index') }}" class="bg-gray-500 text-white py-2 px-4 rounded-lg hover:bg-gray-600">
                Kembali
            </a>

            <button type="submit" class="bg-green-600 text-white py-2 px-4 rounded-lg hover:bg-green-700">
                Update Data
            </button>
        </div>

    </form>
</div>

@endsection
