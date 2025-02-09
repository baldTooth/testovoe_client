<?php 
declare(strict_types=1);

namespace Randomclient;
use Randomclient\CommandRouter;


class Client{

    private array $settings=[];
    
    public function run(){

        $this->configure();

        $commandRouter = new CommandRouter($this->settings);
        $commandRouter->handle();
    }
    
    private function configure(){
        $this->settings["server_url"]="http://localhost:5095";
        $commandsDescriptions = require __DIR__."/commandsDescriptions.php";
        $this->settings["commands_descriptions"]=$commandsDescriptions;
        $this->settings['version']="1.0.0";
    }
    
}