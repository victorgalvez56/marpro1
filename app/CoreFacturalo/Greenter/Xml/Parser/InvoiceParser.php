<?php

/**
 * Created by PhpStorm.
 * User: Giansalex
 * Date: 05/10/2017
 * Time: 08:14
 */

namespace App\CoreFacturalo\Greenter\Xml\Parser;

use App\CoreFacturalo\Greenter\Model\Client\Client;
use App\CoreFacturalo\Greenter\Model\Company\Address;
use App\CoreFacturalo\Greenter\Model\Company\Company;
use App\CoreFacturalo\Greenter\Model\DocumentInterface;
use App\CoreFacturalo\Greenter\Model\Sale\Detraction;
use App\CoreFacturalo\Greenter\Model\Sale\Document;
use App\CoreFacturalo\Greenter\Model\Sale\Invoice;
use App\CoreFacturalo\Greenter\Model\Sale\Legend;
use App\CoreFacturalo\Greenter\Model\Sale\Prepayment;
use App\CoreFacturalo\Greenter\Model\Sale\SaleDetail;
use App\CoreFacturalo\Greenter\Model\Sale\SalePerception;
use App\CoreFacturalo\Greenter\Xml\Parser\DocumentParserInterface;

/**
 * Class InvoiceParser
 * @package Greenter\Xml\Parser
 */
class InvoiceParser implements DocumentParserInterface
{
    /**
     * @param $value
     * @return DocumentInterface
     */
    public function parse($value)
    {
        $xpt = $this->getXpath($value);
        $inv = new Invoice();
        $docFac = explode('-', $this->defValue($xpt->query('/xt:Invoice/cbc:ID')));
        $inv->setSerie($docFac[0])
            ->setCorrelativo($docFac[1])
            ->setTipoDoc($this->defValue($xpt->query('/xt:Invoice/cbc:InvoiceTypeCode')))
            ->setTipoMoneda($this->defValue($xpt->query('/xt:Invoice/cbc:DocumentCurrencyCode')))
            ->setTipoMoneda($this->defValue($xpt->query('/xt:Invoice/cbc:DocumentCurrencyCode')))
            ->setFechaEmision(new \DateTime($this->defValue($xpt->query('/xt:Invoice/cbc:IssueDate'))))
            ->setHoraEmision($this->defValue($xpt->query('/xt:Invoice/cbc:IssueTime')))
            ->setFecVencimiento(new \DateTime($this->defValue($xpt->query('/xt:Invoice/cbc:DueDate'))))
            ->setCompany($this->getCompany($xpt))
            ->setClient($this->getClient($xpt));

        //$extensions = $xpt->query('/xt:Invoice/ext:UBLExtensions')->item(0);
        //$additional = $xpt->query('//sac:AdditionalInformation', $extensions)->item(0);

        $this->loadTotals($inv, $xpt, null);
        $this->loadTributos($inv, $xpt);

        //->setMtoOtrosTributos(floatval($this->defValue($xpt->query('sum(/xt:Invoice/cac:InvoiceLine/cbc:LineExtensionAmount)'), 0)))

        $monetaryTotal = $xpt->query('/xt:Invoice/cac:LegalMonetaryTotal')->item(0);
        $inv->setTipoOperacion($this->defValue($xpt->query('cbc:InvoiceTypeCode/@listID')))
            ->setMtoDescuentos(floatval($this->defValue($xpt->query('cbc:AllowanceTotalAmount', $monetaryTotal), 0)))
            ->setMtoCargos(floatval($this->defValue($xpt->query('cbc:ChargeTotalAmount', $monetaryTotal), 0)))
            ->setTotalAnticipos(floatval($this->defValue($xpt->query('cbc:PrepaidAmount', $monetaryTotal), 0)))
            ->setAnticipos(iterator_to_array($this->getPrepayments($xpt)))
            ->setMtoImpVenta(floatval($this->defValue($xpt->query('cbc:PayableAmount', $monetaryTotal), 0)))
            ->setDetails(iterator_to_array($this->getDetails($xpt)))
            //->setLegends(iterator_to_array($this->getLegends($xpt,  $additional)))
        ;
        $this->loadExtras($xpt, $inv);

        return $inv;
    }

