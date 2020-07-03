<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Mathrix\Lumen\Zero\Database\BaseTableSeeder;

class StocksSeeder extends BaseTableSeeder
{
    public function run()
    {
        $stocks  = [];
        $tshirts = DB::table('products')
            ->select('id')
            ->where('type', '=', 'T-shirt')
            ->pluck('id');
        foreach ($tshirts as $productId) {
            foreach (["S", "M", "L"] as $size) {
                $stocks[] = [
                    "price"               => 4969,
                    "size"                => $size,
                    "inventory"           => 10,
                    "available_inventory" => 10,
                    "product_id"          => $productId,
                    "created_at"          => Carbon::now(),
                    "updated_at"          => Carbon::now(),
                ];
            }
        }

        $stocks[] = [
            "price"               => 1969,
            "size"                => null,
            "inventory"           => 6,
            "available_inventory" => 6,
            "product_id"          => 7,
            "created_at"          => Carbon::now(),
            "updated_at"          => Carbon::now(),
        ];

        $this->output->writeln("<comment>Seeding:</comment> stocks from generation");
        $this->seedFromArray($stocks, "stocks");
    }
}
