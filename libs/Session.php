<?php

Class Session{
    
    static function init(){
        @session_start();
    }
    
    static function destroy(){
        session_destroy();
    }
    
    static function getValue($var){
        return (isset($_SESSION[$var])) ? $_SESSION[$var] : null ;
    }
    
    //Crear una variable de session con un valor
    static function setValue($var, $val){
        $_SESSION[$var] = $val;
    }
    
    static function unsetValue($var){
        if(isset($_SESSION[$var])){
            unset($_SESSION[$var]);
        }
    }
    
    static function exist(){
        return ($_SESSION!=null) ? true : false ;
    }

    static function existVar($var){
        return (isset($_SESSION[$var])) ? true : false;
    }

}
