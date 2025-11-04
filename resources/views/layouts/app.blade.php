<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resource/css/app.css')
    <title>Pendataan Siswa</title>
</head>

<body class="bg-white font-sans">

    <nav
        class="flex justify-between items-center mx-10 mt-6 px-8 py-4 rounded-full border border-gray-200 bg-white/70 backdrop-blur-md shadow-lg sticky top-4 z-50">
        <a href="/"
            class="text-2xl font-bold tracking-wide text-gray-800 hover:text-gray-900 transition-all duration-200">
            <span class="text-gray-900">Allghzl</span><span class="text-gray-500">.dev</span>
        </a>

        <ul class="hidden md:flex gap-8 text-gray-700 font-medium">
            <li><a href="/" class="hover:text-gray-900 hover:underline underline-offset-4">Home</a></li>
            <li><a href="/about" class="hover:text-gray-900 hover:underline underline-offset-4">About</a></li>
            <li><a href="/contact" class="hover:text-gray-900 hover:underline underline-offset-4">Contact</a></li>
            <li><a href="/portofolio" class="hover:text-gray-900 hover:underline underline-offset-4">Portofolio</a></li>
        </ul>
    </nav>


    <main class="p-8 mx-10 mt-6">
        @yield('content')
    </main>

</body>

</html>