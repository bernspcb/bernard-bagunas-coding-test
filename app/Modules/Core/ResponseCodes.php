<?php

declare(strict_types=1);

namespace App\Modules\Core;

abstract class ResponseCodes
{
    const SUCCESS = [
        'title'   => 'success',
        'code'   => 200,
        'message' => 'Request has been successfully processed.'
    ];
    
    const NOT_FOUND = [
        'title'   => 'not_found',
        'code'   => 404,
        'message' => 'Request cannot be located.'
    ];
    
    const INVALID_ARGUMENTS = [
        'title'   => 'invalid_argument',
        'code'   => 404,
        'message' => 'Invalid arguments. Server failed to process the request.'
    ];
    
    const BAD_REQUEST = [
        'title'   => 'bad_request',
        'code'   => 400,
        'message' => 'Server failed to process the request.'
    ];
}
