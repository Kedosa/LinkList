<?php


namespace app\helper;


class TableHelper
{
    public function foundTable($table){
        $tplHelper = new TplHelper();
        $tableSearchBeginTpl = $tplHelper->searchTemplate('tableSearchBegin');
        $tableSearchBeginContent = file_get_contents($tableSearchBeginTpl);
        if(empty($table)){
            $res = 'Fehler: Der eingegebene Wert wurde in nicht gefunden';
        }
        else{
            $res = $this->startsWithTr($table, $tableSearchBeginContent);
        }
        return $res;
    }
    public function startsWithTr($firstTag, $tableTag){
        $getTag = substr($firstTag, 0, 4);
        $res = $firstTag;
        if($getTag === '<tr>'){
            $res = $tableTag.$firstTag;
        }
        return $res;
    }
}