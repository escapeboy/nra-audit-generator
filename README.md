# NRA Orders Audit XML File Generator

## Install
`composer require escapeboy/nra-audit-generator`

## Usage
```php
$shop = new \Audit\Shop($eik, $shopUniqueNumber, $domain, $shopCreatedAt, $isMarketplace, $yearOfOdit, $monthOfOdit);
$order = new \Audit\Order($orderUniqueNumber, $orderDate, $documentNumber, $documentDate, $totalDiscount, $paymentType, $items, $virtualPosNumber, $transactionNumber, $paymentProcessrIdentifier);
$item = new \Audit\Item($name, $quantity, $price, $vatRate = 20);
$order->addItem($item);
$shop->addOrder($order);
$returnedOrder = new \Audit\ReturnedOrder($orderNumber, $orderAmount, $orderDate, $returnMethod);
$shop->addReturnedOrder($returnedOrder);

$xml = (string) \Audit\XmlConverter::convert($shop);
```
## Payment types
```php
\Audit\PaymentTypes\WithoutPostPayment::class; //1
\Audit\PaymentTypes\VirtualPOSTerminal::class; //2
\Audit\PaymentTypes\WithPostPayment::class; //3
\Audit\PaymentTypes\PaymentService::class; //4
\Audit\PaymentTypes\Other::class; //5
```

## Return methods
```php
\Audit\ReturnMethods\IBAN::class; //1
\Audit\ReturnMethods\Card::class; //2
\Audit\ReturnMethods\Cash::class; //3
\Audit\ReturnMethods\Other::class; //4
```

Hey! You can send me money on Revolut by following this link: 
https://pay.revolut.com/profile/nukolaqzi