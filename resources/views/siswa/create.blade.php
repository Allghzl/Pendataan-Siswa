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
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:ring focus:ring-blue-300 focus:outline-none"
                    placeholder="Masukkan NIS Siswa" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Nama Lengkap</label>
                <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:ring focus:ring-blue-300 focus:outline-none"
                    placeholder="Masukkan Nama Lengkap" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Jenis Kelamin</label>
                <div class="flex items-center gap-5">
                    <label class="flex items-center">
                        <input type="radio" name="jenis_kelamin" value="L" {{ old('jenis_kelamin') == 'L' ? 'checked' : '' }}>
                        <span class="ml-2 text-gray-700">Laki-laki</span>
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="jenis_kelamin" value="P" {{ old('jenis_kelamin') == 'P' ? 'checked' : '' }}>
                        <span class="ml-2 text-gray-700">Perempuan</span>
                    </label>
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Alamat</label>
                <textarea name="alamat"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:ring focus:ring-blue-300 focus:outline-none"
                    placeholder="Masukkan Alamat">{{ old('alamat') }}</textarea>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:ring focus:ring-blue-300 focus:outline-none"
                    required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Kelas</label>
                <select id="kelasSelect" name="kelas_id"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:ring focus:ring-blue-300 focus:outline-none"
                    required>
                    <option value="">-- Pilih Kelas --</option>
                    @foreach ($semuaKelas as $kelas)
                        <option value="{{ $kelas->id }}" data-nama="{{ $kelas->nama_kelas }}"
                            data-wali="{{ $kelas->wali_kelas }}">
                            {{ $kelas->nama_kelas }} (Wali: {{ $kelas->wali_kelas }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div id="infoKelas"
                class="hidden transition-all duration-300 mb-4 bg-blue-50 border-l-4 border-blue-400 p-4 rounded">
                <p class="text-gray-800"><strong>Nama Kelas:</strong> <span id="namaKelas"></span></p>
                <p class="text-gray-800"><strong>Wali Kelas:</strong> <span id="waliKelas"></span></p>
            </div>

            <div class="flex justify-between mt-6">
                <a href="{{ route('siswa.index') }}"
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

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const select = document.getElementById('kelasSelect');
            const infoBox = document.getElementById('infoKelas');
            const namaKelas = document.getElementById('namaKelas');
            const waliKelas = document.getElementById('waliKelas');

            select.addEventListener('change', function () {
                const option = this.options[this.selectedIndex];
                const nama = option.getAttribute('data-nama');
                const wali = option.getAttribute('data-wali');

                if (nama && wali) {
                    infoBox.classList.remove('hidden');
                    namaKelas.textContent = nama;
                    waliKelas.textContent = wali;
                } else {
                    infoBox.classList.add('hidden');
                    namaKelas.textContent = '';
                    waliKelas.textContent = '';
                }
            });
        });
    </script>
@endsection