<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Pendataan Siswa')</title>

    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50 text-gray-900">

    <!-- NAVBAR -->
    <nav class="bg-blue-600 text-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">

            <!-- Logo -->
            <a href="/" class="text-xl font-bold tracking-wide hover:text-yellow-300">
                Pendataan Siswa
            </a>

            <!-- Toggle Mobile -->
            <input type="checkbox" id="menu-toggle" class="hidden peer">
            <label for="menu-toggle" class="cursor-pointer md:hidden">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </label>

            <!-- Desktop Menu -->
            <ul class="hidden md:flex gap-6 font-medium">
                <li>
                    <a href="/siswa"
                       class="px-2 py-1 rounded-md transition
                       {{ Request::is('siswa*') ? 'bg-yellow-400 text-black font-semibold' : 'hover:text-yellow-300' }}">
                        Siswa
                    </a>
                </li>
                <li>
                    <a href="/kelas"
                       class="px-2 py-1 rounded-md transition
                       {{ Request::is('kelas*') ? 'bg-yellow-400 text-black font-semibold' : 'hover:text-yellow-300' }}">
                        Kelas
                    </a>
                </li>
            </ul>
        </div>

        <!-- Mobile Menu -->
        <ul class="peer-checked:flex hidden flex-col px-4 pb-3 bg-blue-600 md:hidden space-y-1">
            <li>
                <a href="/siswa"
                   class="block py-2 rounded-md px-2
                   {{ Request::is('siswa*') ? 'bg-yellow-400 text-black font-semibold' : 'hover:text-yellow-300' }}">
                    Siswa
                </a>
            </li>
            <li>
                <a href="/kelas"
                   class="block py-2 rounded-md px-2
                   {{ Request::is('kelas*') ? 'bg-yellow-400 text-black font-semibold' : 'hover:text-yellow-300' }}">
                    Kelas
                </a>
            </li>
        </ul>
    </nav>

    <!-- PAGE CONTENT -->
    <main class="max-w-7xl mx-auto px-4 py-6">
        @yield('content')
    </main>
