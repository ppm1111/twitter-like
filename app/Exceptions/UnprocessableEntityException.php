<?php

namespace App\Exceptions;

class UnprocessableEntityException extends BaseException {

    public $message = "";

    public function __construct($obj) {
        parent::__construct($obj);
    }

    public function render(){
        return response()->json(
            $this->exceptionGenerator->make(),
        422);
    }
}