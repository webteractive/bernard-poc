<?php

use Bernard\Message\DefaultMessage;

class JobMaster
{
    public function trigger(DefaultMessage $message)
    {
        echo "Hello World {$message->time} \n";
    }
}
