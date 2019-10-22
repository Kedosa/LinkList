<?php


namespace app\element;
use app\helper\ArrayHelper;
use app\helper\TplHelper;
use app\helper\HtmlHelper;
//use app\service\UserDB;

abstract class BaseElement implements ElementInterface
{
    protected $data;
    protected $dataKey;
    protected $tplHelper;
    protected $template;
    protected $arrayHelper;
    protected $htmlHelper;
    protected $tag;

    /**
     * BaseElement constructor.
     * @param $data
     * @param $tag
     * @param $dataKey
     * @param $template
     */
    public function __construct($data, $tag, $dataKey, $template)
    {
        $this->template     = $template;
        $this->data         = $data;
        $this->tag          = $tag;
        $this->dataKey      = $dataKey;
        $this->tplHelper    = new TplHelper();
        $this->arrayHelper  = new ArrayHelper();
        $this->htmlHelper   = new HtmlHelper();
    }
}