<?php

namespace Igwen6w\Ddz\Exception;
use \Exception;

class NotFoundFreeRoomException extends Exception
{
    protected $code = 400;

    protected $message = '没有空余的房间了';

}