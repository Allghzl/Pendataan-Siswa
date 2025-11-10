@extends('layouts.app')

@section('title', 'Detail Kelas')

@section('content')
    <div class="max-w-4xl mx-auto bg-white shadow-md rounded-lg p-6 mt-10">

        <h1 class="text-2xl font-bold text-gray-700 mb-4">Detail Kelas</h1>

        <p><strong>Nama Kelas:</strong> {{ $kelas->nama_kelas }}</p>
        <p><strong>Wali Kelas:</strong> {{ $kelas->wali_kelas }}</p>

        <a href="{{ route('kelas.index') }}"
            class="inline-block mt-5 bg-gray-600 text-white py-2 px-4 rounded-lg hover:bg-gray-700">
            Kembali
        </a>
    </div>
@endsection
