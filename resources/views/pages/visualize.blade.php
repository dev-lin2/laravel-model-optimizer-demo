@extends('layouts.app')

@section('title', 'Visualize - Laravel Model Analyzer')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-12">
    <h1 class="text-3xl font-bold mb-2">Relationship Graph Visualization</h1>
    <p class="text-gray-600 mb-8">Generate interactive, standalone HTML visualizations of your model relationships with a single command.</p>

    {{-- Command Section --}}
    <section class="mb-10">
        <h2 class="text-xl font-bold mb-4">The Command</h2>
        <div class="bg-gray-900 text-green-400 font-mono text-sm rounded-lg p-4 overflow-x-auto">
<pre>$ php artisan model-analyzer:visualize

<span class="text-gray-400">Analyzing model relationships...</span>

<span class="text-green-400">Graph generated: model-relationships.html</span>
  6 models, 16 relationships, health score: 62/100</pre>
        </div>
    </section>

    {{-- Options Table --}}
    <section class="mb-10">
        <h2 class="text-xl font-bold mb-4">Options</h2>
        <div class="overflow-x-auto">
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
                        <td class="px-4 py-2 font-mono text-indigo-600">--output</td>
                        <td class="px-4 py-2">Output file path for the generated HTML</td>
                        <td class="px-4 py-2 text-gray-500">model-relationships.html</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 font-mono text-indigo-600">--models</td>
                        <td class="px-4 py-2">Comma-separated list of model names to include</td>
                        <td class="px-4 py-2 text-gray-500">all</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 font-mono text-indigo-600">--erd</td>
                        <td class="px-4 py-2">Generate an Entity Relationship Diagram instead of a force-directed graph</td>
                        <td class="px-4 py-2 text-gray-500">false</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 font-mono text-indigo-600">--format</td>
                        <td class="px-4 py-2">Output format: <code>html</code> (interactive, D3.js) or <code>svg</code> (static, embeddable)</td>
                        <td class="px-4 py-2 text-gray-500">html</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

    {{-- Example with --models filter --}}
    <section class="mb-10">
        <h2 class="text-xl font-bold mb-4">Filter Specific Models</h2>
        <div class="bg-gray-900 text-green-400 font-mono text-sm rounded-lg p-4 overflow-x-auto">
<pre>$ php artisan model-analyzer:visualize --models=User,Post --output=user-posts.html

<span class="text-gray-400">Analyzing model relationships...</span>

<span class="text-green-400">Graph generated: user-posts.html</span>
  2 models, 8 relationships, health score: 63/100</pre>
        </div>
    </section>

    {{-- Features --}}
    <section class="mb-10">
        <h2 class="text-xl font-bold mb-4">Graph Features</h2>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
            <div class="bg-white border border-gray-200 rounded-lg p-4">
                <div class="text-indigo-600 font-semibold mb-1">Force-Directed Layout</div>
                <p class="text-gray-600 text-sm">Models automatically arrange themselves with physics-based positioning using D3.js.</p>
            </div>
            <div class="bg-white border border-gray-200 rounded-lg p-4">
                <div class="text-indigo-600 font-semibold mb-1">Drag & Zoom</div>
                <p class="text-gray-600 text-sm">Drag nodes to rearrange, scroll to zoom, and pan across the canvas.</p>
            </div>
            <div class="bg-white border border-gray-200 rounded-lg p-4">
                <div class="text-indigo-600 font-semibold mb-1">Color-Coded Status</div>
                <p class="text-gray-600 text-sm">Green for healthy, yellow for warnings, red for errors &mdash; issues visible at a glance.</p>
            </div>
            <div class="bg-white border border-gray-200 rounded-lg p-4">
                <div class="text-indigo-600 font-semibold mb-1">Hover Tooltips</div>
                <p class="text-gray-600 text-sm">Hover over any node to see model details, table name, and specific issues.</p>
            </div>
            <div class="bg-white border border-gray-200 rounded-lg p-4">
                <div class="text-indigo-600 font-semibold mb-1">Curved Link Labels</div>
                <p class="text-gray-600 text-sm">Parallel relationships use curved paths so labels never overlap &mdash; every link is readable.</p>
            </div>
            <div class="bg-white border border-gray-200 rounded-lg p-4">
                <div class="text-indigo-600 font-semibold mb-1">Standalone HTML</div>
                <p class="text-gray-600 text-sm">Zero dependencies &mdash; open the file in any browser, share with your team, or add to docs.</p>
            </div>
        </div>
    </section>

    {{-- Live Preview: Force Graph --}}
    <section class="mb-10">
        <h2 class="text-xl font-bold mb-4">Live Preview: Relationship Graph</h2>
        <p class="text-gray-600 mb-4">This is the actual output generated by running <code class="text-indigo-600 bg-indigo-50 px-1.5 py-0.5 rounded text-sm">php artisan model-analyzer:visualize</code> against the 6 demo models.</p>
        <div class="rounded-lg overflow-hidden border border-gray-200 shadow-sm" style="height: 600px;">
            <iframe src="/model-relationships.html" class="w-full h-full border-0" title="Model Relationship Graph"></iframe>
        </div>
    </section>

    {{-- ERD Section --}}
    <section class="mb-10">
        <h2 class="text-xl font-bold mb-4">Entity Relationship Diagram (ERD)</h2>
        <p class="text-gray-600 mb-4">Use the <code class="text-indigo-600 bg-indigo-50 px-1.5 py-0.5 rounded text-sm">--erd</code> flag to generate a traditional ERD with table boxes, columns, data types, and crow's foot cardinality notation.</p>

        <div class="bg-gray-900 text-green-400 font-mono text-sm rounded-lg p-4 overflow-x-auto mb-4">
