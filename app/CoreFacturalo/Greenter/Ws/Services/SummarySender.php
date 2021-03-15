<?php
/**
 * Created by PhpStorm.
 * User: Administrador
 * Date: 02/10/2017
 * Time: 10:05 AM.
 */

namespace App\CoreFacturalo\Greenter\Ws\Services;

use App\CoreFacturalo\Greenter\Model\Response\BaseResult;
use App\CoreFacturalo\Greenter\Model\Response\SummaryResult;
use App\CoreFacturalo\Greenter\Services\SenderInterface;

/**
 * Class SummarySender.
 */
class SummarySender extends BaseSunat implements SenderInterface
{
    /**
     * @param string $filename
     * @param string $content
     *
     * @return BaseResult
     */
    public function send($filename, $content)
    {
        $client = $this->getClient();
        $result = new SummaryResult();

        try {
            $zipContent = $this->compress($filename.'.xml', $content);
            $params = [
                'fileName' => $filename.'.zip',
                'contentFile' => $zipContent,
            ];
            $response = $client->call('sendSummary', ['parameters' => $params]);
            $result
                ->setTicket($response->ticket)
                ->setSuccess(true);
        } catch (\SoapFault $e) {
            $result->setError($this->getErrorFromFault($e));
        }

        return $result;
    }
}
