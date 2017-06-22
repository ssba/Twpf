<?php

namespace Twpf\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;


class TelegramCommandCreationCommand extends Command
{

    protected function configure()
    {
        $this->setName('create:command')
             ->setDescription('Create Telegram command handler')
             ->setHelp('This command allows you to create The Telegram command handler...')
             ->addArgument('name', InputArgument::REQUIRED, 'Who do you want to greet?');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {

            $CommandUppercase = ucfirst(strtolower($input->getArgument('name')));
            $filePath = ROOTDIR . "/src/Command/". $CommandUppercase ."Command.php";
            if(file_exists($filePath))
                throw new \ErrorException();

            $tpl = file_get_contents( __DIR__ . DIRECTORY_SEPARATOR . "command.tpl");
            $tpl = str_replace( "%CommandUppercase%", $CommandUppercase, $tpl);

            $fp = fopen(ROOTDIR . "/src/Command/". $CommandUppercase ."Command.php","wb");
            fwrite($fp,$tpl);
            fclose($fp);

        // TODO Exception handler
        }catch (\ErrorException $e){
            $output->writeln("<error>$CommandUppercase command already exist</error>");
        }catch (\Exception $e){
            $output->writeln("<error>Unhandled Exception</error>");
        }

        $output->writeln('<info>Done</info>');
    }
}