    private function getXpath($value)
    {
        if ($value instanceof \DOMDocument) {
            $doc = $value;
        } else {
            $doc = new \DOMDocument();
            @$doc->loadXML($value);
        }
        $rootNamespace = $doc->documentElement->namespaceURI;
        $xpt = new \DOMXPath($doc);
        $xpt->registerNamespace('xt', $rootNamespace);

        return $xpt;
    }

    private function defValue(\DOMNodeList $nodeList, $default = '')
    {
        if ($nodeList->length == 0) {
            return $default;
        }

        return $nodeList->item(0)->nodeValue;
    }

    private function loadTotals(Invoice $inv, \DOMXPath $xpt, \DOMNode $node = null)
    {
        //if (empty($node)) {
        //    return;
        //}

        //$totals = $xpt->query('sac:AdditionalMonetaryTotal', $node);
        $totals = $xpt->query('/xt:Invoice/cac:TaxTotal/cac:TaxSubtotal');

        foreach ($totals as $total) {
            /**@var $total \DOMElement*/
            //$id = trim($this->defValue($xpt->query('cbc:ID', $total)));
            //$val = floatval($this->defValue($xpt->query('cbc:PayableAmount', $total),0));

            $id = trim($this->defValue($xpt->query('cac:TaxCategory/cac:TaxScheme/cbc:ID', $total)));
            $val = floatval($this->defValue($xpt->query('cbc:TaxableAmount', $total), 0));

            //echo "/xt:Invoice/cac:TaxTotal[cac:TaxSubtotal/cac:TaxCategory/cac:TaxScheme/cbc:ID='". $id . "']/cac:TaxSubtotal/cbc:TaxableAmount".'<br/>';
            //echo 'ID: '. $id. ' Valor: '. $val. '<br/>';

            switch ($id) {
                case '1000':
                    $inv->setMtoOperGravadas($val);
                    break;
                case '9998':
                    $inv->setMtoOperInafectas($val);
                    break;
                case '9997':
                    $inv->setMtoOperExoneradas($val);
                    break;
                case '9996':
                    $inv->setMtoOperGratuitas($val);
                    break;
                case '2001':
                    $inv->setPerception((new SalePerception())
                        ->setCodReg($xpt->query('cbc:ID', $total)->item(0)->getAttribute('schemeID'))
                        ->setMto($val)
                        ->setMtoBase(floatval($this->defValue($xpt->query('sac:ReferenceAmount', $total), 0)))
                        ->setMtoTotal(floatval($this->defValue($xpt->query('sac:TotalAmount', $total), 0))));
                    break;
                case '2003':
                    $inv->setDetraccion((new Detraction())
                        ->setMount($val)
                        ->setPercent(floatval($this->defValue($xpt->query('cbc:Percent', $total), 0)))
                        ->setValueRef(floatval($this->defValue($xpt->query('sac:ReferenceAmount', $total), 0))));
                    break;
                case '2005':
                    $inv->setMtoDescuentos($val);
                    break;
            }
        }
    }

    private function loadTributos(Invoice $inv, \DOMXPath $xpt)
    {
        $taxs = $xpt->query('/xt:Invoice/cac:TaxTotal');
        foreach ($taxs as $tax) {
            $name = $this->defValue($xpt->query('cac:TaxSubtotal/cac:TaxCategory/cac:TaxScheme/cbc:Name', $tax));
            $val = floatval($this->defValue($xpt->query('cbc:TaxAmount', $tax), 0));

            switch ($name) {
                case 'IGV':
                    $inv->setMtoIGV($val);
                    break;
                case 'ISC':
                    $inv->setMtoISC($val);
                    break;
                case 'OTROS':
                    $inv->setMtoOtrosTributos($val);
                    break;
            }
        }
    }

    private function getPrepayments(\DOMXPath $xpt)
    {
        $nodes = $xpt->query('/xt:Invoice/cac:PrepaidPayment');
        if ($nodes->length == 0) {
            return;
        }
        foreach ($nodes as $node) {
            $docRel = $xpt->query('cbc:ID', $node)->item(0);
            $item = (new Prepayment())
                ->setTotal(floatval($this->defValue($xpt->query('cbc:PaidAmount', $node), 0)))
                ->setTipoDocRel($docRel->getAttribute('schemeID'))
                ->setNroDocRel($docRel->nodeValue);

            yield $item;
        }
    }

