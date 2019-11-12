<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $deepPosts = DB::table('deep_posts')->get();
        foreach ($deepPosts as $p) {
            DB::table('posts')->insert((array) $p);
        }
    }
}
