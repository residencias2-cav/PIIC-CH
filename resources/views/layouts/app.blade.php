<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Capital Humano' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="min-h-screen bg-slate-100 text-slate-900 antialiased">
    <header class="border-b border-slate-200 bg-white">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-4">
            <a href="{{ route('trabajadores.index') }}" class="font-semibold text-slate-900">Capital Humano</a>
            <div class="flex items-center gap-4 text-sm">
                <span>{{ auth()->user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="font-medium text-blue-700 hover:text-blue-900">Cerrar sesión</button>
                </form>
            </div>
        </div>
    </header>
    <main class="mx-auto max-w-7xl px-6 py-8">
        {{ $slot }}
    </main>
    @livewireScripts
</body>
</html>
