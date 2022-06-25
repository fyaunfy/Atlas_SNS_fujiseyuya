<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class); がコメントアウトしてるので外す。
        $this->call(UsersTableSeeder::class);

        $this->call(PostsTableSeeder::class);
    }
}
