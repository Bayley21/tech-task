<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
    </head>
    <body class="font-sans antialiased dark:bg-black dark:text-white/50">
        <header class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">
            
        </header>

        <main class="mt-6 container">
            <pre>
                {{ json_encode($people, JSON_PRETTY_PRINT) }}
            </pre>
        </main>

        <footer class="py-16 text-center text-sm text-black dark:text-white/70">
            
        </footer>
    </body>
</html>
