<?php
declare(strict_types=1);

namespace Audit;

class Order
{
    private string $orderUniqueNumber;

    private \DateTime $orderDate;

    private string $documentNumber;

    private \DateTime $documentDate;

    private float $totalDiscount;

    private string $paymentType;

    /**
     * @var Item[]
     */
    private array $items;

    private ?string $virtualPosNumber;

    private ?string $transactionNumber;

    private ?string $paymentProcessorIdentifier;

    public function __construct(
        string $orderUniqueNumber,
        \DateTime $orderDate,
        string $documentNumber,
        \DateTime $documentDate,
        float $totalDiscount,
        string $paymentType,
        array $items,
        ?string $virtualPosNumber,
        ?string $transactionNumber,
        ?string $paymentProcessorIdentifier
    ) {
        $this->orderUniqueNumber = $orderUniqueNumber;
        $this->orderDate = $orderDate;
        $this->documentNumber = $documentNumber;
        $this->documentDate = $documentDate;
        $this->totalDiscount = $totalDiscount;
        $this->paymentType = $paymentType;
        $this->items = $items;
        $this->virtualPosNumber = $virtualPosNumber;
        $this->transactionNumber = $transactionNumber;
        $this->paymentProcessorIdentifier = $paymentProcessorIdentifier;
    }

    /**
     * @return string
     */
    public function getOrderUniqueNumber(): string
    {
        return $this->orderUniqueNumber;
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
    public function getDocumentNumber(): string
    {
        return $this->documentNumber;
    }

    /**
     * @return \DateTime
     */
    public function getDocumentDate(): \DateTime
    {
        return $this->documentDate;
    }

    /**
     * @return float
     */
    public function getTotalDiscount(): float
    {
        return $this->totalDiscount;
    }

    /**
     * @return string
     */
    public function getPaymentType(): string
    {
        return $this->paymentType;
    }

    /**
     * @return array
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @return string|null
     */
    public function getVirtualPosNumber(): ?string
    {
        return $this->virtualPosNumber;
    }

    /**
     * @return string|null
     */
    public function getTransactionNumber(): ?string
    {
        return $this->transactionNumber;
    }

    /**
     * @return string|null
     */
    public function getPaymentProcessorIdentifier(): ?string
    {
        return $this->paymentProcessorIdentifier;
    }

    public function addItem(Item $item): void
    {
        $this->items[] = $item;
    }

    public function getTotalWithoutVat(): float
    {
        $total = 0;
        foreach($this->items as $item){
            $total+=$item->getPrice();
        }

        return $total; //TODO apply discount
    }

    public function getOrderTotalVat()
    {
        $total = 0;
        foreach($this->items as $item){
            $total+=$item->getVat();
        }

        return $total;
    }

    public function getOrderTotal()
    {
        $total = 0;
        foreach($this->items as $item){
            $total+=$item->getFinalPrice();
        }

        return $total; //TODO apply discount
    }
}