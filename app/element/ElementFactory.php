<?php
namespace app\element;

class ElementFactory
{
    protected static $factory = null;
    protected function __construct(){
    }

    public function getElement($data, $tag, $dataKey = NULL, $template = NULL){
        if($dataKey === 'headline'){
            $element = new ElementHeadline($data, $tag, $dataKey, $template);
        }
        elseif($dataKey === 'block'){
            $element = new ElementLink($data, $tag, $dataKey, $template);
        }
        elseif($dataKey === 'category'){
            $element = new ElementLink($data, $tag, $dataKey, $template);
        }
        elseif($dataKey === 'user'){
            $element = new ElementUser($data, $tag, $dataKey, $template);
        }
        elseif(is_array($data)){
            $element  = new ElementArray($data, $tag, $dataKey, $template);
        }
        return $element;
    }
    public static function getFactory(){
        if(self::$factory === null){
            self::$factory = new self();
        }
        return self::$factory;
    }
}