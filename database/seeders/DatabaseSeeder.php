<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\PostCategory;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);
        $role = Role::create(['name' => 'super-admin']);
        $user = User::where('name', 'admin')->where('email', 'admin@gmail.com')->first();
        $user->assignRole('super-admin');
        
        \App\Models\Category::factory(10)->create();

        \App\Models\Product::factory(20)->create();
        $category = Category::all();
        \App\Models\Product::all()->each(function($product) use ($category){
            $product->categories()->attach(
                $category->random(rand(1, 3))->pluck('id')->toArray()
            );
            \App\Models\ProductImage::factory(4)->create(['product_id' => $product->id]);
        });
        \App\Models\Slider::factory(5)->create();

        \App\Models\PostCategory::factory(10)->create();

        \App\Models\Post::factory(20)->create();

        $category = PostCategory::all();
        
        \App\Models\Post::all()->each(function($post) use ($category){
            $post->categories()->attach(
                $category->random(rand(1, 3))->pluck('id')->toArray()
            );
        });
    }
}
