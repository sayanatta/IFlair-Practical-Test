<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::factory()->count(5)
            ->state(new Sequence(
                fn ($sequence) => ['user_id' => User::get()->random(), 'category_id' => Category::get()->random()],
            ))->create();
    }
}
