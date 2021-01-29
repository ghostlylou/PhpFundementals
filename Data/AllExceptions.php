<?php


class LoginException extends Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        echo "<div class='alert alert-danger'>Login error: {$message}</div>";
    }
}

class RegularException extends Exception{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        echo "<div class='alert alert-danger'>Error: {$message}</div>";
    }
}

class AccountNotFoundException extends Exception{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        echo "<div class='alert alert-danger'>Account error: {$message}</div>";

    }
}

class InputException extends Exception{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
       echo"<div class='alert alert-danger'>Input error: invalid {$message}. Try again</div>";
    }
}

class CreateException extends Exception{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        echo"<div class='alert alert-danger'>Create error: {$message}.Try again</div>";
    }
}

class UpdateException extends Exception{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        echo"<div class='alert alert-danger'>Update error: {$message}. Try again</div>";
    }
}

class DeleteException extends Exception{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        echo"<div class='alert alert-danger'>Delete error: {$message}. Try again</div>";
    }
}



