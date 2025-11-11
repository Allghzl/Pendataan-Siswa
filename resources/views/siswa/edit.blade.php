@extends('layouts.app')

@section('title', 'Edit Data Siswa')

@section('content')
    <div class="max-w-3xl mx-auto mt-10 bg-white shadow-md p-6 rounded-lg">
        <h1 class="text-2xl font-bold text-gray-700 mb-5">Edit Data Siswa</h1>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 px-4 py-3 rounded mb-4">
                <ul class="list-disc ml-5 text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('siswa.update', $siswa->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block font-semibold text-gray-700">NIS</label>
                <input type="number" name="nis" value="{{ old('nis', $siswa->nis) }}"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:ring focus:ring-blue-300 focus:outline-none"
                    required>
            </div>

            <div class="mb-4">
                <label class="block font-semibold text-gray-700">Nama Lengkap</label>
                <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap', $siswa->nama_lengkap) }}"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:ring focus:ring-blue-300 focus:outline-none"
                    required>
            </div>

            <div class="mb-4">
                <label class="block font-semibold text-gray-700">Jenis Kelamin</label>
                <div class="flex items-center gap-5">
                    <label class="flex items-center">
                        <input type="radio" name="jenis_kelamin" value="L"
                            {{ old('jenis_kelamin', $siswa->jenis_kelamin) == 'L' ? 'checked' : '' }} required>
                        <span class="ml-2 text-gray-700">Laki-laki</span>
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="jenis_kelamin" value="P"
                            {{ old('jenis_kelamin', $siswa->jenis_kelamin) == 'P' ? 'checked' : '' }} required>
                        <span class="ml-2 text-gray-700">Perempuan</span>
                    </label>
                </div>
            </div>

            <div class="mb-4">
                <label class="block font-semibold text-gray-700">Alamat</label>
                <textarea name="alamat"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:ring focus:ring-blue-300 focus:outline-none"
                    rows="3" required>{{ old('alamat', $siswa->alamat) }}</textarea>
            </div>

            <div class="mb-4">
                <label class="block font-semibold text-gray-700">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $siswa->tanggal_lahir) }}"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:ring focus:ring-blue-300 focus:outline-none" required>
            </div>

            <div class="mb-4">
                <label class="block font-semibold text-gray-700">Kelas</label>
                <select id="kelasSelect" name="kelas_id"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:ring focus:ring-blue-300 focus:outline-none"
                    required>
                    <option value="">-- Pilih Kelas --</option>
                    @foreach ($semuaKelas as $kelas)
                        <option value="{{ $kelas->id }}" data-nama="{{ $kelas->nama_kelas }}"
                            data-wali="{{ $kelas->wali_kelas }}"
                            {{ (int) old('kelas_id', $siswa->kelas_id) === $kelas->id ? 'selected' : '' }}>
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

            <div class="mb-6">
                <label class="block font-semibold text-gray-700 mb-2">Foto Saat Ini</label>
                @if ($siswa->foto)
                    <img src="{{ $siswa->foto }}" alt="{{ $siswa->nama_lengkap }}"
                        class="w-32 h-32 object-cover rounded-lg border border-gray-200 mb-3">
                @else
                    <p class="text-sm text-gray-500 mb-3">Belum ada foto yang diupload.</p>
                @endif

                <label class="block font-semibold text-gray-700 mb-2">Ganti Foto (opsional)</label>
                <input type="file" name="foto" accept="image/*"
                    class="w-full border border-dashed border-gray-300 rounded px-3 py-2 focus:ring focus:ring-blue-300 focus:outline-none">
                <p class="text-xs text-gray-500 mt-1">Kosongkan jika tidak ingin mengubah foto. Maks 5 MB (jpg/jpeg/png).</p>
            </div>

            <div class="flex justify-between mt-6">
                <a href="{{ route('siswa.index') }}"
                    class="bg-gray-500 text-white py-2 px-4 rounded-lg hover:bg-gray-600 transition">
                    Kembali
                </a>

                <button type="submit"
                    class="bg-green-600 text-white py-2 px-4 rounded-lg hover:bg-green-700 transition">
                    Update Data
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

            const renderInfo = () => {
                const option = select.options[select.selectedIndex];
                const nama = option?.getAttribute('data-nama');
                const wali = option?.getAttribute('data-wali');

                if (nama && wali) {
                    infoBox.classList.remove('hidden');
                    namaKelas.textContent = nama;
                    waliKelas.textContent = wali;
                } else {
                    infoBox.classList.add('hidden');
                    namaKelas.textContent = '';
                    waliKelas.textContent = '';
                }
            };

            select.addEventListener('change', renderInfo);
            renderInfo();
        });
    </script>
@endsection
