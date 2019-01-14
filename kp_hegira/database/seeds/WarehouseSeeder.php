<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class WarehouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('warehouses')->truncate();

        $faker=Faker::create();
        foreach (range(1,20) as $index) {
        	$warehouse[]=[
        		'name'=>$faker->name,
        		'img'=>$faker->imageUrl($width =640, $height=480, 'cats'),
        		'stock'=>$faker->randomDigitNotNull,
                'unitPrice'=>$faker->randomNumber,
        		'created_at'=> new DateTime,
        		'updated_at'=> new DateTime
        	];
        }

        DB::table('warehouses')->insert($warehouse);
    }
}
