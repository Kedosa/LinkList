<?php

namespace app\element;

class ElementHeadline extends BaseElement
{
    public function getValues(){
        $token = '####headline####';

        if($this->tag === 'table'){
            $tableBeginContent = $this->tplHelper->searchTemplate('tableBegin');
//            $tableEndContent = $this->tplHelper->searchTemplate('tableEnd');
            $res = $tableBeginContent.$this->template;
            if(!empty($this->template)){
                $res = $this->template;
            }
        }
        elseif($this->tag === 'nav'){
            $navTpl = $this->tplHelper->searchTemplate('button');
            $navItem = $this->replaceContentFile($navTpl, $token, $this->data);
            $res = $this->template.$navItem;
        }
        elseif($this->tag === 'searched'){
            $navTpl = $this->tplHelper->searchTemplate('button');
            $navItem = $this->replaceContentFile($navTpl, $token, $this->data);
            $res = $this->template.$navItem;
        }
        return $res;
    }
    public function replaceContentFile($file, $replace, $replaceValue){
        $contentReplaced = str_replace($replace, $replaceValue, $file);
        $res = $contentReplaced;
        return $res;
    }
}