<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
           //
        DB::table('payments')->truncate();

        $faker=Faker::create();
        foreach (range(1,20) as $index) {
        	$payment[]=[
        		'PaymentAmount'=>$faker->randomNumber,
        		'PaymentDate'=>new DateTime,
        		'created_at'=> new DateTime,
        		'updated_at'=> new DateTime
        	];
        }

        DB::table('payments')->insert($payment);
    }
}
