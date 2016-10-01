<?php

use Illuminate\Database\Seeder;
use CodePress\CodeCategory\Models\Category;
use CodePress\CodePost\Models\Post;
use CodePress\CodePost\Models\Comment;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        factory(Category::class)->times(5)->create();

        factory(Post::class)
            ->times(5)
            ->create(function ($post) {

                foreach (range(1, 10) as $value) {

                    $post->comments()
                        ->save(
                            factory(Comment::class)->make()
                        );

                }
            });

        $this->command->info("Finished Seeders!");
    }
}
