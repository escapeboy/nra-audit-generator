<?php
declare(strict_types=1);

namespace Odit;

class ReturnedOrder
{
    private string $orderNumber;

    private float $orderAmount;

    private \DateTime $orderDate;

    private string $returnMethod;

    public function __construct(
        string $orderNumber,
        float $orderAmount,
        \DateTime $orderDate,
        string $returnMethod
    ) {
        $this->orderNumber = $orderNumber;
        $this->orderAmount = $orderAmount;
        $this->orderDate = $orderDate;
        $this->returnMethod = $returnMethod;
    }

    /**
     * @return string
     */
    public function getOrderNumber(): string
    {
        return $this->orderNumber;
    }

    /**
     * @return float
     */
    public function getOrderAmount(): float
    {
        return $this->orderAmount;
    }

    /**
     * @return \DateTime
     */
    public function getOrderDate(): \DateTime
    {
        return $this->orderDate;
    }

    /**
     * @return string
     */
    public function getReturnMethod(): string
    {
        return $this->returnMethod;
    }
}