@extends('layouts.app')

@section('title', 'Config Reference - Laravel Model Analyzer')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-12">
    <h1 class="text-3xl font-bold mb-2">Configuration Reference</h1>
    <p class="text-gray-600 mb-10">Publish and customize the config file to tune the analyzer for your project.</p>

    {{-- Publish instruction --}}
    <div class="bg-gray-900 text-green-400 font-mono text-sm rounded-lg p-4 mb-8">
        <p>$ php artisan vendor:publish --tag=model-analyzer-config</p>
    </div>

    {{-- Config code block --}}
    <h2 class="text-xl font-bold mb-4">config/model-analyzer.php</h2>
    <div class="mb-10">
        <pre><code class="language-php">&lt;?php

return [

    /*
    |--------------------------------------------------------------------------
    | Model Path
    |--------------------------------------------------------------------------
    | Directory where the analyzer looks for Eloquent models.
    */
    'model_path' => app_path('Models'),

    /*
    |--------------------------------------------------------------------------
    | Ignored Models
    |--------------------------------------------------------------------------
    | Fully-qualified class names to skip during analysis.
    */
    'ignored_models' => [
        // App\Models\BaseModel::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Strict Mode
    |--------------------------------------------------------------------------
    | When true, warnings are also treated as errors (exit code 1).
    */
    'strict' => false,

    /*
    |--------------------------------------------------------------------------
    | Health Weights
    |--------------------------------------------------------------------------
    | Each category contributes to the total 100-point health score.
    | Adjust weights to reflect what matters most in your project.
    */
    'health_weights' => [
        'inverse_relationships'  => 30,  // Every relationship has an inverse
        'no_circular_deps'       => 30,  // No circular dependency chains
        'column_existence'       => 20,  // FK columns exist in the DB
        'foreign_key_indexes'    => 10,  // FK columns are indexed
        'foreign_key_constraints'=> 10,  // FK constraints are defined
    ],

    /*
    |--------------------------------------------------------------------------
    | Output Format
    |--------------------------------------------------------------------------
    | Default output format: 'text' or 'json'.
    */
    'default_format' => 'text',

];</code></pre>
    </div>

    {{-- Health Weights Visual --}}
    <h2 class="text-xl font-bold mb-4">Health Weights Breakdown</h2>
    <p class="text-gray-600 mb-6">The health score is calculated from these five weighted categories (total = 100 points).</p>

    <div class="space-y-4">
        <div>
            <div class="flex justify-between text-sm font-medium mb-1">
                <span>Inverse Relationships</span>
                <span class="text-indigo-600">30 pts</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-5">
                <div class="bg-indigo-600 h-5 rounded-full flex items-center justify-end pr-2" style="width: 30%">
                    <span class="text-white text-xs font-bold">30%</span>
                </div>
            </div>
        </div>

        <div>
            <div class="flex justify-between text-sm font-medium mb-1">
                <span>No Circular Dependencies</span>
                <span class="text-indigo-600">30 pts</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-5">
                <div class="bg-indigo-500 h-5 rounded-full flex items-center justify-end pr-2" style="width: 30%">
                    <span class="text-white text-xs font-bold">30%</span>
                </div>
            </div>
        </div>

        <div>
            <div class="flex justify-between text-sm font-medium mb-1">
                <span>Column Existence</span>
                <span class="text-indigo-600">20 pts</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-5">
                <div class="bg-indigo-400 h-5 rounded-full flex items-center justify-end pr-2" style="width: 20%">
                    <span class="text-white text-xs font-bold">20%</span>
                </div>
            </div>
        </div>

        <div>
            <div class="flex justify-between text-sm font-medium mb-1">
                <span>Foreign Key Indexes</span>
                <span class="text-indigo-600">10 pts</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-5">
                <div class="bg-indigo-300 h-5 rounded-full flex items-center justify-end pr-2" style="width: 10%">
                    <span class="text-white text-xs font-bold">10%</span>
                </div>
            </div>
        </div>

        <div>
            <div class="flex justify-between text-sm font-medium mb-1">
                <span>Foreign Key Constraints</span>
                <span class="text-indigo-600">10 pts</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-5">
                <div class="bg-indigo-200 h-5 rounded-full flex items-center justify-end pr-2" style="width: 10%">
                    <span class="text-xs font-bold text-indigo-700">10%</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
