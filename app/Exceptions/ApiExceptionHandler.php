<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class ApiExceptionHandler extends Exception
{

    /**
     * Handle the exception and provide a json response
     *
     * @return JsonResponse
     */
    public function render(): JsonResponse
    {
        if ($this->code < 100) {
            $this->code = 500;
        }

        switch ($this->code) {
            case 400:
                $response = 'Bad Request';
                break;
            case 401:
                $response  = 'Unauthenticated';
                break;
            case 403:
                $response  = 'Forbidden';
                break;
            case 404:
                $response  = 'Not Found';
                break;
            case 405:
                $response  = 'Method Not Allowed';
                break;
            default:
                $response  = ($this->code == 500) ? 'Something went wrong, Please try after some time.' : $this->getMessage();
                break;
        }

        return new JsonResponse($response, $this->code);
    }
}
