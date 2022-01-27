<?php

namespace App\Applications\Response;

class BaseResponse
{
    public $data;
    public string $message;
    public bool $success;
    public int $code;
}