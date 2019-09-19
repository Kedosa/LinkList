<?php
namespace app\helper;

class HtmlHelper
{
    public function navMenu($links, $array)
    {
        $tplHelper    = new TplHelper();
        $arrayHelper  = new ArrayHelper();

        $nav                = $tplHelper->searchTemplate('nav');
        $topicArray         = $arrayHelper->navHelperArray($array);
        $dropFileArray      = $arrayHelper->getHeadline($array);
        $linkArray          = $arrayHelper->filterString($topicArray, $links);
        $dropdownMenu       = $this->dropdownMenu($dropFileArray[0], $linkArray);
        $navDropdown        = $arrayHelper->replaceLoopValue($nav, $dropdownMenu);
        !empty($_SESSION['userId']) ? $navDropdown = str_replace('####username####', $_SESSION['username'], $navDropdown) : NULL;
        return $navDropdown;
    }

    public function dropdownMenu($file, $linkArray)
    {
        $this->arrayHelper      = new ArrayHelper();
        $dropdown['dropdown']   = $this->arrayHelper->replaceLoopValue($file, $linkArray);
        foreach($linkArray as $linkKey => $link){
            $token              = '####link'.$linkKey.'####';
            if(empty($dropdownMenu)){
                $dropdownMenu   = str_replace($token, $link, $file);
            }
            elseif(!empty($dropdownMenu)){
                $dropdownMenu   = str_replace($token, $link, $dropdownMenu);
            }
        }
        $dropdown['dropdown']   = $dropdownMenu;
        return $dropdown;
    }

    public function createLoginOutput()
    {
        $this->tplHelper    = new TplHelper();
        return $loginForm   = $this->tplHelper->searchTemplate('login');
    }

    public function createLogoutOutput()
    {
        $this->tplHelper    = new TplHelper();
        return $loginForm   = $this->tplHelper->searchTemplate('logout');
    }

    public function closeTable($table)
    {
        $this->tplHelper    = new TplHelper();
        $tableEnd           = $this->tplHelper->searchTemplate('tableEnd');
        $table              = $table.$tableEnd;
        return $table;
    }

    public function createFormTable($table, $favTags)
    {
        if(empty($_SESSION['userId'])){
            $favTags    = ' ';
        }
        $tplHelper          = new TplHelper();
        $tableForm          = $tplHelper->searchTemplate('favoriteForm');
        $tableForm          = str_replace('####fav####', $favTags, $tableForm);
        return $res         = str_replace('####table####', $table, $tableForm);
    }

}