@extends('layouts.app')

@section('title', 'Commands Reference - Laravel Model Analyzer')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-12">
    <h1 class="text-3xl font-bold mb-2">Commands Reference</h1>
    <p class="text-gray-600 mb-10">All available artisan commands provided by the package.</p>

    {{-- model-analyzer:analyze --}}
    <section class="mb-12">
        <h2 class="text-2xl font-bold mb-4">model-analyzer:analyze</h2>
        <p class="text-gray-600 mb-4">Scans all Eloquent models and validates relationships, columns, indexes, and constraints.</p>

        <div class="overflow-x-auto mb-4">
            <table class="w-full text-sm border border-gray-200 rounded-lg overflow-hidden">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="text-left px-4 py-2 font-semibold">Option</th>
                        <th class="text-left px-4 py-2 font-semibold">Description</th>
                        <th class="text-left px-4 py-2 font-semibold">Default</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <tr>
                        <td class="px-4 py-2 font-mono text-indigo-600">--path</td>
                        <td class="px-4 py-2">Directory to scan for models</td>
                        <td class="px-4 py-2 text-gray-500">app/Models</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 font-mono text-indigo-600">--format</td>
                        <td class="px-4 py-2">Output format (text or json)</td>
                        <td class="px-4 py-2 text-gray-500">text</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 font-mono text-indigo-600">--model</td>
                        <td class="px-4 py-2">Analyze a specific model only</td>
                        <td class="px-4 py-2 text-gray-500">all</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 font-mono text-indigo-600">--strict</td>
                        <td class="px-4 py-2">Return exit code 1 on any issue</td>
                        <td class="px-4 py-2 text-gray-500">false</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="bg-gray-900 text-green-400 font-mono text-sm rounded-lg p-4 overflow-x-auto">
<pre>$ php artisan model-analyzer:analyze

Scanning models in: app/Models
Found 6 models

Analyzing relationships...

  User .............. <span class="text-green-400">OK</span>    (4 relationships, no issues)
  Post .............. <span class="text-yellow-400">WARN</span>  (missing index on `editor_id`)
  Comment ........... <span class="text-yellow-400">WARN</span>  (Reaction inverse missing)
  Tag ............... <span class="text-green-400">OK</span>    (1 relationship, no issues)
  Order ............. <span class="text-green-400">OK</span>    (1 relationship, no issues)
  Product ........... <span class="text-red-400">ERROR</span> (foreign key column `category_id` does not exist)

<span class="text-gray-500">──────────────────────────────────────────────────────</span>
 Issues found: <span class="text-red-400">1 error</span>, <span class="text-yellow-400">2 warnings</span>
 Health Score: <span class="text-yellow-400">62 / 100</span>
<span class="text-gray-500">──────────────────────────────────────────────────────</span>

  <span class="text-red-400">[ERROR]</span>   Product::belongsTo(Category)
            → Column `category_id` not found on `products` table

  <span class="text-yellow-400">[WARNING]</span> Post
            → Column `editor_id` has no index (performance risk)

  <span class="text-yellow-400">[WARNING]</span> Comment::hasOne(Reaction)
            → No inverse relationship found on Reaction model</pre>
        </div>
    </section>

    {{-- model-analyzer:health --}}
    <section class="mb-12">
        <h2 class="text-2xl font-bold mb-4">model-analyzer:health</h2>
        <p class="text-gray-600 mb-4">Generates a weighted health score (0-100) for your model layer across five categories.</p>

        {{-- Health Score Gauge --}}
        <div class="bg-white border border-gray-200 rounded-lg p-6 mb-4">
            <div class="text-center mb-4">
                <span class="text-5xl font-bold text-yellow-500">62</span>
                <span class="text-2xl text-gray-400">/100</span>
                <p class="text-sm text-yellow-600 font-semibold mt-1">FAIR</p>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-4 overflow-hidden">
                <div class="h-4 rounded-full bg-gradient-to-r from-red-500 via-yellow-500 to-green-500" style="width: 62%"></div>
            </div>
        </div>

        <div class="bg-gray-900 text-green-400 font-mono text-sm rounded-lg p-4 overflow-x-auto">
<pre>$ php artisan model-analyzer:health

 Model Health Report
 <span class="text-gray-400">═══════════════════</span>

 Score: <span class="text-yellow-400">62/100</span>  <span class="text-green-400">██████</span><span class="text-gray-600">░░░░</span>  <span class="text-yellow-400">FAIR</span>

 Breakdown:
  <span class="text-green-400">✔</span> Inverse relationships    <span class="text-green-400">30/30</span>
  <span class="text-green-400">✔</span> No circular deps         <span class="text-green-400">30/30</span>
  <span class="text-red-400">✘</span> Column existence         <span class="text-red-400">10/20</span>  (1 missing column)
  <span class="text-green-400">✔</span> Foreign key indexes       <span class="text-yellow-400">8/10</span>  (1 unindexed FK)
  <span class="text-red-400">✘</span> Foreign key constraints   <span class="text-red-400">4/10</span>  (missing FK definition)

 Recommendations:
  1. Add `category_id` column to `products` table or remove the Category relationship
  2. Add an index to `posts.editor_id`
  3. Define a Reaction model or remove the hasOne from Comment</pre>
        </div>
    </section>

    {{-- model-analyzer:list-models --}}
    <section class="mb-12">
        <h2 class="text-2xl font-bold mb-4">model-analyzer:list-models</h2>
        <p class="text-gray-600 mb-4">Lists all discovered Eloquent models with optional relationship counts.</p>

        <div class="overflow-x-auto mb-4">
            <table class="w-full text-sm border border-gray-200 rounded-lg overflow-hidden">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="text-left px-4 py-2 font-semibold">Option</th>
                        <th class="text-left px-4 py-2 font-semibold">Description</th>
                        <th class="text-left px-4 py-2 font-semibold">Default</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <tr>
                        <td class="px-4 py-2 font-mono text-indigo-600">--with-relationships</td>
                        <td class="px-4 py-2">Show relationship count per model</td>
                        <td class="px-4 py-2 text-gray-500">false</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 font-mono text-indigo-600">--path</td>
                        <td class="px-4 py-2">Directory to scan for models</td>
                        <td class="px-4 py-2 text-gray-500">app/Models</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="bg-gray-900 text-green-400 font-mono text-sm rounded-lg p-4 overflow-x-auto">
<pre>$ php artisan model-analyzer:list-models --with-relationships

 Discovered Models
 <span class="text-gray-400">═════════════════</span>

  Model      Namespace                   Relationships
  <span class="text-gray-500">─────────────────────────────────────────────────────</span>
  User       App\Models\User             4
  Post       App\Models\Post             4
  Comment    App\Models\Comment          3
  Tag        App\Models\Tag              1
  Order      App\Models\Order            2
  Product    App\Models\Product          2

 Total: <span class="text-indigo-400">6 models</span>, <span class="text-indigo-400">16 relationships</span></pre>
        </div>
    </section>
</div>
@endsection
