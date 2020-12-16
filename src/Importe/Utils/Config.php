<?php

namespace Ivd24\Importe\Utils;

use Ivd24\Importe\Exception\NotFoundException;

class Config {
    private $data;
    private static $instance;

    private function __construct() {
        $json = file_get_contents(__DIR__ . '/../../../config/app.json');
        $this->data = json_decode($json, true);
    }

    public static function getInstance(): Config {
        if (self::$instance == null) {
            self::$instance = new Config();
        }
        return self::$instance;
    }

    public function get(string $key) {
        if (!isset($this->data[$key])) {
            throw new NotFoundException("Key $key not in config.");
        }
        return $this->data[$key];
    }
}