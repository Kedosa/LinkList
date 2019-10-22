<?php


namespace app\helper;


class ArrayHelper
{
    /**
     * @param $file
     * @param $toReplaceArray
     * @return mixed
     */
    public function replaceLoopValue($file, $toReplaceArray)
    {
        foreach($toReplaceArray as $toReplaceKey => $toReplaceArrayData){
            $token      = '####'.$toReplaceKey.'####';
            $replaced    = str_replace($token, $toReplaceArrayData, $file);
        }
        return $replaced;
    }
}