@extends('layouts.app')

@section('title', 'Tambah Data Kelas')

@section('content')
    <div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md mt-10">
        <h2 class="text-2xl font-bold mb-5 text-gray-800 text-center">Tambah Data Kelas</h2>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 px-4 py-3 rounded mb-4">
                <ul class="list-disc ml-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('kelas.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block text-gray-700 mb-2 font-semibold">Nama Kelas</label>
                <input type="text" name="nama_kelas" value="{{ old('nama_kelas') }}"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:ring focus:ring-blue-300 focus:outline-none"
                    placeholder="Contoh: XI RPL 1" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 mb-2 font-semibold">Wali Kelas</label>
                <input type="text" name="wali_kelas" value="{{ old('wali_kelas') }}"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:ring focus:ring-blue-300 focus:outline-none"
                    placeholder="Contoh: Ahmad Subarjo, S.Pd." required>
            </div>

            <div class="flex justify-between mt-6">
                <a href="{{ route('kelas.index') }}"
                    class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition duration-200">
                    Kembali
                </a>
                <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition duration-200">
                    Simpan
                </button>
            </div>
        </form>
    </div>
@endsection