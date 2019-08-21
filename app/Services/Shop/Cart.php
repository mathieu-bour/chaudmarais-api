<?php


namespace App\Services\Shop;


use App\Models\Product;
use App\Models\Stock;
use Illuminate\Support\Collection;

class Cart implements \JsonSerializable
{
    /** @var Collection */
    private $items;
    private $shippingCost = 630;

    public function __construct(array $content)
    {
        $this->items = collect($content)->map(function ($line) {
            /** @var Stock $stock */
            $stock = Stock::query()->findOrFail($line["stock_id"]);
            $product = Product::query()->findOrFail($stock->product_id);

            return [
                "quantity" => $line["quantity"],
                "stock" => $stock,
                "product" => $product
            ];
        });
    }

    /**
     * Get the cart total in cents
     *
     * @return int
     */
    public function getSubtotal(): int
    {
        return $this->items->sum(function ($line) {
            /** @var Stock $stock */
            $stock = $line["stock"];
            return $stock->price;
        });
    }

    public function getTotal(): int
    {
        return $this->getSubtotal() + $this->shippingCost;
    }


    public function jsonSerialize()
    {
        $minified = [];

        foreach ($this->items as $item) {
            $minified[$item["stock"]->id] = $item["quantity"];
        }

        return $minified;
    }
}
