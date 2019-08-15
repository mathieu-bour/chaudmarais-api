<?php


namespace App\Console\Commands;


use App\Models\Product;
use Mathrix\Lumen\Zero\Console\Commands\BaseCommand;

class TestCommand extends BaseCommand
{
    protected $signature = "test";

    public function handle()
    {
        $products = Product::all()->map(function (Product $p) {
            $p->images = [
                "https://cdn.chaudmarais.fr/img/products/{$p->id}/male-front.jpg",
                "https://cdn.chaudmarais.fr/img/products/{$p->id}/female-front.jpg",
                "https://cdn.chaudmarais.fr/img/products/{$p->id}/male-3_4.jpg",
                "https://cdn.chaudmarais.fr/img/products/{$p->id}/female-3_4.jpg",
                "https://cdn.chaudmarais.fr/img/common/male-back.jpg",
                "https://cdn.chaudmarais.fr/img/common/female-back.jpg",
            ];
            $p->description = "100 % coton bio\nConçu, dessinés et brodés en France\nCoupe unisexe\n\nRime et Axel portent une taille M";

            $p->setAppends([]);
            return $p;
        });

        $this->output->writeln(json_encode($products, JSON_PRETTY_PRINT));
    }
}
