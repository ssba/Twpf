<?php

define("ROOTDIR", __DIR__);

require __DIR__.'/vendor/autoload.php';

use TelegramBot\Api\Client as TelegramBot;
use Core\Input;
use Core\Config;
use Twpf\Command\CommandManager;
use TelegramBot\Api\InvalidJsonException as InvalidJsonException;

try{

    $botClient = new TelegramBot( Config::get("telegram.bot.token"), 'botanio_token');
    $controller = CommandManager::getExecuter( Input::$command );
    $message = Input::getRawMessage();

    $botClient->run();
    $botClient->command( Input::$command , function ( $message ) use ($botClient, $message, $controller) {
        $botClient->sendMessage($message->getChat()->getId(), $controller());
    });

}catch (TypeError $exception){
    header('HTTP/1.1 500 Internal Server Error');
}catch (InvalidJsonException $exception){
    header('HTTP/1.1 500 Internal Server Error');
}