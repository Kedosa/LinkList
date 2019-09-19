<?php


namespace app\helper;


class TableHelper
{
    public function foundTable($table){
        $tplHelper  = new TplHelper();
        $tableBegin = $tplHelper->searchTemplate('tableSearchBegin');
        $res        = $tableBegin.$table;
        if(empty($table)){
            $res = 'Fehler: Der eingegebene Wert wurde in nicht gefunden';
        }
        return $res;
    }

    public function encloseTable($tableBody){
        $username   = $_SESSION['username'];
        $tplHelper  = new TplHelper();
        $tableTpl   = $tplHelper->searchTemplate('tableFavBegin');
        $tableTpl   = str_replace('####username####', $username, $tableTpl);

//        $tableTpl = str_replace('####vavs####' , '{"foo":true, "bar": false}', $tableTpl);

        $table      = $tableTpl.$tableBody;
        $starFocus  = $tplHelper->searchTemplate('scriptStar');
        return $table.$starFocus;
    }
//    public function startsWithTr($firstTag, $tableTag){
//        $getTag = substr($firstTag, 0, 4);
//        $res = $firstTag;
//        if($getTag === '<tr>'){
//            $res = $tableTag.$firstTag;
//        }
//        return $res;
//    }
}