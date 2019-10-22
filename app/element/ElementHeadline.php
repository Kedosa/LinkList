<?php

namespace app\element;

class ElementHeadline extends BaseElement
{
    /**
     * @return string
     */
    public function getValues(){
        $token = '####headline####';

        if($this->tag === 'table'){
            $tableBeginContent = $this->tplHelper->searchTemplate('tableBegin');
            $res = $tableBeginContent.$this->template;
            if(!empty($this->template)){
                $res = $this->template;
            }
        }
        if($this->tag === 'tableAdjust'){
            $tableBeginContent = $this->tplHelper->searchTemplate('tableConfig');
            $res = $tableBeginContent.$this->template;
            if(!empty($this->template)){
                $res = $this->template;
            }
        }
        elseif($this->tag === 'searched'){
            $navTpl = $this->tplHelper->searchTemplate('button');
            $navItem = $this->replaceContentFile($navTpl, $token, $this->data);
            $res = $this->template.$navItem;
        }
        return $res;
    }

    /**
     * @param $file
     * @param $replace
     * @param $replaceValue
     * @return mixed
     */
    public function replaceContentFile($file, $replace, $replaceValue){
        $contentReplaced = str_replace($replace, $replaceValue, $file);
        $res = $contentReplaced;
        return $res;
    }
}