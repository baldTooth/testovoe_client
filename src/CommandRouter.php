<?php 
declare(strict_types=1);

namespace Randomclient;
use Randomclient\Commands\HelpCommand;
use Randomclient\Commands\GetNumberCommand;
use Randomclient\Commands\RandomCommand;
use Randomclient\Exceptions\ServerErrorException;
use Exception;


class CommandRouter{

    private array $settings=[];
    private $commands = [
        "help"=>HelpCommand::class,
        "random"=>RandomCommand::class,
        "getnumber"=>GetNumberCommand::class,

    ];
    public function __construct(array $settings)
    {
        $this->settings=$settings;
    }
    public function handle(){

        $argc = $_SERVER["argc"];

        if($argc<2||$argc>=4){

            $this->incorrectCommand();
            return;
        }

        $argv = $_SERVER["argv"];

        $currCommand = $argv[1];
        
        if(!key_exists($currCommand,$this->commands)){
            $this->incorrectCommand();
            return;
        }

        try{
        
            (new $this->commands[$currCommand])->execute($this->settings);
        
        }catch(ServerErrorException $exc){

            echo $exc->getMessage();
            return;
 
        }catch(Exception $exc){

            $this->incorrectCommand($exc->getMessage());
     
        }
    }

    private function incorrectCommand(string $message="\n\nIncorrect command\n\n"){
        echo $message;
        (new $this->commands['help'])->execute($this->settings);
    }

}