<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Iniciar sesión | Capital Humano</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex min-h-screen items-center justify-center bg-slate-100 px-6 py-12 text-slate-900">
    <main class="w-full max-w-md rounded-xl bg-white p-8 shadow-sm">
        <h1 class="text-2xl font-semibold">Capital Humano</h1>
        <p class="mt-2 text-sm text-slate-600">Inicia sesión con una cuenta autorizada.</p>

        @if (session('status'))
            <p class="mt-4 rounded-md bg-green-50 p-3 text-sm text-green-800">{{ session('status') }}</p>
        @endif

        <form method="POST" action="{{ route('login.store') }}" class="mt-6 space-y-5">
            @csrf
            <div>
                <label for="email" class="block text-sm font-medium">Correo</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                    class="mt-1 w-full rounded-md border border-slate-300 px-3 py-2 shadow-sm focus:border-blue-600 focus:outline-none">
                @error('email') <p class="mt-1 text-sm text-red-700">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="password" class="block text-sm font-medium">Contraseña</label>
                <input id="password" name="password" type="password" required autocomplete="current-password"
                    class="mt-1 w-full rounded-md border border-slate-300 px-3 py-2 shadow-sm focus:border-blue-600 focus:outline-none">
                @error('password') <p class="mt-1 text-sm text-red-700">{{ $message }}</p> @enderror
            </div>
            <label class="flex items-center gap-2 text-sm">
                <input type="checkbox" name="remember" value="1" class="rounded border-slate-300">
                Mantener sesión iniciada
            </label>
            <button type="submit" class="w-full rounded-md bg-blue-700 px-4 py-2 font-medium text-white hover:bg-blue-800">
                Iniciar sesión
            </button>
        </form>
    </main>
</body>
</html>
