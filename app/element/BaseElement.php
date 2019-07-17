<?php


namespace app\element;
use app\helper\ArrayHelper;
use app\helper\TplHelper;

abstract class BaseElement implements ElementInterface
{
    protected $data;
    protected $dataKey;
    protected $tplHelper;
    protected $template;
    protected $arrayHelper;
    protected $tag;
    var $counter;
    var $type;

    public function __construct($data, $tag, $dataKey, $template)
    {
        $this->template = $template;
        $this->data = $data;
        $this->tag = $tag;
        $this->dataKey = $dataKey;
        $this->tplHelper = new TplHelper();
        $this->arrayHelper = new ArrayHelper();
    }
}