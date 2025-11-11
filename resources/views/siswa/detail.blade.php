@vite('resources/css/app.css')

<div class="flex flex-col justify-center items-center min-h-screen w-full">
    <h2 class="text-3xl mt-2 text-center font-[Open_sans] font-Bold mb-6">Detail Siswa</h2>

    <div class="bg-white shadow rounded-lg p-6 min-w-xl">
        <div class="text-end">
            <h3 class="text-lg font-mono text-gray-400 font-thin">{{ $siswa->nis }} /
                {{ $siswa->kelas->nama_kelas ?? '-' }}
            </h3>
        </div>
        <div class="mb-4">
            <h3 class="text-lg font-medium text-gray-700">NIS:</h3>
            <p class="text-gray-900">{{ $siswa->nis }}</p>
        </div>

        <div class="mb-4">
            <h3 class="text-lg font-medium text-gray-700">Nama Lengkap:</h3>
            <p class="text-gray-900">{{ $siswa->nama_lengkap }}</p>
        </div>

        <div class="mb-4">
            <h3 class="text-lg font-medium text-gray-700">Jenis Kelamin:</h3>
            <p class="text-gray-900">
                {{ $siswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
            </p>
        </div>

        <div class="mb-4">
            <h3 class="text-lg font-medium text-gray-700">Alamat:</h3>
            <p class="text-gray-900">{{ $siswa->alamat }}</p>
        </div>

        <div class="mb-4">
            <h3 class="text-lg font-medium text-gray-700">Tanggal Lahir:</h3>
            <p class="text-gray-900">
                {{ \Carbon\Carbon::parse($siswa->tanggal_lahir)->translatedFormat('l, d F Y') }}
            </p>
        </div>

        <div class="mb-4">
            <h3 class="text-lg font-medium text-gray-700">Kelas:</h3>
            <p class="text-gray-900">{{ $siswa->kelas->nama_kelas ?? '-' }}</p>
        </div>

        <div class="mb-4">
            <h3 class="text-lg font-medium text-gray-700">Wali Kelas:</h3>
            <p class="text-gray-900">{{ $siswa->kelas->wali_kelas ?? '-' }}</p>
        </div>

        <a href="{{ route('siswa.index') }}"
            class="inline-block mt-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition duration-200">
            Kembali ke Daftar Siswa
        </a>
    </div>
</div>