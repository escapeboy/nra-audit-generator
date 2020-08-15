<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class XmlTest extends TestCase
{
    public function testXml(): void
    {
        $shop = $this->mockShop();
        $order = $this->mockOrder();
        $order->addItem($this->mockItem('кифла', 1, 1));
        $order->addItem($this->mockItem('сокче', 1, 1));
        $shop->addOrder($order);

        $returnedOrder = new \Audit\ReturnedOrder(
            '345345345345',
            5.64,
            new DateTime('2020-04-04'),
            \Audit\ReturnMethods\Other::class
        );

        $shop->addReturnedOrder($returnedOrder);

        $xml = \Audit\XmlConverter::convert($shop);
        self::assertXmlStringEqualsXmlFile(__DIR__ . '/stubs/xml_output.stub', (string)$xml);
    }

    private function mockShop(): \Audit\Shop
    {
        return new \Audit\Shop(
            '104056065',
            'RF0000020',
            'viky.com',
            new DateTime('2020-03-24'),
            false,
            2020,
            4
        );
    }

    private function mockOrder(): \Audit\Order
    {
        return new \Audit\Order(
            'WERWERWERFSADFDFGERTER',
            new DateTime('2020-04-13'),
            '1234567890',
            new DateTime('2020-04-13'),
            0,
            \Audit\PaymentTypes\VirtualPOSTerminal::class,
            [],
            '222',
            'AS12k5dD',
            '123123123'
        );
    }

    private function mockItem(string $name, int $quantity, float $price): \Audit\Item
    {
        return new \Audit\Item(
            $name,
            $quantity,
            $price,
            20
        );
    }
}