    private function getLegends(\DOMXPath $xpt, \DOMNode $node = null)
    {
        if (empty($node)) {
            return;
        }

        $legends = $xpt->query('sac:AdditionalProperty', $node);
        foreach ($legends as $legend) {
            /**@var $legend \DOMElement*/
            $leg = (new Legend())
                ->setCode($this->defValue($xpt->query('cbc:ID', $legend)))
                ->setValue($this->defValue($xpt->query('cbc:Value', $legend)));

            yield $leg;
        }
    }

    private function getClient(\DOMXPath $xp)
    {
        $node = $xp->query('/xt:Invoice/cac:AccountingCustomerParty')->item(0);

        $cl = new Client();
        $cl->setNumDoc($this->defValue($xp->query('cac:Party/cac:PartyIdentification/cbc:ID', $node)))
            ->setTipoDoc($this->defValue($xp->query('cac:Party/cac:PartyIdentification/cbc:ID/@schemeID', $node)))
            ->setRznSocial($this->defValue($xp->query('cac:Party/cac:PartyLegalEntity/cbc:RegistrationName', $node)))
            ->setAddress($this->getAddress($xp, $node))
            ->setTelephone($this->defValue($xp->query('cac:Party/cac:Contact/cbc:Telephone', $node)))
            ->setEMail($this->defValue($xp->query('cac:Party/cac:Contact/cbc:ElectronicMail', $node)));

        return $cl;
    }

    private function getCompany(\DOMXPath $xp)
    {
        $node = $xp->query('/xt:Invoice/cac:AccountingSupplierParty')->item(0);

        $cl = new Company();
        $cl->setRuc($this->defValue($xp->query('cac:Party/cac:PartyIdentification/cbc:ID', $node)))
            ->setNombreComercial($this->defValue($xp->query('cac:Party/cac:PartyName/cbc:Name', $node)))
            ->setRazonSocial($this->defValue($xp->query('cac:Party/cac:PartyLegalEntity/cbc:RegistrationName', $node)))
            ->setAddress($this->getAddress($xp, $node))
            ->setTelephone($this->defValue($xp->query('cac:Party/cac:Contact/cbc:Telephone', $node)))
            ->setEMail($this->defValue($xp->query('cac:Party/cac:Contact/cbc:ElectronicMail', $node)));

        return $cl;
    }

    private function loadExtras(\DOMXPath $xpt, Invoice $inv)
    {
        $inv->setCompra($this->defValue($xpt->query('/xt:Invoice/cac:OrderReference/cbc:ID')));
        $fecVen = $this->defValue($xpt->query('/xt:Invoice/cac:PaymentMeans/cbc:PaymentDueDate'));
        if (!empty($fecVen)) {
            $inv->setFecVencimiento(new \DateTime($fecVen));
        }

        $inv->setGuias(iterator_to_array($this->getGuias($xpt)));
    }

    private function getGuias(\DOMXPath $xpt)
    {
        $guias = $xpt->query('/xt:Invoice/cac:DespatchDocumentReference');
        if ($guias->length == 0) {
            return;
        }

        foreach ($guias as $guia) {
            $item = new Document();
            $item->setTipoDoc($this->defValue($xpt->query('cbc:DocumentTypeCode', $guia)));
            $item->setNroDoc($this->defValue($xpt->query('cbc:ID', $guia)));

            yield $item;
        }
    }

    /**
     * @param \DOMXPath $xp
     * @param $node
     * @return Address|null
     */
    private function getAddress(\DOMXPath $xp, $node)
    {
        $nAd = $xp->query('cac:Party/cac:PartyLegalEntity/cac:RegistrationAddress', $node);
        if ($nAd->length > 0) {
            $address = $nAd->item(0);

            return (new Address())
                ->setDireccion($this->defValue($xp->query('cac:AddressLine/cbc:Line', $address)))
                ->setDepartamento($this->defValue($xp->query('cbc:CityName', $address)))
                ->setProvincia($this->defValue($xp->query('cbc:CountrySubentity', $address)))
                ->setDistrito($this->defValue($xp->query('cbc:District', $address)))
                ->setUbigueo($this->defValue($xp->query('cbc:ID', $address)))
                ->setCodigoPais($this->defValue($xp->query('cac:Country/cbc:IdentificationCode', $address)));
        }

        return null;
    }

