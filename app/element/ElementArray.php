<?php

namespace app\element;


class ElementArray extends BaseElement
{
    /**
     * @return mixed|string|null
     */
    public function getValues()
    {
        $res = NULL;
        empty($td) ? $td = NULL : $td;
        $tableData = '';
        $factory = ElementFactory::getFactory();
        if($this->tag === "table" || $this->tag === 'tableAdjust'){
            array_unshift($this->data, 0);
        }
        foreach($this->data as $element => $infoArray){
            if($this->tag === 'table' && $element === 0 || $this->tag === 'tableAdjust' && $element === 0){
                $element = 'headline';
            }
            elseif(is_int($element) && $this->tag === 'table' || is_int($element) && $this->tag === 'tableAdjust'){
                $element = 'block';
            }
            elseif($element === 'name' && $this->tag === 'nav'){
                $element = 'block';
            }
            elseif (is_int($element) && $this->tag === 'navBtn'){
                $element = 'block';
            }
            elseif ($this->tag === 'linkAdjust' || $this->tag === 'option'){
                $element = 'block';
            }

            $element = $factory->getElement($infoArray, $this->tag, $element, $this->template);
            if(!empty($tableData) && $this->tag === 'nav'){
                $tableData = $tableData.$element->getValues();
            }
            else{
                $tableData = $element->getValues();
            }

            $this->template = $tableData;
            $res = $tableData;
            if($this->tag === 'nav'){
                $res = $tableData;
            }
        }
        return $res;
    }
}