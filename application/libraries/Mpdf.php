<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Mpdf
{

    public $method;

    function __construct()
    {
        require_once MPDF;
        $this->method = new \Mpdf\Mpdf();
    }
}
