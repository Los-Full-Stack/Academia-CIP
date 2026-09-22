<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Academia CIP Cusco</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800 flex flex-col min-h-screen">

    <!-- Header / Navbar -->
    <header class="bg-white border-b border-gray-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between gap-4">
            <div class="flex items-center gap-6">
                <a href="{{ url('/') }}" class="flex items-center gap-2">
                    <span class="font-extrabold text-xl text-red-700 tracking-tight">CIP CUSCO</span>
                </a>
                <nav>
                    <a href="{{ url('/cursos') }}" class="text-gray-600 hover:text-red-700 font-medium transition-colors">Cursos</a>
                </nav>
            </div>

            <div class="flex-1 max-w-md mx-4">
                <form action="{{ url('/cursos') }}" method="GET" class="relative">
                    <input type="search" name="q" placeholder="Buscar cursos..." class="w-full bg-gray-100 border border-gray-300 rounded-lg pl-10 pr-4 py-2 text-sm focus:outline-none focus:border-red-700 focus:bg-white transition-all">
                    <svg class="w-4 h-4 text-gray-400 absolute left-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </form>
            </div>

            <div>
                <a href="{{ url('/login') }}" class="inline-flex items-center px-4 py-2 border border-red-700 text-red-700 hover:bg-red-700 hover:text-white rounded-lg text-sm font-semibold transition-colors">
                    Login
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-slate-900 text-gray-300 py-8 border-t border-gray-800 mt-12">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p class="font-semibold text-white">Colegio de Ingenieros del Perú - Consejo Departamental Cusco</p>
            <p class="text-sm text-gray-400 mt-1">Academia y Capacitación Continua &copy; {{ date('Y') }}</p>
        </div>
    </footer>

</body>
</html>