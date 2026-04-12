<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Order;
use App\Models\Post;
use App\Models\Product;
use App\Models\Tag;
use App\Models\User;

class DemoController extends Controller
{
    public function index()
    {
        return view('pages.index');
    }

    public function demo()
    {
        $models = [
            [
                'name' => 'User',
                'namespace' => 'App\\Models\\User',
                'relationships' => ['posts (hasMany)', 'comments (hasMany)', 'orders (hasMany)'],
                'status' => 'ok',
                'issues' => [],
            ],
            [
                'name' => 'Post',
                'namespace' => 'App\\Models\\Post',
                'relationships' => ['user (belongsTo)', 'editor (belongsTo)', 'comments (hasMany)', 'tags (belongsToMany)'],
                'status' => 'warning',
                'issues' => ['Missing index on `editor_id`'],
            ],
            [
                'name' => 'Comment',
                'namespace' => 'App\\Models\\Comment',
                'relationships' => ['user (belongsTo)', 'post (belongsTo)', 'reaction (hasOne)'],
                'status' => 'warning',
                'issues' => ['Reaction inverse missing — model does not exist'],
            ],
            [
                'name' => 'Tag',
                'namespace' => 'App\\Models\\Tag',
                'relationships' => ['posts (belongsToMany)'],
                'status' => 'ok',
                'issues' => [],
            ],
            [
                'name' => 'Order',
                'namespace' => 'App\\Models\\Order',
                'relationships' => ['user (belongsTo)', 'products (hasMany)'],
                'status' => 'ok',
                'issues' => [],
            ],
            [
                'name' => 'Product',
                'namespace' => 'App\\Models\\Product',
                'relationships' => ['order (belongsTo)', 'category (belongsTo)'],
                'status' => 'error',
                'issues' => ['Foreign key column `category_id` does not exist'],
            ],
        ];

        return view('pages.demo', compact('models'));
    }

    public function commands()
    {
        return view('pages.commands');
    }

    public function config()
    {
        return view('pages.config');
    }

    public function jsonDemo()
    {
        return view('pages.json-demo');
    }

    public function visualize()
    {
        return view('pages.visualize');
    }
}
