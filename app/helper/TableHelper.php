<?php


namespace app\helper;


use app\element\ElementFactory;

class TableHelper
{
    public function getTableOutputDirector($output, $menuArray = ''){
        switch ($output){
//            case 'adjust':
//                $content    = $this->userHomeOutput($menuArray);
//                break;
            case 'dbManagement':
                $content = $this->dbAdjustmentOutput($menuArray);
                break;
            case 'dataConfig':
                $content = $this->adminDbOutput($menuArray);
                break;
            case 'add':
                $content = $this->addLinkOutput($menuArray);
                break;
//            case 'toConfig':
//                $content    = $this->userAdjustmentOutput($menuArray);
//                break;
            default:
                $content    = $this->createTable($menuArray);
                break;
        }
        $res = $content;
        return $res;
    }

    public function createTable($tableData){
        $htmlHelper = new HtmlHelper();
        $table      = 0;
        $factory    = ElementFactory::getFactory();
        if(!empty($_GET['searchValue'])){
            if(!empty($tableData)) {
                $element = $factory->getElement($tableData, 'table', 'table', '');
                $table   = $element->getValues();
            }
            $table       = $this->foundTable($table);
        }
        else{
            $element     = $factory->getElement($tableData, 'table','table', '');
            $table       = $element->getValues();
        }
        $table      = $htmlHelper->closeTable($table);
        return $table;
    }

    /**
     * @param $tableData
     * @return mixed|string|null
     */
    public function dbAdjustmentOutput($tableData){
        $htmlHelper = new HtmlHelper();
        if(!empty($_SESSION['admin'])){
            $factory = ElementFactory::getFactory();
            $element = $factory->getElement($tableData, 'tableAdjust', 'table', '');
            $table   = $element->getValues();
        }
        $table      = $htmlHelper->closeTable($table);
        return $table;
    }

    /**
     * @param $menuArray
     * @return mixed|null
     */
    public function adminDbOutput($menuArray){
        $res = NULL;
        if(!empty($_SESSION['admin'])){
            $categoryArray = $menuArray['category'];
            $iconArray = $menuArray['icon'];
            $menuDataArray[] = $menuArray['menuData'];
            $factory = ElementFactory::getFactory();
            $elementCategory = $factory->getElement($categoryArray, 'option', '', '');
            $categoryOption = $elementCategory->getValues();
            $elementIcon = $factory->getElement($iconArray, 'option', '', '');
            $iconOption = $elementIcon->getValues();
            $elementLink = $factory->getElement($menuDataArray, 'linkAdjust', 'table', '');
            $link  = $elementLink->getValues();
            $link = str_replace('####iconOption####', $iconOption, $link);
            $link = str_replace('####categoryOption####', $categoryOption, $link);
        }
        $res = $link;
        return $res;
    }

    public function addLinkOutput($necessaryArray){
        $res = NULL;
        if(!empty($_SESSION['admin'])){
            $tplHelper  = new TplHelper();
            $categoryArray = $necessaryArray['category'];
            $iconArray = $necessaryArray['icon'];
            $factory = ElementFactory::getFactory();
            $elementCategory = $factory->getElement($categoryArray, 'option', '', '');
            $categoryOption = $elementCategory->getValues();
            $elementIcon = $factory->getElement($iconArray, 'option', '', '');
            $iconOption = $elementIcon->getValues();
            $link = $tplHelper->searchTemplate('newLink');
            $link = str_replace('####iconOption####', $iconOption, $link);
            $link = str_replace('####categoryOption####', $categoryOption, $link);
        }
        $res = $link;
        return $res;
    }

    public function foundTable($table){
        $res = $table;
        if(empty($table)){
            $res = 'Fehler: Der eingegebene Wert wurde in nicht gefunden';
        }
        return $res;
    }
}