<?php

namespace App\Importe\Entity;

class Immobilie {
    public $hashcode = '';
    public $action = '';
    public $objektnr = '';
    public $nutzungsart = '';
    public $vermarktungsart = '';
    public $kontaktperson = '';
    public $anhang = array();
    public $geo = array();
}