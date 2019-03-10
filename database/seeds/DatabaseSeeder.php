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
      factory(App\Models\User::class, 25)->create()->each(function ($u) {
        for ($i=0; $i <= 3; $i++) {
          $u->posts()->save(factory(App\Models\Post::class)->make());
        }  
      });
    }
}
