<?php
/**
 * Created by PhpStorm.
 * User: Giansalex
 * Date: 22/07/2017
 * Time: 15:38.
 */

namespace App\CoreFacturalo\Greenter\Ws\Reader;

use App\CoreFacturalo\Greenter\Model\Response\CdrResponse;

/**
 * Interface CdrReaderInterface.
 */
interface CdrReaderInterface
{
    /**
     * Get Cdr using DomDocument.
     *
     * @param string $xml
     *
     * @return CdrResponse
     */
    public function getCdrResponse($xml);
}
