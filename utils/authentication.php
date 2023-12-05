<?php

Class authentication{
    public static function Authenticate($BasePassword,$Salt,$InputPassword){
        return ($BasePassword === hash('sha256',($InputPassword.$Salt)));
    }
}
?>