<?php

namespace app\helper;


class TplHelper
{
    public function searchTemplate($searchedTpl){
        $res = 0;
        $tplArray = array(
            'nav'               => __DIR__.'/../tpl/nav.tpl.txt',
            'navEnd'            => __DIR__.'/../tpl/navEnd.tpl.txt',
            'link'              => __DIR__.'/../tpl/link.tpl.txt',
            'dropDownList'      => __DIR__.'/../tpl/dropDownList.tpl.txt',
            'tableBegin'        => __DIR__.'/../tpl/table.tpl.txt',
            'tableSearchBegin'  => __DIR__.'/../tpl/tableSearch.tpl.txt',
            'tableFavBegin'     => __DIR__.'/../tpl/tableFav.tpl.txt',
            'tableEnd'          => __DIR__.'/../tpl/tableEnd.tpl.txt',
            'tbody'             => __DIR__.'/../tpl/tbody.tpl.txt',
            'thead'             => __DIR__.'/../tpl/thead.tpl.txt',
            'td'                => __DIR__.'/../tpl/td.tpl.txt',
            'button'            => __DIR__.'/../tpl/button.tpl.txt',
            'links'             => __DIR__.'/../tpl/links.tpl.php',
            'dropdown'          => __DIR__.'/../tpl/divDropdown.tpl.txt',
            'login'             => __DIR__.'/../tpl/login.tpl.txt',
            'logout'            => __DIR__.'/../tpl/logout.tpl.txt',
            'favoriteForm'      => __DIR__.'/../tpl/formUserOnline.tpl.txt',
            'scriptStar'        => __DIR__.'/../tpl/scriptHighlightPage.tpl.txt'
        );
        foreach($tplArray as $tplKey => $tplData){
            if($tplKey === $searchedTpl){
                $fileUrl = $tplData;
            }
        }
        $file = file_get_contents($fileUrl);
        $res = $file;
        return $res;
    }
}