    private function getDetails(\DOMXPath $xpt)
    {
        $nodes = $xpt->query('/xt:Invoice/cac:InvoiceLine');

        foreach ($nodes as $node) {
            $quant = $xpt->query('cbc:InvoicedQuantity', $node)->item(0);
            $det = new SaleDetail();
            $det->setCantidad($quant->nodeValue)
                ->setUnidad($quant->getAttribute('unitCode'))
                ->setMtoValorVenta($this->defValue($xpt->query('cbc:LineExtensionAmount', $node)))
                ->setMtoValorUnitario($this->defValue($xpt->query('cac:Price/cbc:PriceAmount', $node)))
                ->setDescripcion($this->defValue($xpt->query('cac:Item/cbc:Description', $node)))
                ->setCodProducto($this->defValue($xpt->query('cac:Item/cac:SellersItemIdentification/cbc:ID', $node)))
                ->setCodProdSunat($this->defValue($xpt->query('cac:Item/cac:CommodityClassification/cbc:ItemClassificationCode', $node)));

            $taxs = $xpt->query('cac:TaxTotal', $node);
            foreach ($taxs as $tax) {
                $name = $this->defValue($xpt->query('cac:TaxSubtotal/cac:TaxCategory/cac:TaxScheme/cbc:Name', $tax));
                $val = floatval($this->defValue($xpt->query('cbc:TaxAmount', $tax), 0));
                switch ($name) {
                    case 'IGV':
                        $det->setIgv($val);
                        $det->setTipAfeIgv($this->defValue($xpt->query('cac:TaxSubtotal/cac:TaxCategory/cbc:TaxExemptionReasonCode', $tax)));
                        $det->setPorIgv($this->defValue($xpt->query('cac:TaxSubtotal/cac:TaxCategory/cbc:Percernt', $tax)));
                        $det->setMtoBaseIgv($this->defValue($xpt->query('cac:TaxSubtotal/cac:TaxableAmount', $tax)));
                        break;
                    case 'ISC':
                        $det->setIsc($val);
                        $det->setTipSisIsc($this->defValue($xpt->query('cac:TaxSubtotal/cac:TaxCategory/cbc:TierRange', $tax)));
                        $det->setPorSisIsc($this->defValue($xpt->query('cac:TaxSubtotal/cac:TaxCategory/cbc:Percernt', $tax)));
                        $det->setMtoBaseSisIsc($this->defValue($xpt->query('cac:TaxSubtotal/cac:TaxableAmount', $tax)));
                        break;
                }
            }

            // Descuento
            $descs = $xpt->query('cac:AllowanceCharge', $node);
            foreach ($descs as $desc) {
                $charge = $this->defValue($xpt->query('cbc:ChargeIndicator', $desc));
                $charge = trim($charge);
                if ($charge == 'false') {
                    $val = floatval($this->defValue($xpt->query('cbc:Amount', $desc), 0));
                    $det->setDescuento($val);
                }

                if ($charge == 'true') {
                    $val = floatval($this->defValue($xpt->query('cbc:Amount', $desc), 0));
                    $det->setCargo($val);
                }
            }

            $prices = $xpt->query('cac:PricingReference', $node);
            foreach ($prices as $price) {
                $code = $this->defValue($xpt->query('cac:AlternativeConditionPrice/cbc:PriceTypeCode', $price));
                $value = floatval($this->defValue($xpt->query('cac:AlternativeConditionPrice/cbc:PriceAmount', $price), 0));
                $code = trim($code);

                switch ($code) {
                    case '01':
                        $det->setMtoPrecioUnitario($value);
                        break;
                    case '02':
                        $det->setMtoValorGratuito($value);
                        break;
                }
            }

            yield $det;
        }
    }
}
