@extends('layouts.app')

@section('title', 'Tambah Data Siswa')

@section('content')
<div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md mt-10">
    <h2 class="text-2xl font-bold mb-5 text-gray-800 text-center">Tambah Data Siswa</h2>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc ml-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('siswa.store') }}" method="POST">
    @csrf

    <div class="mb-4">
        <label class="block text-gray-700 mb-2">NIS</label>
        <input type="number" name="nis" value="{{ old('nis') }}"
            class="w-full border rounded px-3 py-2"
            placeholder="Masukkan NIS Siswa" required>
    </div>

    <div class="mb-4">
        <label class="block text-gray-700 mb-2">Nama Siswa</label>
        <input type="text" name="nama" value="{{ old('nama') }}"
            class="w-full border rounded px-3 py-2"
            placeholder="Masukkan Nama Siswa" required>
    </div>

    <div class="mb-4">
        <label class="block text-gray-700 mb-2">Jenis Kelamin</label>
        <input type="text" name="jenis_kelamin" value="{{ old('jenis_kelamin') }}"
            class="w-full border rounded px-3 py-2"
            placeholder="Laki Laki / Perempuan" required>
    </div>

    <div class="mb-4">
        <label class="block text-gray-700 mb-2">Alamat</label>
        <input type="text" name="alamat" value="{{ old('alamat') }}"
            class="w-full border rounded px-3 py-2"
            placeholder="Masukkan Alamat Siswa" required>
    </div>

    <div class="mb-4">
        <label class="block text-gray-700 mb-2">Tanggal Lahir</label>
        <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}"
            class="w-full border rounded px-3 py-2"
            required>
    </div>

    <div class="mb-4">
        <label class="block text-gray-700 mb-2">Kelas</label>
        <input type="text" name="kelas" value="{{ old('kelas') }}"
            class="w-full border rounded px-3 py-2"
            placeholder="Contoh: X RPL 1" required>
    </div>

    <div class="mb-4">
        <label class="block text-gray-700 mb-2">Wali Kelas</label>
        <input type="text" name="wali_kelas" value="{{ old('wali_kelas') }}"
            class="w-full border rounded px-3 py-2"
            required>
    </div>

    <div class="flex justify-between mt-6">
        <a href="{{ route('siswa.index') }}"
           class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
           Kembali
        </a>
        <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
           Simpan
        </button>
    </div>

</form>

</div>
@endsection
