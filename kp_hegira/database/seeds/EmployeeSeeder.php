<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('employees')->truncate();

        $faker = Faker::create();
        foreach (range(1,20)as$index) {
        	$employee[]=[
        		'name'=>$faker->name,
        		'email'=>$faker->unique()->safeEmail,
        		'password'=>$faker->unique()->password,
        		'status'=>$faker->boolean($chanceOfGettingTrue = 50),
        		'contact'=>$faker->phoneNumber,
        		'created_at'=>new DateTime,
        		'updated_at'=>new DateTime
        	];
        }
        DB::table('employees')->insert($employee);
    }
}
