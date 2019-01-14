<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
		$this->call(CustomerSeeder::class);
        $this->call(SupplierSeeder::class);
        $this->call(WarehouseSeeder::class);
        $this->call(EmployeeSeeder::class);
        $this->call(SaleSeeder::class);
        $this->call(PurchaseSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(SaleDetailSeeder::class);
        $this->call(PaymentSeeder::class);
        $this->call(PaymentMethodSeeder::class);
    }
}
