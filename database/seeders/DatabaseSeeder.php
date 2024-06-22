<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\PostUserLike;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create(
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'email_verified_at' => now(),
                'password' => 'test1234',
                'avatar' => 'https://streetphotography.com/wp-content/uploads/2017/08/test.png',
                'role' => 0
            ]
        );

        $categories = Category::factory(10)->create();

        $categories->each(function (Category $category) {
            $posts = Post::factory(rand(1, 5))->create(['category_id' => $category->id]);
            $posts->each(function (Post $post) {
                $tags = Tag::factory(rand(1, 5))->create();
                $post->tags()->sync($tags);

                $users = User::factory(rand(5, 10))->create();

                $users->each(function (User $user) use ($post) {
                    Comment::factory()->create(['user_id' => $user->id, 'post_id' => $post->id]);
                    PostUserLike::factory(1)->create(['user_id' => $user->id, 'post_id' => $post->id]);
                });
            });
        });
    }
}
