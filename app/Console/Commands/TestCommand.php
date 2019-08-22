<?php


namespace App\Console\Commands;


use App\Models\Product;
use Mathrix\Lumen\Zero\Console\Commands\BaseCommand;

class TestCommand extends BaseCommand
{
    protected $signature = "test";

    public function handle()
    {
        $urljson = "%5B%7B%22stock_id%22%3A1%2C%22quantity%22%3A3%7D%5D";
        $array = json_decode(urldecode($urljson), true);
        $serialize = serialize($urljson);

        dd($array, [$urljson, strlen($urljson)], [$serialize, strlen($serialize)]);
    }
}
