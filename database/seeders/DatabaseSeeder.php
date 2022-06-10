<?php

namespace Database\Seeders;

use App\Models\Bank;
use App\Models\Customers;
use App\Models\ProductCategory;
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
        Seller::factory(5)->create();
        $this->call(TagSeeder::class);
        $this->call(BankSeeder::class);
        $this->call(AdminSettingSeeder::class);
        $tags = \app\Models\Tag::all();
        $sellers = \App\Models\Seller::all();
        ProductCategory::factory(1)->create();
        Customers::factory(100)->create();
        foreach ($sellers as $seller) {
            $seller->tags()->attach($tags->random(rand(1, 3)));
        }
       
    }
}