<pre>$ php artisan model-analyzer:visualize --erd

<span class="text-gray-400">Analyzing model relationships...</span>

<span class="text-green-400">ERD generated: model-erd.html</span>
  6 models, 16 relationships, health score: 62/100</pre>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-4">
            <div class="bg-white border border-gray-200 rounded-lg p-4">
                <div class="text-indigo-600 font-semibold mb-1">Table Boxes</div>
                <p class="text-gray-600 text-sm">Each model rendered as an SVG table with header, columns, PK/FK icons, and data types.</p>
            </div>
            <div class="bg-white border border-gray-200 rounded-lg p-4">
                <div class="text-indigo-600 font-semibold mb-1">Crow's Foot Notation</div>
                <p class="text-gray-600 text-sm">Industry-standard cardinality markers: one-to-many (1&mdash;*), one-to-one (1&mdash;1), many-to-many (*&mdash;*).</p>
            </div>
            <div class="bg-white border border-gray-200 rounded-lg p-4">
                <div class="text-indigo-600 font-semibold mb-1">Missing Column Detection</div>
                <p class="text-gray-600 text-sm">Columns referenced in relationships but missing from the schema are shown in red with a warning icon.</p>
            </div>
        </div>

        <div class="rounded-lg overflow-hidden border border-gray-200 shadow-sm" style="height: 600px;">
            <iframe src="/model-erd.html" class="w-full h-full border-0" title="Entity Relationship Diagram"></iframe>
        </div>
    </section>

    {{-- SVG Output --}}
    <section class="mb-10">
        <h2 class="text-xl font-bold mb-4">Static SVG Output</h2>
        <p class="text-gray-600 mb-4">Use <code class="text-indigo-600 bg-indigo-50 px-1.5 py-0.5 rounded text-sm">--format=svg</code> to generate static SVG files &mdash; perfect for embedding in docs, presentations, READMEs, or anywhere you need a lightweight, scalable diagram without JavaScript.</p>

        <div class="bg-gray-900 text-green-400 font-mono text-sm rounded-lg p-4 overflow-x-auto mb-4">
<pre>$ php artisan model-analyzer:visualize --format=svg

<span class="text-gray-400">Analyzing model relationships...</span>

<span class="text-green-400">Graph generated: model-relationships.svg</span>
  6 models, 16 relationships, health score: 62/100</pre>
        </div>

        <h3 class="text-lg font-semibold mb-3">Relationship Graph (SVG)</h3>
        <div class="rounded-lg overflow-hidden border border-gray-200 shadow-sm bg-gray-900 p-4 mb-4">
            <img src="/model-relationships.svg" alt="Model Relationship Graph (SVG)" class="w-full h-auto">
        </div>
        <div class="mb-6">
            <a href="/model-relationships.svg" download class="inline-flex items-center gap-2 text-sm text-indigo-600 hover:text-indigo-800 font-medium">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                Download model-relationships.svg
            </a>
        </div>

        <div class="bg-gray-900 text-green-400 font-mono text-sm rounded-lg p-4 overflow-x-auto mb-4">
<pre>$ php artisan model-analyzer:visualize --erd --format=svg

<span class="text-gray-400">Analyzing model relationships...</span>

<span class="text-green-400">ERD generated: model-erd.svg</span>
  6 models, 16 relationships, health score: 62/100</pre>
        </div>

        <h3 class="text-lg font-semibold mb-3">Entity Relationship Diagram (SVG)</h3>
        <div class="rounded-lg overflow-hidden border border-gray-200 shadow-sm bg-gray-900 p-4 mb-4">
            <img src="/model-erd.svg" alt="Entity Relationship Diagram (SVG)" class="w-full h-auto">
        </div>
        <div class="mb-6">
            <a href="/model-erd.svg" download class="inline-flex items-center gap-2 text-sm text-indigo-600 hover:text-indigo-800 font-medium">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                Download model-erd.svg
            </a>
        </div>
    </section>

    {{-- Color Legend --}}
    <section class="mb-10">
        <h2 class="text-xl font-bold mb-4">Node Color Legend</h2>
        <div class="bg-white border border-gray-200 rounded-lg p-6">
            <div class="flex flex-wrap gap-6">
                <div class="flex items-center gap-3">
                    <span class="w-5 h-5 rounded-full bg-green-500 inline-block"></span>
                    <div>
                        <span class="font-semibold text-sm">Green</span>
                        <p class="text-gray-500 text-xs">No issues detected</p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <span class="w-5 h-5 rounded-full bg-yellow-500 inline-block"></span>
                    <div>
                        <span class="font-semibold text-sm">Yellow</span>
                        <p class="text-gray-500 text-xs">Warnings (missing index, missing inverse)</p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <span class="w-5 h-5 rounded-full bg-red-500 inline-block"></span>
                    <div>
                        <span class="font-semibold text-sm">Red</span>
                        <p class="text-gray-500 text-xs">Errors (missing column, missing model)</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
