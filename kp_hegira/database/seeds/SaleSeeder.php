<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class SaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('sale_details')->truncate();

        $faker=Faker::create();
        foreach (range(1,20) as $index) {
        	$sale[]=[
        		'purchase'=>$faker->randomNumber,
        		'created_at'=> new DateTime,
        		'updated_at'=> new DateTime
        	];
        }

        DB::table('sale_details')->insert($sale);
    }
}
