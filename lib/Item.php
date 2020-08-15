<?php
declare(strict_types=1);

namespace Odit;

class Item
{
    private string $name;

    private float $quantity;

    private float $price;

    private int $vatRate;

    public function __construct(
        string $name,
        float $quantity,
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
     * @return float
     */
    public function getQuantity(): float
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

    public function getVat(): float
    {
        return $this->vatRate * $this->price / 100;
    }

    public function getFinalPrice(): float
    {
        return $this->price * 1+($this->vatRate / 100);
    }
}