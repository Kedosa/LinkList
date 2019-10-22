<?php
namespace app\element;

class ElementFactory
{
    protected static $factory = null;

    /**
     * ElementFactory constructor.
     */
    protected function __construct(){
    }

    /**
     * @param $data
     * @param $tag
     * @param null $dataKey
     * @param null $template
     * @return ElementArray|ElementHeadline|ElementLink|ElementUser|null
     */
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
        elseif(empty($data)){
            $element = NULL;
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