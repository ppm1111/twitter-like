<?php

namespace App\Exceptions;

class ExceptionGenerator {
    public $errorTable;
    public $module;
    public $errorType;
    public $display;
    public $data;

    public function __construct($object) {
        $this->errorTable = config('errorcode');
        $this->module = $object['module'];
        $this->errorType = $object['errorType'];
        $this->display = $object['display'] ?? null;
        $this->data = $object['data'] ?? null;
    }

    public function make() {
        $code = $this->generateCode();

        $response = [
            'code' => $code,
            'message' => $this->generateMessage(),
            'data' => null
        ];

        if (!empty($this->data['errors'])) {
            $response['data']['errors'] = $this->data['errors'];
        }

        if (!empty($this->data['parameters'])) {
            $response['data']['parameters'] = $this->data['parameters'];
        }
        return $response;
    }

    private function generateCode() {
        return $this->errorTable[$this->module]['code']
            .$this->errorTable[$this->module]['errorType'][$this->errorType]['code'];
    }

    private function generateMessage() {
        $template = $this->errorTable[$this->module]['errorType'][$this->errorType]['template'];
        
        if (!empty($this->display)) {
            foreach ($this->display as $key => $value) {
                $template = str_replace("{{$key}}", $value, $template);
            }
        }
        
        return $template;
    }
}