@extends('layouts.app')

@section('title', 'Detail Kelas')

@section('content')
    <div class="max-w-4xl mx-auto mt-10 space-y-6">
        <div class="bg-white shadow rounded-2xl p-6 border border-gray-100">
            <p class="text-sm uppercase tracking-wide text-gray-400 mb-2">Kelas</p>
            <h1 class="text-3xl font-bold text-gray-800">{{ $kelas->nama_kelas }}</h1>
            <p class="text-gray-600 mt-2">Wali Kelas: <span
                    class="font-medium text-gray-800">{{ $kelas->wali_kelas }}</span></p>
            <p class="text-gray-600">Total Siswa: <span
                    class="font-medium text-gray-800">{{ $kelas->siswa->count() }}</span></p>
        </div>

        <div class="bg-white shadow rounded-2xl p-6 border border-gray-100">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-semibold text-gray-800">Daftar Siswa</h2>
                <span class="text-sm text-gray-500">Klik nama siswa untuk melihat detail</span>
            </div>

            @if ($kelas->siswa->isEmpty())
                <p class="text-gray-500">Belum ada siswa yang terdaftar di kelas ini.</p>
            @else
                <div class="divide-y divide-gray-100">
                    @foreach ($kelas->siswa as $siswa)
                        <a href="{{ route('siswa.details', $siswa->id) }}"
                            class="flex items-center justify-between py-3 px-2 hover:bg-gray-50 rounded-lg transition group">
                            <div>
                                <p class="font-medium text-gray-800 group-hover:text-blue-600">
                                    {{ $siswa->nama_lengkap }}
                                </p>
                                <p class="text-sm text-gray-500">NIS: {{ $siswa->nis }}</p>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400 group-hover:text-blue-600"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>

        <a href="{{ route('kelas.index') }}"
            class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-700 font-medium transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
            Kembali ke Daftar Kelas
        </a>
    </div>
@endsection