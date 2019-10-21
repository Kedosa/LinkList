<?php

namespace app\helper;


class TplHelper
{
    public function searchTemplate($searchedTpl){
        $res = 0;
        $tplArray = array(
            'nav'               => __DIR__.'/../tpl/nav.tpl.txt',
            'link'              => __DIR__.'/../tpl/link.tpl.txt',
            'tableBegin'        => __DIR__.'/../tpl/table.tpl.txt',
            'tableConfig'       => __DIR__.'/../tpl/tableConfig.tpl.txt',
            'tableSearchBegin'  => __DIR__.'/../tpl/tableSearch.tpl.txt',
            'tableFavBegin'     => __DIR__.'/../tpl/tableFav.tpl.txt',
            'tableEnd'          => __DIR__.'/../tpl/tableEnd.tpl.txt',
            'tbody'             => __DIR__.'/../tpl/tbody.tpl.txt',
            'tbodyDbConfig'     => __DIR__.'/../tpl/tbodyAddToDb.tpl.txt',
            'userTable'         => __DIR__.'/../tpl/userTable.tpl.txt',
            'userTB'            => __DIR__.'/../tpl/userTableBody.tpl.txt',
            'button'            => __DIR__.'/../tpl/button.tpl.txt',
            'links'             => __DIR__.'/../tpl/links.tpl.php',
            'dropdown'          => __DIR__.'/../tpl/divDropdown.tpl.txt',
            'login'             => __DIR__.'/../tpl/login.tpl.txt',
            'tableForm'         => __DIR__.'/../tpl/form.tpl.txt',
            'menuConfigForm'    => __DIR__.'/../tpl/menuConfig.tpl.txt',
            'newLink'           => __DIR__.'/../tpl/addLink.tpl.txt',
            'favoriteForm'      => __DIR__.'/../tpl/formUserOnline.tpl.txt',
            'scriptStar'        => __DIR__.'/../tpl/scriptHighlightPage.tpl.txt',
            'userInterface'     => __DIR__.'/../tpl/userInterface.tpl.txt',
            'adminAdjustment'   => __DIR__.'/../tpl/adminAdjustment.tpl.txt',
            'adminAddAdmin'     => __DIR__.'/../tpl/adminAddAdmin.tpl.txt',
            'userConfig'        => __DIR__.'/../tpl/userConfig.tpl.txt',
            'userPassword'      => __DIR__.'/../tpl/userPassword.tpl.txt',
            'option'            => __DIR__.'/../tpl/option.tpl.txt'
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