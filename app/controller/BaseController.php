<?php

namespace app\controller;
use       app\service\UserDB,     app\service\Session,
          app\helper\ArrayHelper;


abstract class BaseController
{
    protected $session;
    protected $arrayHelper;

    public function __construct()
    {
        $this->session      = new Session();
        $this->arrayHelper  = new ArrayHelper();
    }

    public function dbConnection()
    {
        $cfg        = include_once __DIR__.'/../config.php';
        $db         = new UserDB($cfg['db']);
        return $db;
    }
}