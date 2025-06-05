<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contact;
use App\Models\Category;
use Faker\Factory as Faker;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('ja_JP');
        $categoryIds = Category::pluck('id')->toArray();
        if (empty($categoryIds)) {
            $this->command->info('Please run CategorySeeder first.');
            return;
        }

        for ($i = 0; $i < 50; $i++) {
            Contact::create([
                'category_id' => $faker->randomElement($categoryIds),
                'first_name' => $faker->lastName,
                'last_name' => $faker->firstName,
                'gender' => $faker->randomElement([1, 2, 3]),
                'email' => $faker->unique()->safeEmail,
                'tel' => $faker->phoneNumber,
                'address' => $faker->address,
                'building' => $faker->boolean(50) ? $faker->secondaryAddress : null,
                'detail' => $faker->realText(100),
                'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
                'updated_at' => $faker->dateTimeBetween('-1 year', 'now'),
            ]);
        }
    }
}