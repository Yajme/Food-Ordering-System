<?php

Class authentication{
    protected $hashedPassword;
    protected $basePassword;
    function __construct($BasePassword,$Salt,$InputPassword)
    {
        $this->hashedPassword = hash('sha256',($Salt . $InputPassword));
        $this->basePassword = $BasePassword;
    }

    function AuthenticateLogin(){
        return ($this->hashedPassword == $this->basePassword);
    }
}
?>