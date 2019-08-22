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
//        $this->seedFromFactory(User::class, ["count" => 20]);
//        $this->seedFromFactory(Address::class, ["count" => 40]);
        $this->seedFromJson("products");
        $this->call(StocksSeeder::class);

//        $admin = User::query()->findOrFail(1);
//        $admin->update(["email" => "admin@chaudmarais.fr"]);
//        $client = User::query()->findOrFail(2);
//        $client->update(["email" => "client@chaudmarais.fr"]);
    }
}
