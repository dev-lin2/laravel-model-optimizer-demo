<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Laravel Model Analyzer Demo')</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/github-dark.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#4f46e5',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">
    <nav class="bg-gray-900 text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <a href="/" class="flex items-center space-x-2">
                    <svg class="w-8 h-8 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    <span class="font-bold text-lg">Model Analyzer</span>
                </a>
                <div class="hidden md:flex items-center space-x-6">
                    <a href="/" class="hover:text-indigo-400 transition {{ request()->is('/') ? 'text-indigo-400' : 'text-gray-300' }}">Home</a>
                    <a href="/demo" class="hover:text-indigo-400 transition {{ request()->is('demo') ? 'text-indigo-400' : 'text-gray-300' }}">Demo</a>
                    <a href="/commands" class="hover:text-indigo-400 transition {{ request()->is('commands') ? 'text-indigo-400' : 'text-gray-300' }}">Commands</a>
                    <a href="/config" class="hover:text-indigo-400 transition {{ request()->is('config') ? 'text-indigo-400' : 'text-gray-300' }}">Config</a>
                    <a href="/json-demo" class="hover:text-indigo-400 transition {{ request()->is('json-demo') ? 'text-indigo-400' : 'text-gray-300' }}">JSON Output</a>
                    <a href="/visualize" class="hover:text-indigo-400 transition {{ request()->is('visualize') ? 'text-indigo-400' : 'text-gray-300' }}">Visualize</a>
                </div>
                <button onclick="document.getElementById('mobile-menu').classList.toggle('hidden')" class="md:hidden text-gray-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>
        <div id="mobile-menu" class="hidden md:hidden px-4 pb-4 space-y-2">
            <a href="/" class="block text-gray-300 hover:text-white">Home</a>
            <a href="/demo" class="block text-gray-300 hover:text-white">Demo</a>
            <a href="/commands" class="block text-gray-300 hover:text-white">Commands</a>
            <a href="/config" class="block text-gray-300 hover:text-white">Config</a>
            <a href="/json-demo" class="block text-gray-300 hover:text-white">JSON Output</a>
            <a href="/visualize" class="block text-gray-300 hover:text-white">Visualize</a>
        </div>
    </nav>

    <main class="flex-1">
        @yield('content')
    </main>

    <footer class="bg-gray-900 text-gray-400 py-8 mt-12">
        <div class="max-w-7xl mx-auto px-4 text-center text-sm">
            <p>Laravel Model Analyzer Demo &mdash; Built to showcase the <code class="text-indigo-400">devlin/laravel-model-analyzer</code> package.</p>
        </div>
    </footer>

    <script>hljs.highlightAll();</script>
    @stack('scripts')
</body>
</html>
