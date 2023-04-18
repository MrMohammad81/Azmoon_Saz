<?php

namespace App\Http\Controllers\API\V1\Contracts;

use App\Http\Controllers\Controller;

class APIController extends Controller
{
    protected $status;

    public function responseSuccess(string $message , array $data)
    {
        return $this->setStatusCode(200)->response($message , true , $data);
    }

    public function responseCreated(string $message , array $data)
    {
        return $this->setStatusCode(201)->response($message , true , $data);
    }

    public function responseNotFound(string $message)
    {
        return $this->setStatusCode(404)->response($message);
    }

    private function response(string $message = '' , bool $isSuccess = false , array $data = null)
    {
        $responseData = [
            'success' => $isSuccess,
            'message' => $message,
            'data' => $data
        ];

        return response()->json($responseData)->setStatusCode($this->getStatusCode());
    }

    private function setStatusCode(int $status)
    {
        $this->status = $status;

        return $this;
    }

    private function getStatusCode()
    {
        return $this->status;
    }
}
