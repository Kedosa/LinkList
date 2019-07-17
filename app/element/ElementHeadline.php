<?php

namespace app\element;

class ElementHeadline extends BaseElement
{
    public function getValues(){
        $token = '####headline####';
        if($this->tag === 'table'){
            $thTpl = $this->tplHelper->searchTemplate('thead');
            $tableBeginTpl = $this->tplHelper->searchTemplate('tableBegin');
            $tableEndTpl = $this->tplHelper->searchTemplate('tableEnd');
            $tableBeginContent = file_get_contents($tableBeginTpl);
            $tableEndContent = file_get_contents($tableEndTpl);
            if(file_exists($thTpl)){
                $th = $this->replaceContentHeadline($thTpl, $token, $this->data);
                $th = $tableBeginContent.$th;
            }
            $res = $this->template.$th;

            if(!empty($this->template)){
                $res = $this->template.$tableEndContent.$th;
            }
        }
        elseif($this->tag === 'nav'){
            $navTpl = $this->tplHelper->searchTemplate('navItem');
            if(file_exists($navTpl)){
                $navItem = $this->replaceContentHeadline($navTpl, $token, $this->data);
            }
            $res = $this->template.$navItem;
        }
        return $res;
    }
    public function replaceContentHeadline($file, $replace, $replaceValue){
        $fileContent = file_get_contents($file);
        $contentReplaced = str_replace($replace, $replaceValue, $fileContent);
        $res = $contentReplaced;
        return $res;
    }
}