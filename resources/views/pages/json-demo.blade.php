@extends('layouts.app')

@section('title', 'JSON Output - Laravel Model Analyzer')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-12">
    <h1 class="text-3xl font-bold mb-2">JSON Output</h1>
    <p class="text-gray-600 mb-8">Use <code class="bg-gray-100 text-indigo-600 px-1.5 py-0.5 rounded text-sm">--format=json</code> to get machine-readable output, perfect for CI/CD pipelines.</p>

    {{-- Usage --}}
    <div class="bg-gray-900 text-green-400 font-mono text-sm rounded-lg p-4 mb-8">
        <p>$ php artisan model-analyzer:analyze --format=json</p>
    </div>

    {{-- Explanation --}}
    <div class="bg-indigo-50 border border-indigo-200 rounded-lg p-5 mb-8">
        <h3 class="font-bold text-indigo-900 mb-2">CI/CD Integration</h3>
        <p class="text-indigo-800 text-sm">The JSON output includes a top-level <code class="bg-indigo-100 px-1 rounded">health_score</code> field. You can parse this in your pipeline and fail the build if the score drops below your threshold. Combine with <code class="bg-indigo-100 px-1 rounded">--strict</code> to get a non-zero exit code on any issue.</p>
    </div>

    {{-- JSON Block --}}
    <div class="relative">
        <button onclick="copyJson()" id="copy-btn" class="absolute top-3 right-3 bg-gray-700 hover:bg-gray-600 text-gray-300 text-xs px-3 py-1.5 rounded transition">
            Copy
        </button>
        <pre><code class="language-json" id="json-output">{
  "health_score": 62,
  "rating": "FAIR",
  "models_scanned": 6,
  "total_relationships": 16,
  "issues": {
    "errors": [
      {
        "model": "Product",
        "relationship": "belongsTo(Category)",
        "type": "missing_column",
        "message": "Column `category_id` not found on `products` table",
        "severity": "error"
      }
    ],
    "warnings": [
      {
        "model": "Post",
        "column": "editor_id",
        "type": "missing_index",
        "message": "Column `editor_id` has no index (performance risk)",
        "severity": "warning"
      },
      {
        "model": "Comment",
        "relationship": "hasOne(Reaction)",
        "type": "missing_inverse",
        "message": "No inverse relationship found on Reaction model",
        "severity": "warning"
      }
    ]
  },
  "breakdown": {
    "inverse_relationships": { "score": 30, "max": 30 },
    "no_circular_deps": { "score": 30, "max": 30 },
    "column_existence": { "score": 10, "max": 20 },
    "foreign_key_indexes": { "score": 8, "max": 10 },
    "foreign_key_constraints": { "score": 4, "max": 10 }
  },
  "models": [
    { "name": "User", "namespace": "App\\Models\\User", "relationships": 4, "status": "ok" },
    { "name": "Post", "namespace": "App\\Models\\Post", "relationships": 4, "status": "warning" },
    { "name": "Comment", "namespace": "App\\Models\\Comment", "relationships": 3, "status": "warning" },
    { "name": "Tag", "namespace": "App\\Models\\Tag", "relationships": 1, "status": "ok" },
    { "name": "Order", "namespace": "App\\Models\\Order", "relationships": 2, "status": "ok" },
    { "name": "Product", "namespace": "App\\Models\\Product", "relationships": 2, "status": "error" }
  ]
}</code></pre>
    </div>

    {{-- Pipeline Example --}}
    <h2 class="text-xl font-bold mt-10 mb-4">Example: GitHub Actions</h2>
    <pre><code class="language-yaml">- name: Check model health
  run: |
    SCORE=$(php artisan model-analyzer:analyze --format=json | jq '.health_score')
    if [ "$SCORE" -lt 80 ]; then
      echo "Health score $SCORE is below threshold (80)"
      exit 1
    fi</code></pre>
</div>

@push('scripts')
<script>
function copyJson() {
    const text = document.getElementById('json-output').textContent;
    navigator.clipboard.writeText(text).then(() => {
        const btn = document.getElementById('copy-btn');
        btn.textContent = 'Copied!';
        setTimeout(() => btn.textContent = 'Copy', 2000);
    });
}
</script>
@endpush
@endsection
