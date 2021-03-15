<?php
/**
 * Created by PhpStorm.
 * User: Administrador
 * Date: 02/10/2017
 * Time: 09:58 AM.
 */

namespace App\CoreFacturalo\Greenter\Services;

use App\CoreFacturalo\Greenter\Model\Response\BaseResult;

/**
 * Interface SenderInterface.
 */
interface SenderInterface
{
    /**
     * Send document.
     *
     * @param string $filename Filename
     * @param string $content  Content File
     *
     * @return BaseResult
     */
    public function send($filename, $content);
}
