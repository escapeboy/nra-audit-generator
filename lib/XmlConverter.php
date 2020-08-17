<?php
declare(strict_types=1);

namespace Audit;

class XmlConverter
{
    private \XMLWriter $xml;

    private function __construct(\XMLWriter $xml)
    {
        $this->xml = $xml;
    }

    public static function convert(Shop $shop): self
    {
        $xml = new \XMLWriter();
        $xml->openMemory();
        $xml->setIndent(true);
        $xml->startDocument('1.0', 'windows-1251');
        $xml->startElement('audit');
        $xml->writeElement('eik', $shop->getEik());
        $xml->writeElement('e_shop_n', $shop->getShopUniqueNumber());
        $xml->writeElement('domain_name', $shop->getDomain());
        $xml->writeElement('creation_date', $shop->getFileCreatedAt()->format('Y-m-d'));
        $xml->writeElement('mon', str_pad((string)$shop->getMonth(), 2, '0', STR_PAD_LEFT));
        $xml->writeElement('god', (string)$shop->getYear());
        $xml->writeElement('e_shop_type', $shop->isMarketplace() ? '2' : '1');
        $xml->startElement('order');
        foreach ($shop->getOrders() as $order) {
            $xml->startElement('orderenum');
            $xml->writeElement('ord_n', $order->getOrderUniqueNumber());
            $xml->writeElement('ord_d', $order->getOrderDate()->format('Y-m-d'));
            $xml->writeElement('doc_n', $order->getDocumentNumber());
            $xml->writeElement('doc_date', $order->getDocumentDate()->format('Y-m-d'));

            $xml->startElement('art');
            foreach ($order->getItems() as $item) {
                $xml->startElement('artenum');
                $xml->writeElement('art_name', $item->getName());
                $xml->writeElement('art_quant', (string)$item->getQuantity());
                $xml->writeElement('art_price', (string)$item->getPrice());
                $xml->writeElement('art_vat_rate', (string)$item->getVatRate());
                $xml->writeElement('art_vat', (string)$item->getVat());
                $xml->writeElement('art_sum', number_format($item->getFinalPrice(), 2));
                $xml->endElement();
            }
            $xml->endElement();

            $xml->writeElement('ord_total1', (string)$order->getTotalWithoutVat());
            $xml->writeElement('ord_disc', (string)$order->getTotalDiscount());
            $xml->writeElement('ord_vat', (string)$order->getOrderTotalVat());
            $xml->writeElement('ord_total2', number_format($order->getOrderTotal(), 2));
            $xml->writeElement('paym', (string)$order->getPaymentType()::CODE);
            if ($order->getVirtualPosNumber()) {
                $xml->writeElement('pos_n', $order->getVirtualPosNumber());
            }
            if ($order->getTransactionNumber()) {
                $xml->writeElement('trans_n', $order->getTransactionNumber());
            }
            if ($order->getPaymentProcessorIdentifier()) {
                $xml->writeElement('proc_id', $order->getPaymentProcessorIdentifier());
            }

            $xml->endElement();
        }
        $xml->endElement();

        $xml->writeElement('r_ord', (string)count($shop->getReturnedOrders()));
        $xml->writeElement('r_total', number_format($shop->getTotalAmountReturnedOrders(), 2));

        if (count($shop->getReturnedOrders())) {
            $xml->startElement('rorder');
            foreach ($shop->getReturnedOrders() as $returnedOrder) {
                $xml->startElement('rorderenum');
                $xml->writeElement('r_ord_n', $returnedOrder->getOrderNumber());
                $xml->writeElement('r_amount', number_format($returnedOrder->getOrderAmount(), 2));
                $xml->writeElement('r_date', $returnedOrder->getOrderDate()->format('Y-m-d'));
                $xml->writeElement('r_paym', (string)$returnedOrder->getReturnMethod()::CODE);
                $xml->endElement();
            }
            $xml->endElement();
        }

        $xml->endElement();

        return new self($xml);
    }

    public function getXml(): \XMLWriter
    {
        return $this->xml;
    }

    public function __toString()
    {
        return $this->xml->outputMemory(true);
    }
}