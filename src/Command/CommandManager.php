<?php

namespace Twpf\Command;

use Exception;
use Core\Config;

class CommandManager
{
    static private $instance = null;

    private static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __clone()
    {
    }

    private function __construct()
    {
    }

    public static function getList() : array
    {
        return CommandManager::getInstance()->getCheckedList();
    }

    public static function getExecuter(string $command) : string
    {
        return CommandManager::getInstance()->_getExecuter($command);
    }

    private function _getExecuter(string $command) : string {
        try {
            $list = $this->getCheckedList();

            if(!array_key_exists($command,$list))
                throw new Exception("Unrecognised command");

            $CommandInstanse = new $list[$command];


        }catch (Exception $e){
            return 'Twpf\Command\CommandManager:50';
        }

        return $CommandInstanse;
    }

    private function getCheckedList() : array
    {
        $checked = [];
        $unchecked = Config::get("commands") ;
        foreach ($unchecked as $key => $class){
            if(class_exists( $class ))
                $checked[$key] = $class;
        }

        return $checked;
    }


}