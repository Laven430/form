<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category; // Category モデルをインポート

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create(['name' => '商品の交換について']);
        Category::create(['name' => 'その他のお問い合わせ']);
    }
}