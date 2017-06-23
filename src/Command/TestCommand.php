<?php

namespace Twpf\Command;

class TestCommand {

    private function __clone(){}

    public function TestCommand()
    {
        //
    }

    public function __invoke()
    {
        return "TestCommand";
    }
}