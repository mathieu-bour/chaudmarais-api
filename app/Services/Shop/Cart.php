<?php


namespace App\Services\Shop;


use App\Models\Stock;

class Cart implements \JsonSerializable
{
    private $content;

    public function __construct(array $content)
    {
        $this->content = collect($content)->map(function ($line) {
            return [
                "quantity" => $line["quantity"],
                "stock" => Stock::query()->with("product")
                    ->findOrFail($line["stock_id"])
            ];
        });
    }

    /**
     * Get the cart total in cents
     *
     * @return int
     */
    public function getTotal(): int
    {
        $this->content->sum(function ($line) {
            /** @var Stock $stock */
            $stock = $line["stock"];
            return $stock->price;
        });
    }


    public function jsonSerialize()
    {
        return $this->content;
    }
}
