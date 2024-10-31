<?php

namespace Database\Seeders;

use App\Models\Notes;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NotesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker =  \Faker\Factory::create();
        for ($i = 0; $i < 20; $i ++) {
            Notes::create([
                'title' => $faker->title(),
                'content' => $faker->paragraph,
                'user_id' => $faker->numberBetween(1,20)
            ]);
        }

    }
}
