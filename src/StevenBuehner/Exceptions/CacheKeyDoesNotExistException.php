<?php
/*******************************************************************************
 * Copyright (c) 2016. by Steven Bühner
 ******************************************************************************/

namespace StevenBuehner\Ergebnisberechnung\Exceptions;

class CacheKeyDoesNotExistException extends \Exception {

    public function __construct($message = 'The requested cache key does not exist') {
        parent::__construct($message);
    }
}