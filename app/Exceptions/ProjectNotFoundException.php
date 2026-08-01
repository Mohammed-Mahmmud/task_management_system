<?php

namespace App\Exceptions;

use Exception;

class ProjectNotFoundException extends Exception
{
    protected $message = 'Project not found';
    protected $code = 404;
}
