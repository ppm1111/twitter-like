<?php

namespace App\Exceptions;

class NotFoundException extends BaseException {

    public $message = "";

    public function __construct($obj) {
        parent::__construct($obj);
    }

    public function render(){
        return response()->json(
            $this->exceptionGenerator->make(),
        404);
    }
}