<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {



        //
        DB::table('suppliers')->truncate();

		$faker = Faker::create();


		foreach (range(1,20) as $index) {
			$supplier[]=[
				'name'=>$faker->name,
				'email'=>$faker->unique()->safeEmail,
				'contact'=>$faker->phoneNumber,
				'created_at'=> new DateTime,
				'updated_at'=> new DateTime
			];
		}
		DB::table('suppliers')->insert($supplier);
    }
    
}
