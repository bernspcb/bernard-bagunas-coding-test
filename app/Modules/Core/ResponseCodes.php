<?php

namespace App\Modules\Core;

abstract class ResponseCodes
{
    const SUCCESS = [
        'success' => true,
        'code'    => 200,
        'message' => 'Request has been successfully processed.'
    ];
    
    const NOT_FOUND = [
        'success' => false,
        'code'    => 404,
        'message' => 'Request cannot be located.'
    ];
    
    const BAD_REQUEST = [
        'success' => false,
        'code'    => 400,
        'message' => 'Server failed to process the request.'
    ];
}
