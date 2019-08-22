<?php

use App\Models\Address;
use App\Models\User;
use Mathrix\Lumen\Zero\Database\BaseTableSeeder;
use Stripe\Customer;

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
        $this->seedFromFactory(Address::class, ["count" => 5]);
        $this->seedFromJson("products");
        $this->call(StocksSeeder::class);

        /** @var User $admin */
        $admin = User::query()->findOrFail(1);
        $admin->email = "admin@chaudmarais.fr";
        $admin->scopes = ["*"];
        $admin->save();

        /** @var User $client */
        $client = User::query()->findOrFail(2);
        $customer = Customer::create([
            "name" => "Jean Dupont",
            "email" => "client@chaudmarais.fr"
        ]);
        $client->stripe_id = $customer->id;
        $client->first_name = "Jean";
        $client->last_name = "Dupont";
        $client->email = "client@chaudmarais.fr";
        $client->save();
    }
}
