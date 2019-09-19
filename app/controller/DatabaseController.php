<?php

namespace app\controller;

class DatabaseController extends BaseController{
	
	public function addLinksToDB($array){
        $db         = $this->dbConnection();
        $res        = array();
        $linkArray  = $this->arrayHelper->getDataArray($array);
        foreach($linkArray as $link){
            $linkName   = $link['name'];
            $category   = $link['category'];
            $valueExist = $db->searchForLink($linkName, $category);
            if(empty($valueExist)){
                $db->addToLink($linkName, $category);
                $res    = [$linkName, $category];
            }
        }
		return $res;
	}
	public function deleteLinkFromDB($array){
	    $db             = $this->dbConnection();
	    $tagArray       = $db->getLinkNames();
	    $deletedArray   = array();
        $linkArray      = $this->arrayHelper->getDataArray($array);
        if(!empty($tagArray)){
	        foreach($tagArray as $tag){
	            $res            = 0;
	            $tagName        = $tag['name'];
	            $tagCategory    = $tag['category'];
                foreach($linkArray as $link){
                    $linkName       = $link['name'];
                    $linkCategory   = $link['category'];
                    if($tagName === $linkName && $tagCategory === $linkCategory){
                        $res        = 1;
                    }
                }
                if($res === 0){
                    $db->deleteFromLink($tagName, $tagCategory);
                    $deletedArray[] = [$tagName, $tagCategory];
                }
            }
        }
        return $deletedArray;
    }
}