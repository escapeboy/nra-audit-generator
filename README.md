# NRA Orders Audit XML File Generator

## Usage:
```php
$shop = new \Odit\Shop($eik, $shopUniqueNumber, $domain, $shopCreatedAt, $isMarketplace, $yearOfOdit, $monthOfOdit);
$order = new \Odit\Order($orderUniqueNumber, $orderDate, $documentNumber, $documentDate, $totalDiscount, $paymentType, $items, $virtualPosNumber, $transactionNumber, $paymentProcessrIdentifier);
$item = new \Odit\Item($name, $quantity, $price, $vatRate = 20);
$order->addItem($item);
$shop->addOrder($order);
$returnedOrder = new \Odit\ReturnedOrder($orderNumber, $orderAmount, $orderDate, $returnMethod);
$shop->addReturnedOrder($returnedOrder);

$xml = (string) \Odit\XmlConverter::convert($shop);
```
## Payment types
```php
\Odit\PaymentTypes\WithoutPostPayment::class; //1
\Odit\PaymentTypes\VirtualPOSTerminal::class; //2
\Odit\PaymentTypes\WithPostPayment::class; //3
\Odit\PaymentTypes\PaymentService::class; //4
\Odit\PaymentTypes\Other::class; //5
```

## Return methods
```php
\Odit\ReturnMethods\IBAN::class; //1
\Odit\ReturnMethods\Card::class; //2
\Odit\ReturnMethods\Cash::class; //3
\Odit\ReturnMethods\Other::class; //4
```

Hey! You can send me money on Revolut by following this link: 
https://pay.revolut.com/profile/nukolaqzi