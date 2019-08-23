<?php


namespace App\Services\Shop;


use App\Models\Product;
use App\Models\Stock;
use Illuminate\Support\Collection;

class Cart
{
    /** @var Collection */
    private $items;
    private $shippingPrice = 630;

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

    public static function fromString($string): Cart
    {
        $content = collect(explode("|", $string))
            ->map(function ($itemString) {
                [$stockId, $quantity] = explode(",", $itemString);

                return [
                    "stock_id" => $stockId,
                    "quantity" => $quantity
                ];
            })
            ->toArray();

        return new Cart($content);
    }

    public function __toString(): string
    {
        $string = $this->items
            ->map(function ($item) {
                return "{$item["stock"]->id},{$item["quantity"]}";
            })
            ->implode("|");

        return $string;
    }

    public function getItems()
    {
        return $this->items;
    }

    /**
     * Get the cart subtotal in cents
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

    /**
     * Get the shipping price in cents
     *
     * @return int
     */
    public function getShippingPrice(): int
    {
        return $this->shippingPrice;
    }


    /**
     * Get the cart total in cents
     *
     * @return int
     */
    public function getTotal(): int
    {
        return $this->getSubtotal() + $this->shippingPrice;
    }
}
