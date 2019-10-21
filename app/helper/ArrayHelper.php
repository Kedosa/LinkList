<?php


namespace app\helper;


class ArrayHelper
{
//    public function prepareTableValue($tableDataArray)
//    {
//        $htmlHelper = new HtmlHelper();
//        foreach($tableDataArray as $tableData => $infoArray){
//            if(count($infoArray) > 1 && is_array($infoArray)){
//                $res = $htmlHelper->tableBody($infoArray);
//            }
//            elseif(is_array($infoArray)){
//                $res = $this->prepareTableValue($infoArray);
//            }
//        }
//        return $res;
//    }

    public function getSearchedArray($array, $search)
    {
        $filterBlockArray   = array();
        foreach($array as $key => $data) {
            if(!empty($data['block']['name']) && is_string($data['block']['name'])) {
                $compare = $this->prepareCompare($data['block']['name'], $search);
            }

            if(!empty($data['block']['name']) && is_string($data['block']['name']) && $compare !== FALSE){
                $filterBlockArray[] = $data;
            }
            if(is_array($data)) {
                $filterData = $this->getSearchedArray($data, $search);
            }
            if(!empty($filterData)){
                    $filterBlockArray[] = $filterData ;

            }
        }
        !empty($filterBlockArray) ? $res[] = $filterBlockArray : $res = 0;
        return $res;
    }

    public function removeEmptySpaceFromArraySearch($array)
    {
        $removedEmptyArray = 0;
        if(is_array($array)){
            $arrayHeadline = array_pop($array);
            foreach($array as $key => $blockArray){
                foreach($blockArray as $blockKey => $blockData){
                    if(array_key_exists('block', $blockData))
                    {
                        $removedEmptyArray[] = $blockData;
                    }
                }
            }
            !empty($removedEmptyArray) ? $removedEmptyArray = array_merge($removedEmptyArray, $arrayHeadline) : $removedEmptyArray = $arrayHeadline;

        }
        return $removedEmptyArray;
    }

//    public function removeEmptySpaceFromArrayFav($array){
//        $res    = array();
//        foreach($array as $emptyArray){
//            $res[]  = $emptyArray[0][0][0][0];
//        }
//        return $res;
//    }

//    public function getDataArray($jsonArray){
//        foreach($jsonArray as $linkArray){
//            foreach($linkArray as $linkValue){
//                if(!empty($linkValue['block']['name'])){
//                    $linkName   = $linkValue['block']['name'];
//                    $category   = $linkValue['block']['type'];
//                    $link       = $linkValue['block']['link'];
//                    $comment    = $linkValue['block']['comment'];
//                    $icon       = $linkValue['block']['icon'];
//                    $linkData[] = ['name' => $linkName, 'category' => $category, 'link' => $link, 'comment' => $comment, 'icon' => $icon];
//                }
//            }
//        }
//        !empty($linkData) ? $res = $linkData : $res = NULL;
//        return $res;
//    }

//    public function countType($array, $search, $counter = 0)
//    {
//        $res = NULL;
//        if(is_array($array)){
//            foreach($array as $key => $type){
//                if($type === $search){
//                    $counter += 1;
//                }
//                elseif(is_array($type)){
//                    $counter = $this->countType($type, $search, $counter);
//                }
//            }
//        }
//        $res = $counter;
//        return $res;
//    }

    public function prepareCompare($filterValue, $search)
    {
        $filterValue = strtolower($filterValue);
        $searchedValue = strpos($filterValue, $search);
        return $searchedValue;
    }

//    public function filterString($filterArray, $toCut, $buttonArray = 0)
//    {
//        $start          = 0;
//        $length         = 0;
//        $last           = strlen($toCut);
//        $filterAfter    = current($filterArray);
//        $filterUpto     = next($filterArray);
//
//        $findValue      = strpos($toCut, $filterAfter);
//        $findNext       = strpos($toCut, $filterUpto);
//        if($findValue !== FALSE)
//        {
//            $length = $findNext - 16;
//
//            if(empty($findNext)){
//                $length = $last;
//            }
//        }
//
//        $links[$filterAfter] = substr($toCut, $start, $length);
//        if(!empty($buttonArray)){
//            $links = array_merge($buttonArray, $links);
//        }
//        if(!empty($filterUpto)){
//            array_shift($filterArray);
//            $last       = $last-$length;
//            $toCut      = substr($toCut, $length, $last);
//            $links  = $this->filterString($filterArray, $toCut, $links);
//        }
//        return $links;
//    }

//    public function filterArray($arrayToFilter, $filterBy)
//    {
//        $res = array();
//        if(empty($_GET['searchValue']))
//        {
//            foreach($arrayToFilter as $filterArray){
//                $toCompare = $filterArray['headline'];
//                $toCompare = $this->filterAdditionalChars($toCompare);
//                if($toCompare === $filterBy){
//                    $res = $filterArray;
//                }
//            }
//        }
//        else{
//            foreach($arrayToFilter as $filterArray){
//                foreach($filterArray[0] as $toFilter){
//                    !empty($toFilter['block']['type']) ? $compareValue = $toFilter['block']['type'] : $compareValue = 0;
//                    if($filterBy === $compareValue && is_array($toFilter)){
//
//                        $res[] = $toFilter;
//                    }
//                }
//            }
//        }
//        return  $res;
//    }
//    public function filterAdditionalChars($toFilter)
//    {
//        $toFilter = strtolower($toFilter);
//        $toFilter = str_replace(
//            array('ä', 'ö', 'ü', ' '),
//            array('ae', 'oe', 'ue', '_'),
//            $toFilter
//        );
//        return $toFilter;
//    }
    public function replaceLoopValue($file, $toReplaceArray)
    {
        foreach($toReplaceArray as $toReplaceKey => $toReplaceArrayData){
            $token      = '####'.$toReplaceKey.'####';
            $replaced    = str_replace($token, $toReplaceArrayData, $file);
        }
        return $replaced;
    }
}