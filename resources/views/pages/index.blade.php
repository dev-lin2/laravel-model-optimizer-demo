@extends('layouts.app')

@section('title', 'Laravel Model Analyzer - Home')

@section('content')
{{-- Hero --}}
<section class="bg-gradient-to-br from-gray-900 via-indigo-950 to-gray-900 text-white py-24">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <h1 class="text-5xl font-extrabold mb-4">Laravel Model Analyzer</h1>
        <p class="text-xl text-indigo-200 mb-8">Detect relationship issues before they hit production.</p>
        <div class="bg-gray-800 rounded-lg p-4 inline-block text-left mb-8">
            <code class="text-green-400 text-sm font-mono">composer require devlin/laravel-model-analyzer</code>
        </div>
        <div>
            <a href="/demo" class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-8 py-3 rounded-lg transition">
                See It In Action
            </a>
        </div>
    </div>
</section>

{{-- Features --}}
<section class="max-w-6xl mx-auto px-4 py-16">
    <div class="grid md:grid-cols-3 gap-8">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-8">
            <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center mb-4">
                <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <h3 class="text-lg font-bold mb-2">Relationship Validation</h3>
            <p class="text-gray-600">Automatically scans all Eloquent models and validates that relationships are properly defined with matching columns, indexes, and inverse methods.</p>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-8">
            <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center mb-4">
                <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
            </div>
            <h3 class="text-lg font-bold mb-2">Health Score</h3>
            <p class="text-gray-600">Get a 0-100 health score for your model layer. Weighted across five categories: inverse relationships, circular deps, column existence, FK indexes, and constraints.</p>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-8">
            <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center mb-4">
                <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            </div>
            <h3 class="text-lg font-bold mb-2">CI Integration</h3>
            <p class="text-gray-600">Use <code class="text-indigo-600">--format=json</code> to pipe results into your CI/CD pipeline. Fail builds when the health score drops below your threshold.</p>
        </div>
    </div>
</section>

{{-- Quick Start --}}
<section class="bg-gray-100 py-16">
    <div class="max-w-4xl mx-auto px-4">
        <h2 class="text-2xl font-bold text-center mb-8">Quick Start</h2>
        <div class="bg-gray-900 text-green-400 font-mono text-sm rounded-lg p-6 space-y-2">
            <p><span class="text-gray-500">#</span> Install the package</p>
            <p>$ composer require devlin/laravel-model-analyzer</p>
            <p>&nbsp;</p>
            <p><span class="text-gray-500">#</span> Analyze your models</p>
            <p>$ php artisan model-analyzer:analyze</p>
            <p>&nbsp;</p>
            <p><span class="text-gray-500">#</span> Check health score</p>
            <p>$ php artisan model-analyzer:health</p>
            <p>&nbsp;</p>
            <p><span class="text-gray-500">#</span> List all models</p>
            <p>$ php artisan model-analyzer:list-models --with-relationships</p>
        </div>
    </div>
</section>
@endsection
