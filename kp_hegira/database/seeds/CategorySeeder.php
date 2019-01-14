<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('categories')->truncate();
        $faker=Faker::create();

        foreach (range(1,20) as $index) {
        	$category[]=[
        		'category'=>$faker->name,
        		'created_at'=> new DateTime,
				'updated_at'=> new DateTime
        	];
        }
        DB::table('categories')->insert($category);
    }
}
