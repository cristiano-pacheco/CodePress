<?php

use Illuminate\Database\Seeder;
use CodePress\CodeCategory\Models\Category;

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
    }
}
