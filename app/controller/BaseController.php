<?php

namespace app\controller;
use app\helper\HtmlHelper;
use       app\service\UserDB,     app\service\Session,
          app\helper\ArrayHelper, app\helper\TplHelper;


abstract class BaseController
{
    protected $session;
    protected $arrayHelper;
    protected $tplHelper;
    protected $htmlHelper;
    protected $cfg;

    public function __construct()
    {
        $this->session      = new Session();
        $this->arrayHelper  = new ArrayHelper();
        $this->tplHelper    = new TplHelper();
    }

    public function dbConnection()
    {
        if(empty($this->cfg)){
            $this->cfg    = include __DIR__.'/../config.php';
        }
        $db     = new UserDB($this->cfg['db']);
        return $db;
    }
}