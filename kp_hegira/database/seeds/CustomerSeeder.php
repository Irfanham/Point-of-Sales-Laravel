<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

		DB::table('customers')->truncate();

		$faker = Faker::create();

		foreach (range(1,20) as $index) {
			$customer[]=[
				'name'=>$faker->name,
				'email'=>$faker->unique()->safeEmail,
				'address'=>"{$faker->streetName} {$faker->postcode} {$faker->city}",
				'contact'=>$faker->phoneNumber,
				'created_at'=> new DateTime,
				'updated_at'=> new DateTime
			];
		}
		DB::table('customers')->insert($customer);
    }
}
