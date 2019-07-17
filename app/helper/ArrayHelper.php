<?php


namespace app\helper;


class ArrayHelper
{
    public function prepareTableValue($tableDataArray){
        $htmlHelper = new HtmlHelper();
        foreach($tableDataArray as $tableData => $infoArray){
            if(count($infoArray) > 1 && is_array($infoArray)){
                $res = $htmlHelper->tableBody($infoArray);
            }
            elseif(is_array($infoArray)){
                $res = $this->prepareTableValue($infoArray);
            }
        }
        return $res;
    }
    public function getSearchedArray($array, $search){
        $filterArray = array();
        foreach($array as $key => $data) {
            if(!empty($data['headline']) && is_string($data['headline'])) {
                $compare = $this->prepareCompare($data['headline'], $search);
            }
            elseif(!empty($data['block']['name']) && is_string($data['block']['name'])) {
                $compare = $this->prepareCompare($data['block']['name'], $search);
            }
            if(!empty($data['headline']) && is_string($data['headline']) && $compare !== FALSE) {
                $filterArray[] = $data;
                continue;
            }
            elseif(!empty($data['block']['name']) && is_string($data['block']['name']) && $compare !== FALSE){
                $filterArray[] = $data;
            }
            if(is_array($data)) {
                $filterData = $this->getSearchedArray($data, $search);
            }
            if(!empty($filterData)){
                $filterArray[] = $filterData;
            }
        }

        $res = $filterArray;
        return $res;
    }
    public function countType($array, $search, $counter = 0){
        $res = NULL;
        if(is_array($array)){
            foreach($array as $key => $type){
                if($type === $search){
                    $counter += 1;
                }
                elseif(is_array($type)){
                    $counter = $this->countType($type, $search, $counter);
                }
            }
        }
        $res = $counter;
        return $res;
    }
    public function prepareCompare($filterValue, $search){
        $filterValue = strtolower($filterValue);
        $searchedValue = strpos($filterValue, $search);
        return $searchedValue;
    }
}