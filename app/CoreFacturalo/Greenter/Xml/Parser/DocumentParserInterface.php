<?php
/**
 * Created by PhpStorm.
 * User: Giansalex
 * Date: 05/10/2017
 * Time: 08:01.
 */

namespace App\CoreFacturalo\Greenter\Xml\Parser;

use App\CoreFacturalo\Greenter\Model\DocumentInterface;

/**
 * Interface DocumentParserInterface.
 */
interface DocumentParserInterface
{
    /**
     * @param $value
     *
     * @return DocumentInterface
     */
    public function parse($value);
}
