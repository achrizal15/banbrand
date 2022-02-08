<?php

namespace Database\Seeders;

use App\Models\Seller;
use App\Models\Tag;
use Illuminate\Database\Seeder;

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
        Seller::factory(50)->create();
    $this->call(TagSeeder::class);
     $tags=\app\Models\Tag::all();
     $sellers=\App\Models\Seller::all();
     
        foreach ($sellers as $seller) {
            $seller->tags()->attach($tags->random(rand(1,3)));
        }
    }
}
