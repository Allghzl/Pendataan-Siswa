@vite('resources/css/app.css')

<div class="flex justify-center items-center min-h-screen bg-gray-100 py-10">
    {{-- Card container --}}
    <div class="flex bg-white shadow-2xl rounded-2xl overflow-hidden max-w-4xl w-full border border-gray-200">

        {{-- FOTO SISI KIRI --}}
        <div class="bg-linear-to-b from-blue-600 to-blue-800 flex flex-col items-center justify-center p-6 w-1/3">
            <img src="{{ $siswa->foto ? asset($siswa->foto) : asset('images/default-avatar.png') }}"
                alt="{{ $siswa->nama_lengkap }}"
                class="w-40 h-40 object-cover rounded-lg shadow-lg border-4 border-white mb-4">

            <h2 class="text-white text-2xl font-bold text-center">
                {{ $siswa->nama_lengkap }}
            </h2>
            <p class="text-blue-200 font-mono mt-1">
                {{ $siswa->nis }} / {{ $siswa->kelas->nama_kelas ?? '-' }}
            </p>
        </div>

        <div class="flex-1 p-8">
            <h2 class="text-2xl font-bold uppercase text-gray-800 mb-4 border-b pb-2">
                Detail Siswa
            </h2>

            <div class="space-y-4">
                <div>
                    <h3 class="text-sm font-semibold text-gray-500 uppercase">Nama Lengkap</h3>
                    <p class="text-gray-900">{{ $siswa->nama_lengkap }}</p>
                </div>

                <div>
                    <h3 class="text-sm font-semibold text-gray-500 uppercase">Jenis Kelamin</h3>
                    <p class="text-gray-900">
                        {{ $siswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                    </p>
                </div>

                <div>
                    <h3 class="text-sm font-semibold text-gray-500 uppercase">Alamat</h3>
                    <p class="text-gray-900">{{ $siswa->alamat }}</p>
                </div>

                <div>
                    <h3 class="text-sm font-semibold text-gray-500 uppercase">Tanggal Lahir</h3>
                    <p class="text-gray-900">
                        {{ \Carbon\Carbon::parse($siswa->tanggal_lahir)
    ->setTimezone('Asia/Jakarta')
    ->locale('id')
    ->translatedFormat('l, d F Y') }}
                    </p>
                </div>

                <div>
                    <h3 class="text-sm font-semibold text-gray-500 uppercase">Kelas</h3>
                    <p class="text-gray-900">{{ $siswa->kelas->nama_kelas ?? '-' }}</p>
                </div>

                <div>
                    <h3 class="text-sm font-semibold text-gray-500 uppercase">Wali Kelas</h3>
                    <p class="text-gray-900">{{ $siswa->kelas->wali_kelas ?? '-' }}</p>
                </div>
            </div>

            <div class="mt-8 text-right">
                <a href="{{ route('siswa.index') }}"
                    class="inline-block px-5 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 shadow-md transition-all duration-200">
                    Kembali ke Daftar Siswa
                </a>
            </div>
        </div>
    </div>
</div>
