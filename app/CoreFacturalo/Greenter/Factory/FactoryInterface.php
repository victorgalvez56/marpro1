<?php
/**
 * Created by PhpStorm.
 * User: Giansalex
 * Date: 01/10/2017
 * Time: 15:31.
 */

namespace App\CoreFacturalo\Greenter\Factory;

use App\CoreFacturalo\Greenter\Model\DocumentInterface;
use App\CoreFacturalo\Greenter\Model\Response\BaseResult;

/**
 * Interface FactoryInterface.
 */
interface FactoryInterface
{
    /**
     * @param DocumentInterface $document
     *
     * @return BaseResult
     */
    public function send(DocumentInterface $document);
}
