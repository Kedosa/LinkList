<?php


namespace app\element;


interface ElementInterface
{
    public function __construct($data, $tag, $dataKey, $template);
    public function getValues();
}