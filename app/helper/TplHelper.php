<?php

namespace app\helper;


class TplHelper
{
    public function searchTemplate($searchedTpl){
        $res = 0;
        $tplArray = array(
            'nav' => __DIR__.'/../tpl/nav.tpl.txt',
            'navEnd' => __DIR__.'/../tpl/navEnd.tpl.txt',
            'navItem' => __DIR__.'/../tpl/navItem.tpl.txt',
            'tableBegin' => __DIR__.'/../tpl/table.tpl.txt',
            'tableSearchBegin' => __DIR__.'/../tpl/tableSearch.tpl.txt',
            'tableEnd' => __DIR__.'/../tpl/tableEnd.tpl.txt',
            'tbody' => __DIR__.'/../tpl/tbody.tpl.txt',
            'thead' => __DIR__.'/../tpl/thead.tpl.txt',
            'td' => __DIR__.'/../tpl/td.tpl.txt',
            'links' => __DIR__.'/../tpl/links.tpl.php'
        );
        foreach($tplArray as $tplKey => $tplData){
            if($tplKey === $searchedTpl){
                $res = $tplData;
            }
        }
        return $res;
    }
}