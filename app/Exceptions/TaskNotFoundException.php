<?php

namespace App\Exceptions;

use Exception;

class TaskNotFoundException extends Exception
{
    protected $message = 'Task not found';
    protected $code = 404;
}
