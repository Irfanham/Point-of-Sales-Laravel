<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('paymentmethods')->truncate();

        $faker=Faker::create();
        foreach (range(1,20) as $index) {
        	$paymentmethod[]=[
        		'PaymentMethod'=>$faker->creditCardType,
        		'CreditCardNumber'=>$faker->creditCardNumber,
        		'CardholdersName'=>$faker->name,
        		'CreditCardExpDate'=>$faker->creditCardExpirationDate,
        		'created_at'=> new DateTime,
        		'updated_at'=> new DateTime
        	];
        }

        DB::table('paymentmethods')->insert($paymentmethod);
    }
}
