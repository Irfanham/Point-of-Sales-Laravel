<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PurchaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('purchase_transactions')->truncate();

        $faker=Faker::create();
        foreach (range(1,20) as $index) {
        	$purchase[]=[
        		'quantity'=>$faker->randomDigitNotNull,
        		'unitPrice'=>$faker->randomNumber,
        		'totalPrice'=>$faker->randomNumber,
        		'date_time'=>new DateTime,
        		'created_at'=> new DateTime,
        		'updated_at'=> new DateTime
        	];
        }

        DB::table('purchase_transactions')->insert($purchase);
    }
}
