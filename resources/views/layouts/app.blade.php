<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Pendataan Siswa</title>
</head>

<body class="bg-white font-sans">

    <nav
        class="flex flex-wrap md:flex-nowrap items-center gap-4 mx-10 mt-6 px-8 py-4 rounded-full border border-gray-200 bg-white/70 backdrop-blur-md shadow-lg sticky top-4 z-50">
        <a href="/"
            class="text-2xl font-bold tracking-wide text-gray-800 hover:text-gray-900 transition-all duration-200">
            <span class="text-gray-900">Data </span><span class="text-gray-500">Siswa</span>
        </a>

        <div class="order-3 w-full md:order-0 md:flex-1" x-data="globalSearch('{{ route('search') }}')">
            <div class="relative" @keydown.escape.window="open = false">
                <div
                    class="flex items-center gap-2 bg-white border border-gray-200 rounded-full px-4 py-2 shadow-inner focus-within:border-blue-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 21l-4.35-4.35M10.5 18a7.5 7.5 0 1 1 0-15 7.5 7.5 0 0 1 0 15z" />
                    </svg>
                    <input type="search" x-model="term" @input.debounce.400ms="search"
                        @focus="open = hasResults || loading || error"
                        placeholder="Cari siswa (nama/NIS) atau kelas (nama/wali)"
                        class="flex-1 bg-transparent outline-none text-sm text-gray-700 placeholder:text-gray-400" />
                    <button type="button" x-show="term.length" @click="clear"
                        class="text-gray-400 hover:text-gray-600 transition" x-cloak>
                        &#10005;
                    </button>
                </div>

                <div x-show="open" x-transition x-cloak
                    class="absolute left-0 right-0 mt-3 bg-white border border-gray-200 rounded-2xl shadow-2xl overflow-hidden z-50"
                    @click.outside="open = false">
                    <template x-if="loading">
                        <p class="px-4 py-3 text-sm text-gray-500">Mencari...</p>
                    </template>

                    <template x-if="!loading && error">
                        <p class="px-4 py-3 text-sm text-red-500" x-text="error"></p>
                    </template>

                    <template x-if="!loading && !error && !hasResults">
                        <p class="px-4 py-3 text-sm text-gray-500">
                            Tidak ada hasil untuk "<span class="font-semibold" x-text="term"></span>"
                        </p>
                    </template>

                    <div x-show="results.siswa.length" class="border-t border-gray-100">
                        <p class="px-4 pt-4 pb-2 text-xs font-semibold tracking-wide text-gray-400 uppercase">Siswa</p>
                        <template x-for="item in results.siswa" :key="'siswa-' + item.id">
                            <a :href="item.detail_url" class="block px-4 py-3 hover:bg-gray-50 transition">
                                <p class="font-medium text-gray-800" x-text="item.nama"></p>
                                <p class="text-sm text-gray-500">
                                    NIS <span x-text="item.nis"></span> &bull; <span x-text="item.kelas"></span>
                                </p>
                            </a>
                        </template>
                    </div>

                    <div x-show="results.kelas.length" class="border-t border-gray-100">
                        <p class="px-4 pt-4 pb-2 text-xs font-semibold tracking-wide text-gray-400 uppercase">Kelas</p>
                        <template x-for="item in results.kelas" :key="'kelas-' + item.id">
                            <a :href="item.detail_url" class="block px-4 py-3 hover:bg-gray-50 transition">
                                <p class="font-medium text-gray-800" x-text="item.nama"></p>
                                <p class="text-sm text-gray-500">
                                    Wali: <span x-text="item.wali_kelas"></span> &bull;
                                    <span x-text="item.jumlah_siswa + ' siswa'"></span>
                                </p>
                            </a>
                        </template>
                    </div>
                </div>
            </div>
        </div>

        <ul class="hidden md:flex gap-8 text-gray-700 font-medium md:justify-end">
            <li><a href="/siswa" class="hover:text-gray-900 hover:underline underline-offset-4">Siswa</a></li>
            <li><a href="/kelas" class="hover:text-gray-900 hover:underline underline-offset-4">Kelas</a></li>
        </ul>
    </nav>


    <main class="p-8 mx-10 mt-6">
        @yield('content')
    </main>

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('globalSearch', (endpoint) => ({
                endpoint,
                term: '',
                open: false,
                loading: false,
                error: '',
                results: { siswa: [], kelas: [] },
                search() {
                    const keyword = this.term.trim();

                    if (keyword.length < 2) {
                        this.resetResults();
                        return;
                    }

                    this.loading = true;
                    this.error = '';
                    this.open = true;

                    fetch(`${this.endpoint}?q=${encodeURIComponent(keyword)}`)
                        .then((response) => {
                            if (!response.ok) {
                                throw new Error('Request failed');
                            }
                            return response.json();
                        })
                        .then((data) => {
                            this.results = {
                                siswa: data.siswa ?? [],
                                kelas: data.kelas ?? [],
                            };
                        })
                        .catch(() => {
                            this.error = 'Gagal memuat hasil. Coba lagi.';
                            this.results = { siswa: [], kelas: [] };
                        })
                        .finally(() => {
                            this.loading = false;
                        });
                },
                clear() {
                    this.term = '';
                    this.resetResults();
                },
                resetResults() {
                    this.results = { siswa: [], kelas: [] };
                    this.error = '';
                    this.loading = false;
                    this.open = false;
                },
                get hasResults() {
                    return (this.results.siswa?.length ?? 0) + (this.results.kelas?.length ?? 0) > 0;
                }
            }));
        });
    </script>
</body>

</html>