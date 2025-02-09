<?php 
declare(strict_types=1);

namespace Randomclient\Commands;
use Randomclient\Commands\CommandInterface;
use Exception;

class RandomCommand implements CommandInterface{

    public function execute(array $settings){
        
        try{

            $ch = \curl_init();
            \curl_setopt($ch,\CURLOPT_URL,$settings["server_url"]."/random");
            curl_setopt($ch,\CURLOPT_RETURNTRANSFER,1);

            $resp = \curl_exec($ch);

            curl_close($ch);


            $data = json_decode($resp);


            echo "\n\nRandom number is generated. Id = {$data->id}\n\n";

        }catch(Exception $exc){

            echo "\n\nError randomCommand:\n\n".$exc->getMessage()."\n\n";

        }
    }
}