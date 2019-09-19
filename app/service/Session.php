<?php


namespace app\service;


class Session
{
    protected $id;

    public function __construct()
    {
        if(!isset($_SESSION)){
            session_start();
        }
        $this->id   = session_id();
    }

    public function getSessionId()
    {
        return $this->id;
    }

    public function getSessionUserName($username)
    {
        if(array_key_exists($username, $_SESSION)){
            return $_SESSION['user'];
        }
        else{
            return 0;
        }
    }
    public function setSessionUserName($userArray)
    {
        $_SESSION   = $userArray;
    }
}