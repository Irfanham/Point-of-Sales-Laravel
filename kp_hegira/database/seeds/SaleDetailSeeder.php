<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class SaleDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('sale_transactions')->truncate();
        $faker=Faker::create();
        foreach (range(1,20 ) as $index) {
        $detail[]=[
            'quantity'=>$faker->randomDigitNotNull,
            'totalPrice'=>$faker->randomNumber,
            'discount'=>$faker->randomNumber,
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime

        ];

        }
        DB::table('sale_transactions')->insert($detail);
    }

}
