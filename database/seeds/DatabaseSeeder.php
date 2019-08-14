<?php

use App\Models\Address;
use App\Models\User;
use Mathrix\Lumen\Zero\Database\BaseTableSeeder;

class DatabaseSeeder extends BaseTableSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->seedFromFactory(User::class, ["count" => 20]);
        $this->seedFromFactory(Address::class, ["count" => 40]);
        $this->seedFromCsv("products");
        $this->call(StocksSeeder::class);
    }
}
