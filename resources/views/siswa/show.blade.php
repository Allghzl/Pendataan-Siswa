@extends('layouts.app')

@section('title', 'Detail Siswa')

@section('content')
<div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md mt-10">
    <h2 class="text-2xl font-bold mb-5 text-gray-800 text-center">Detail Siswa</h2>

    <div class="mb-3">
        <strong>NIS:</strong>
        <p>{{ $siswa->nis }}</p>
    </div>

    <div class="mb-3">
        <strong>Nama Lengkap:</strong>
        <p>{{ $siswa->nama }}</p>
    </div>

    <div class="mb-3">
        <strong>Jenis Kelamin:</strong>
        <p>{{ $siswa->jenis_kelamin }}</p>
    </div>

    <div class="mb-3">
        <strong>Alamat:</strong>
        <p>{{ $siswa->alamat }}</p>
    </div>

    <div class="mb-3">
        <strong>Tanggal Lahir:</strong>
        <p>{{ $siswa->tanggal_lahir }}</p>
    </div>

    <div class="mb-3">
        <strong>Kelas:</strong>
        <p>{{ $siswa->kelas }}</p>
    </div>

    <div class="mb-3">
        <strong>Wali Kelas:</strong>
        <p>{{ $siswa->wali_kelas }}</p>
    </div>

    <div class="flex justify-between mt-6">
        <a href="{{ route('siswa.index') }}"
           class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
            Kembali
        </a>
        <a href="{{ route('siswa.edit', $siswa->id) }}"
           class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Edit
        </a>
    </div>
</div>
@endsection
