<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Order;
use App\Models\Post;
use App\Models\Product;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;

class DemoSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::factory(3)->create();

        $tags = collect(['Laravel', 'PHP', 'Eloquent', 'Testing', 'Performance'])
            ->map(fn ($name) => Tag::create(['name' => $name]));

        $posts = collect();
        foreach (range(1, 5) as $i) {
            $post = Post::create([
                'user_id' => $users->random()->id,
                'editor_id' => $users->random()->id,
                'title' => "Demo Post #{$i}",
                'body' => "This is the body content for demo post #{$i}. It demonstrates the model analyzer package.",
            ]);
            $post->tags()->attach($tags->random(rand(1, 3))->pluck('id'));
            $posts->push($post);
        }

        foreach (range(1, 10) as $i) {
            Comment::create([
                'user_id' => $users->random()->id,
                'post_id' => $posts->random()->id,
                'body' => "This is demo comment #{$i}.",
            ]);
        }

        foreach (range(1, 2) as $i) {
            $order = Order::create([
                'user_id' => $users->random()->id,
                'total' => rand(50, 500),
                'status' => $i === 1 ? 'completed' : 'pending',
            ]);

            foreach (range(1, 3) as $j) {
                Product::create([
                    'order_id' => $order->id,
                    'name' => "Product {$i}-{$j}",
                    'price' => rand(10, 100),
                    'quantity' => rand(1, 5),
                ]);
            }
        }
    }
}
