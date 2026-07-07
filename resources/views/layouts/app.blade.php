<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script>
        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.classList.add('dark');
        }
    </script>

    <title>{{ config('app.name', 'MaRe') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-[#fdfaf3] dark:bg-gray-900">
    <div class="flex h-screen overflow-hidden">

        <!-- Sidebar -->
        @include('layouts.navigation')

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">

            <!-- Top Bar -->
            <header class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 px-6 py-4 flex justify-between items-center">
                <div>
                    @if (isset($header))
                        <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ $header }}</h1>
                    @endif
                    @if (isset($subheader))
                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ $subheader }}</p>
                    @endif
                </div>

                <div class="flex items-center gap-4">

                    <!-- Dark Mode Toggle -->
                    <button id="theme-toggle" type="button"
                        class="w-9 h-9 rounded-lg flex items-center justify-center text-gray-500 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700">
                        <svg id="theme-icon-dark" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                        </svg>
                        <svg id="theme-icon-light" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </button>

                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center gap-2 text-sm text-gray-700 dark:text-gray-300 hover:text-gray-900">
                                <div class="w-9 h-9 rounded-full bg-[#18181b] flex items-center justify-center text-[#facc15] font-semibold">
                                    {{ substr(auth()->user()->name, 0, 1) }}
                                </div>
                                <div class="text-left hidden sm:block">
                                    <p class="font-medium text-gray-900 dark:text-gray-100">{{ auth()->user()->name }}</p>
                                    <p class="text-xs text-gray-400 capitalize">{{ auth()->user()->role }}</p>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">{{ __('Profile') }}</x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>   
                    </x-dropdown>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto p-6">
                @if (session('success'))
                    <div class="mb-4 p-4 bg-[#8a9a5b]/10 text-[#5c6b3a] border border-[#8a9a5b]/30 rounded-lg text-sm">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="mb-4 p-4 bg-[#4a1128]/10 text-[#4a1128] border border-[#4a1128]/30 rounded-lg text-sm">
                        {{ session('error') }}
                    </div>
                @endif

                {{ $slot }}
            </main>

            <footer class="text-center text-sm text-[#7a6a5f] py-4">
                &copy; {{ date('Y') }} MaRe. All rights reserved.
            </footer>
        </div>
    </div>

    <script>
        const themeToggleBtn = document.getElementById('theme-toggle');
        const iconDark = document.getElementById('theme-icon-dark');
        const iconLight = document.getElementById('theme-icon-light');

        function updateIcon() {
            const isDark = document.documentElement.classList.contains('dark');
            iconDark.classList.toggle('hidden', isDark);
            iconLight.classList.toggle('hidden', !isDark);
        }

        updateIcon();

        themeToggleBtn.addEventListener('click', () => {
            document.documentElement.classList.toggle('dark');
            localStorage.setItem('theme', document.documentElement.classList.contains('dark') ? 'dark' : 'light');
            updateIcon();
        });
    </script>

    @stack('scripts')
</body>
</html>