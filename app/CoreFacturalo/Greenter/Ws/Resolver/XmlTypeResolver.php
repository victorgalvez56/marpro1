<?php

namespace App\CoreFacturalo\Greenter\Ws\Resolver;

use App\CoreFacturalo\Greenter\Model\Perception\Perception;
use App\CoreFacturalo\Greenter\Model\Retention\Retention;
use App\CoreFacturalo\Greenter\Model\Sale\Invoice;
use App\CoreFacturalo\Greenter\Model\Sale\Note;
use App\CoreFacturalo\Greenter\Model\Summary\Summary;
use App\CoreFacturalo\Greenter\Model\Voided\Reversion;
use App\CoreFacturalo\Greenter\Model\Voided\Voided;
use App\CoreFacturalo\Greenter\Ws\Reader\XmlReader;

class XmlTypeResolver implements TypeResolverInterface
{
    /**
     * @var XmlReader
     */
    private $reader;

    /**
     * XmlTypeResolver constructor.
     *
     * @param XmlReader $reader
     */
    public function __construct(XmlReader $reader)
    {
        $this->reader = $reader;
    }

    /**
     * @param \DOMDocument|string $value
     *
     * @return string
     */
    public function getType($value)
    {
        $doc = $this->reader->parseToDocument($value);
        $name = $doc->documentElement->localName;

        switch ($name) {
            case 'Invoice':
                return Invoice::class;
            case 'CreditNote':
            case 'DebitNote':
                return Note::class;
            case 'Perception':
                return Perception::class;
            case 'Retention':
                return Retention::class;
            case 'SummaryDocuments':
                return Summary::class;
            case 'VoidedDocuments':
                $this->reader->loadXpathFromDoc($doc);
                $id = $this->reader->getValue('cbc:ID');

                return 'RA' === substr($id, 0, 2) ? Voided::class : Reversion::class;
        }

        return '';
    }
}
