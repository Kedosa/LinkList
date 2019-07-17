<?php
namespace app\helper;

class HtmlHelper
{
    public function navTag($listString){
        $this->tplHelper = new TplHelper();
        $navBeginTpl = $this->tplHelper->searchTemplate('nav');
        $navEndTpl = $this->tplHelper->searchTemplate('navEnd');
        $navBeginContent = file_get_contents($navBeginTpl);
        $navEndContent = file_get_contents($navEndTpl);
        $res = $navBeginContent.$listString.$navEndContent;
        return $res;
    }
}