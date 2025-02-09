<?php 
declare(strict_types=1);

namespace Randomclient\Commands;
use Randomclient\Commands\CommandInterface;
use Randomclient\Exceptions\ServerErrorException;
use Exception;

class GetNumberCommand implements CommandInterface{

    public function execute(array $settings){

        try{

            $argv = $_SERVER['argv'];           
            
            if(\is_array($argv)&&(count($argv)<3||count($argv)>3)){
                throw new Exception('\n\nIncorrect parameters command getnumber\n\n');
                return;
            }

            $idNumber = (int)$argv[2];

            if(!is_int($idNumber)){
                throw new Exception('\n\nIncorrect parameters command getnumber, incorrect ID\n\n');
                return;
            }



            $ch = curl_init();
            curl_setopt($ch,CURLOPT_URL,$settings['server_url']."/get/{$idNumber}");
            curl_setopt($ch,\CURLOPT_RETURNTRANSFER,1);

            $resp = curl_exec($ch);


            curl_close($ch);

            $data = json_decode($resp);

            if(!isset($data->id)||!isset($data->number)){
                throw new ServerErrorException($resp);
                return;
            }

            echo "\n\nGenerated random number = {$data->number}\n\n";
            


        }catch(Exception $exc){
            echo "\n\nError getnumber command. {$exc->getMessage()}\n\n";
        }
    }
}