<?php

use Bernard\Message\DefaultMessage;

class EchoTimeService
{
    public function echoTime(DefaultMessage $message)
    {
        echo "Hello World {$message->time}\n";
    }
}
