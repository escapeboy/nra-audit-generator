<?php
declare(strict_types=1);

namespace Odit;

class Item
{
    private string $name;

    private int $quantity;

    private float $price;

    private int $vatRate;

    public function __construct(
        string $name,
        int $quantity,
        float $price,
        int $vatRate = 20
    ) {
        $this->name = $name;
        $this->quantity = $quantity;
        $this->price = $price;
        $this->vatRate = $vatRate;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @return int
     */
    public function getVatRate(): int
    {
        return $this->vatRate;
    }
}