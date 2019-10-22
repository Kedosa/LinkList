<?php


namespace app\element;


interface ElementInterface
{
    /**
     * ElementInterface constructor.
     * @param $data
     * @param $tag
     * @param $dataKey
     * @param $template
     */
    public function __construct($data, $tag, $dataKey, $template);

    /**
     * @return mixed
     */
    public function getValues();
}