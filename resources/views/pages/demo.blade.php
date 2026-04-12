@extends('layouts.app')

@section('title', 'Demo - Laravel Model Analyzer')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-12">
    <h1 class="text-3xl font-bold mb-2">Interactive Demo</h1>
    <p class="text-gray-600 mb-8">Explore the 6 demo models and see what the analyzer detects.</p>

    <div class="grid lg:grid-cols-2 gap-8">
        {{-- Model Map Panel --}}
        <div>
            <h2 class="text-xl font-bold mb-4">Model Map</h2>
            <div class="space-y-4">
                @foreach($models as $model)
                <div class="bg-white rounded-lg border border-gray-200 p-5 shadow-sm">
                    <div class="flex items-center justify-between mb-2">
                        <h3 class="font-bold text-lg">{{ $model['name'] }}</h3>
                        @if($model['status'] === 'ok')
                            <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-700">OK</span>
                        @elseif($model['status'] === 'warning')
                            <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-700">WARNING</span>
                        @else
                            <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-700">ERROR</span>
                        @endif
                    </div>
                    <p class="text-xs text-gray-400 font-mono mb-3">{{ $model['namespace'] }}</p>
                    <div class="flex flex-wrap gap-2 mb-2">
                        @foreach($model['relationships'] as $rel)
                            <span class="px-2 py-1 bg-gray-100 text-gray-700 text-xs rounded font-mono">{{ $rel }}</span>
                        @endforeach
                    </div>
                    @if(count($model['issues']) > 0)
                        <div class="mt-3 space-y-1">
                            @foreach($model['issues'] as $issue)
                                <p class="text-sm text-red-600">{{ $issue }}</p>
                            @endforeach
                        </div>
                    @endif
                </div>
                @endforeach
            </div>
        </div>

        {{-- Command Output Panel --}}
        <div>
            <h2 class="text-xl font-bold mb-4">Command Output</h2>

            {{-- Tabs --}}
            <div class="border-b border-gray-200 mb-0">
                <nav class="flex space-x-1" id="demo-tabs">
                    <button onclick="showTab('analyze')" class="tab-btn px-4 py-2 text-sm font-medium rounded-t-lg border-b-2 border-indigo-600 text-indigo-600 bg-white" data-tab="analyze">analyze</button>
                    <button onclick="showTab('health')" class="tab-btn px-4 py-2 text-sm font-medium rounded-t-lg border-b-2 border-transparent text-gray-500 hover:text-gray-700" data-tab="health">health</button>
                    <button onclick="showTab('list')" class="tab-btn px-4 py-2 text-sm font-medium rounded-t-lg border-b-2 border-transparent text-gray-500 hover:text-gray-700" data-tab="list">list-models</button>
                </nav>
            </div>

            {{-- Tab: analyze --}}
            <div id="tab-analyze" class="tab-content">
                <div class="bg-gray-900 text-green-400 font-mono text-sm rounded-b-lg rounded-tr-lg p-4 overflow-x-auto">
<pre>
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
            → No inverse relationship found on Reaction model
</pre>
                </div>
            </div>

            {{-- Tab: health --}}
            <div id="tab-health" class="tab-content hidden">
                <div class="bg-gray-900 text-green-400 font-mono text-sm rounded-b-lg rounded-tr-lg p-4 overflow-x-auto">
<pre>
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
  3. Define a Reaction model or remove the hasOne from Comment
</pre>
                </div>
            </div>

            {{-- Tab: list-models --}}
            <div id="tab-list" class="tab-content hidden">
                <div class="bg-gray-900 text-green-400 font-mono text-sm rounded-b-lg rounded-tr-lg p-4 overflow-x-auto">
<pre>
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

 Total: <span class="text-indigo-400">6 models</span>, <span class="text-indigo-400">16 relationships</span>
</pre>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function showTab(name) {
    document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));
    document.querySelectorAll('.tab-btn').forEach(el => {
        el.classList.remove('border-indigo-600', 'text-indigo-600', 'bg-white');
        el.classList.add('border-transparent', 'text-gray-500');
    });
    document.getElementById('tab-' + name).classList.remove('hidden');
    const btn = document.querySelector('[data-tab="' + name + '"]');
    btn.classList.add('border-indigo-600', 'text-indigo-600', 'bg-white');
    btn.classList.remove('border-transparent', 'text-gray-500');
}
</script>
@endpush
@endsection
