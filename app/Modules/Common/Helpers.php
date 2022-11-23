<?php

declare(strict_types=1);

namespace App\Modules\Common;

abstract class Helpers
{
    public static function nullStringToInteger($string) : ?int
    {
        if ($string !== null) {
            return (int)$string;
        }

        return null;
    }
}
