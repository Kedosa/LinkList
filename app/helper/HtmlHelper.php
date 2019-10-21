<?php
namespace app\helper;

class HtmlHelper
{
    public function navMenu($navBtns, $navDataArray)
    {
        $tplHelper = new TplHelper();
        $arrayHelper = new ArrayHelper();
        $nav = $tplHelper->searchTemplate('nav');
        $btnTemplate = $tplHelper->searchTemplate('button');
        $dropdownBtnArray = $this->createDropdownBtns($navDataArray, $btnTemplate);
        $dropdownMenu = $this->dropdownMenu($navBtns, $dropdownBtnArray);
        $navDropdown = $arrayHelper->replaceLoopValue($nav, $dropdownMenu);
        !empty($_SESSION['userId']) ? $navDropdown = str_replace('####username####', $_SESSION['username'], $navDropdown) : NULL;
        return $navDropdown;
    }

    public function createDropdownBtns($dropdownArray, $template){
        $res = NULL;
        $btns = NULL;
        $btnArray = NULL;
        $lastValue = end($dropdownArray);
        $lastName = $lastValue['name'];
        $lastSubcategory = $lastValue['subcategory'];
        foreach($dropdownArray as $dataArray){
            $dropdownBtn = $template;
            foreach($dataArray as $btnKey => $btnValue){
                $token = '####'.$btnKey.'####';
                $dropdownBtn = str_replace($token, $btnValue, $dropdownBtn);
            }
            if(!empty($subortinatedBtn) && $subortinatedBtn != $dataArray['name']){
               $btnArray['####link'.$subortinatedBtn.'####'] = $btns;
               $btns = $dropdownBtn;
            }
            else{
                $btns = $btns.$dropdownBtn;
            }
            if($lastSubcategory === $dataArray['subcategory']){
                $btnArray['####link'.$lastName.'####'] = $btns;
                $btns = $dropdownBtn;
            }
            $subortinatedBtn = $dataArray['name'];
        }
        $res = $btnArray;
        return $res;
    }


    public function dropdownMenu($file, $linkArray)
    {
        foreach($linkArray as $linkKey => $link){
            if(empty($dropdownMenu)){
                $dropdownMenu   = str_replace($linkKey, $link, $file);
            }
            elseif(!empty($dropdownMenu)){
                $dropdownMenu   = str_replace($linkKey, $link, $dropdownMenu);
            }
        }
        $dropdown['dropdown']   = $dropdownMenu;
        return $dropdown;
    }

    public function createLoginOutput()
    {
        $tplHelper  = new TplHelper();
        $loginForm  = $tplHelper->searchTemplate('login');
        return $loginForm;
    }

    public function closeTable($table)
    {
        $tplHelper  = new TplHelper();
        $tableEnd   = $tplHelper->searchTemplate('tableEnd');
        $table      = $table.$tableEnd;
        return $table;
    }

    public function embedTag($toEmbed, $token, $tmpl){
        $tplHelper  = new TplHelper();
        $embedIn = $tplHelper->searchTemplate($tmpl);
        $token = '####'.$token.'####';
        $embedded = str_replace($token, $toEmbed, $embedIn);
        return $embedded;
    }

    public function createFormTable($table, $favTags)
    {
        if(empty($_SESSION['userId'])){
            $favTags    = ' ';
        }
        $tplHelper  = new TplHelper();
        $tableForm  = $tplHelper->searchTemplate('favoriteForm');
        $tableForm  = str_replace('####fav####', $favTags, $tableForm);
        return $res = str_replace('####table####', $table, $tableForm);
    }

}