<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- <wireui:scripts /> --}}
</head>

<body class="font-sans antialiased">
    <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
        <div
            class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
            <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                <header class="grid items-center grid-cols-2 gap-2 py-5 lg:grid-cols-3">
                    <div class="flex lg:justify-center lg:col-start-2">
                        <x-application-logo class="w-24 h-24" />
                    </div>
                    @if (Route::has('login'))
                        <livewire:welcome.navigation />
                    @endif
                </header>

                <main class="mt-6">
                    <div class="max-w-2xl py-12 mx-auto sm:py-10 lg:py-24">
                        <div class="text-center">
                            <h1
                                class="text-5xl font-semibold tracking-tight text-gray-900 text-balance sm:text-7xl">
                                Birthday Notes</h1>
                            <p class="mt-8 text-lg font-medium text-gray-500 text-pretty sm:text-xl/8">Send scheduled birthday greetings to your special someone!</p>
                            <div class="flex items-center justify-center mt-10 gap-x-6">
                                <x-button primary xl href="{{route('register')}}">Get started!</x-button>
                            </div>
                        </div>
                    </div>
                </main>

                <footer class="py-12 text-sm text-center text-black dark:text-white/70">
                    Made by Vincent Felix S. Cagara
                </footer>
            </div>
        </div>
    </div>
</body>

</html>
