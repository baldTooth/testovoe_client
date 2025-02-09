<?php
namespace Randomclient\Exceptions;
use Exception;
use Throwable;

class ServerErrorException extends Exception{
    public function __construct(string $message="\n\nServer error\n\n",int $code=0,Throwable $exc=null)
    {
        parent::__construct($message,$code,$exc);
    }
}