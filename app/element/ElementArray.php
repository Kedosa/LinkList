<?php

namespace app\element;


class ElementArray extends BaseElement
{
    public function getValues()
    {
        $res = NULL;
        empty($td) ? $td = NULL : $td;
        $tableData = '';
        $factory = ElementFactory::getFactory();
        foreach($this->data as $element => $infoArray){
            $element = $factory->getElement($infoArray, $this->tag, $element, $this->template);
            $tableData = $element->getValues();
            $this->template = $tableData;
            $res = $tableData;
        }
        return $res;
    }
}