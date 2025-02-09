<?php 

namespace Randomclient\Commands;

interface CommandInterface{
    public function execute(array $settings);
}