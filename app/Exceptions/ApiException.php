<?php

namespace App\Exceptions;

use Illuminate\Http\Exceptions\HttpResponseException;

class ApiException extends HttpResponseException
{
    public function __construct($code = 422, $message ='Validation Error', $errors = [])
    {
        $data = [
            'message' => $message,
        ];

        if(count($errors) > 0){
            $data['errors'] = $errors;
        }

        return parent::__construct(response()->json($data)->setStatusCode($code, $message));
    }
}
