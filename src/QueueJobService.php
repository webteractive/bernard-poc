<?php

use Bernard\Message\DefaultMessage;

class QueueJobService
{
    public function queueJob(DefaultMessage $message)
    {
        echo "Queue job {$message->time}!\n";
    }
}
