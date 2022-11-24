<?php

namespace App\Modules\Common;

abstract class ResponseCodes
{
    const SUCCESS = [
        'code'    => 200,
        'message' => 'Request has been successfully processed.'
    ];

    const CREATED = [
        'code'    => 201,
        'message' => 'Request has been successfully created.'
    ];

    const DELETED = [
        'code'    => 200,
        'message' => 'Request has been deleted successfully.'
    ];

    const UPDATED = [
        'code'    => 200,
        'message' => 'Request has been updated successfully.'
    ];
    
    const NOT_FOUND = [
        'code'    => 404,
        'message' => 'Request not found.'
    ];
    
    const BAD_REQUEST = [
        'code'    => 400,
        'message' => 'Server failed to process the request.'
    ];
}
