<?php

namespace App\Exceptions;

use Exception;

class BaseException extends Exception {
    protected $obj;
    protected $exceptionGenerator;
    public function __construct($obj) {
        $this->obj = $obj;
        $this->exceptionGenerator = new ExceptionGenerator($this->obj);
    }
    
}