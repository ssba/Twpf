<?php

namespace Core;

use Core\Config;
use Exception;

class Input
{

    static private $instance = null;

    private $message = null;

    public static $chatId = null;

    public static $command = null;

    private static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __clone(){}

    private function __construct()
    {
        try{

            $content = file_get_contents("php://input");
            $this->message = json_decode($content, TRUE);

            if ( !is_null(json_last_error()) || empty($this->message) )
                throw new Exception("Core\Input:37");

            self::$chatId  = $this->message["chat"]["id"];
            self::$command = $this->message["text"];

        } catch (Exception $e){
            return $e;
        }

    }

    public static function getRawMessage() : array
    {
        return Input::getInstance()->_getRawMessage();
    }

    private function _getRawMessage() : array
    {
        return $this->message ;
    }
}