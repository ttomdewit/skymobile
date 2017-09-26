<?php

namespace Tomdewit\Skymobile\Exceptions;

use Exception;

class InvalidConfiguration extends Exception
{
    /**
     * @return static
     */
    public static function configurationNotSet()
    {
        return new static('In order to send notification via Skymobile you need to add credentials in the `skymobile` key of `config.services`.');
    }
}
