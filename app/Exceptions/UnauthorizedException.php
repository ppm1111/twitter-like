<?php

namespace App\Exceptions;

class UnauthorizedException extends BaseException {

    public $message = "";

    public function __construct($obj) {
        parent::__construct($obj);
    }

    public function render(){
        $exceptionGenerator = new ExceptionGenerator($this->obj);
        return response()->json($exceptionGenerator->make(), 401);
    }
}