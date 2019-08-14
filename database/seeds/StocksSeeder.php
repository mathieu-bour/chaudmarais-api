<?php


use Carbon\Carbon;
use Mathrix\Lumen\Zero\Database\BaseTableSeeder;

class StocksSeeder extends BaseTableSeeder
{
    public function run()
    {
        $productIds = range(1, 6);
        $stocks = [];
        foreach ($productIds as $productId) {
            foreach (["S", "M", "L"] as $size) {
                $stocks[] = [
                    "price" => 4969,
                    "size" => $size,
                    "inventory" => 15,
                    "available_inventory" => 15,
                    "product_id" => $productId,
                    "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ];
            }
        }

        $stocks[] = [
            "price" => 1969,
            "size" => null,
            "inventory" => 6,
            "available_inventory" => 6,
            "product_id" => 7,
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now()
        ];

        $this->output->writeln("<comment>Seeding:</comment> stocks from generation");
        $this->seedFromArray($stocks, "stocks");
    }
}
