<?php 
declare(strict_types=1);

namespace Randomclient\Commands;
use Randomclient\Commands\CommandInterface;

class HelpCommand implements CommandInterface{
    public function execute(array $settings){
        $commands = implode("\n\n",$settings["commands_descriptions"]);
        $message = "\n\nRandomclient for Randomserver. v.{$settings["version"]}\n\nCommands:\n\n{$commands}\n\n";
        echo $message;
    }
}