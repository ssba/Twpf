<?php

define("ROOTDIR", __DIR__);
define("SECURITYCODE", "11a2978259dccbb5b99f0436fc020069");

require __DIR__.'/vendor/autoload.php';

use TelegramBot\Api\Client as TelegramBot;
use Core\Input;
use Core\Config;
use Twpf\Command\CommandManager;
use TelegramBot\Api\InvalidJsonException as InvalidJsonException;

$REQUEST_URI = explode("/", $_SERVER['REQUEST_URI'] );

if( $REQUEST_URI[1] != SECURITYCODE )
    header('HTTP/1.1 404 Not Found');
else
    echo "200";
/*
try{

    if( $REQUEST_URI[1] != SECURITYCODE )
        throw new Exception();

    $botClient = new TelegramBot( Config::get("telegram.bot.token"));
    $controller = CommandManager::getExecuter( Input::$command );
    $message = Input::getRawMessage();

    $botClient->run();
    $botClient->command( Input::$command , function ( $message ) use ($botClient, $message, $controller) {
        $botClient->sendMessage($message->getChat()->getId(), $controller());
    });

}catch (TypeError $exception){
    //header('HTTP/1.1 404 Not Found');
    print_r("404");
}catch (InvalidJsonException $exception){
    //header('HTTP/1.1 404 Not Found');
    print_r("404");
}catch (Exception $exception){
    //header('HTTP/1.1 500 Internal Server Error');
    print_r("500");
}

$fp = fopen("Command.log","a+");
fwrite($fp,Input::$command);
fclose($fp);
print_r(file_get_contents("Command.log"));
*/