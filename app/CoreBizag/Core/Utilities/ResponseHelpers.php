<?php


namespace App\CoreBizag\Core\Utilities;


trait ResponseHelpers
{

    public function sendResponseResult($message = '', $success)
    {
        $result = [
            'message' => $message,
            'success' => $success
        ];
        return response($result);
    }

    public function sendResponseResultData($message = '', $success, $data)
    {
        $result = [
            'message' => $message,
            'success' => $success,
            'response' => $data['response'],
            'data' => $data['data'],
        ];
        return response($result);
    }

    public function sendResponseResultDataError($message = '', $success, $data)
    {
        $result = [
            'message' => $message,
            'success' => $success,
            'response' => $data['response'],
        ];

        return response($result);
    }

    public function sendResponseResultModel($message = '', $success, $model)
    {
        $result = [
            'message' => $message,
            'success' => $success,
            'data' => [
                'id' => $model->id,
                'number_full' => "{$model->series}-{$model->number}",
            ],
            'message' =>  $message
        ];

        return response($result);
    }
}
