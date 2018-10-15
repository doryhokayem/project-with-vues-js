<?php

use Illuminate\Database\Seeder;

class CreateCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // factory(App\Category::class, 5)->create();
        $categories = [];
        for ($i = 0; $i < 3; $i++) {
            $categories[] = [
                'name' => str_random(10),
                'description' => str_random(10),
            ];
        }
        DB::table('categories')->insert($categories);
    }
}
