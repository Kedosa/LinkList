<?php
namespace app;
use app\element\ElementFactory;
use app\helper\HtmlHelper;
use app\helper\ArrayHelper;
use app\helper\TableHelper;

class Links
{
    private $data;
    private $htmlHelper;
    private $tableHelper;
    private $searchTable;

    public function __construct($data)
    {
        $this->data = $data;
        $this->arrayHelper = new ArrayHelper();
        $this->htmlHelper = new HtmlHelper();
        $this->tableHelper = new TableHelper();
    }

    public function searchArray(){
        if(!empty($_GET['searchValue'])){
            $search = $_GET['searchValue'];
            $filterArray = $this->arrayHelper->getSearchedArray($this->data, $search);
            $this->data = $filterArray;
            $this->searchTable = TRUE;
        }
    }
    public function createTable(){
        $factory = ElementFactory::getFactory();
        $element = $factory->getElement($this->data, 'table','', '');
        $table = $element->getValues();
        if($this->searchTable === TRUE){
            $table = $this->tableHelper->foundTable($table);
        }
        return $table;
    }
    public function createNavLi()
    {
        $factory = ElementFactory::getFactory();
        $element = $factory->getElement($this->data, 'nav','', '');
        $nav = $element->getValues();
        return $nav;
    }
    public function createNav(){
        $navLi = $this->createNavLi();
        $res = $this->htmlHelper->navTag($navLi);
        return $res;
    }
    public function createSite(){
        $nav = $this->createNav();
        $table = $this->createTable();
        $bootstrap4 = 'app/bootstrap-4/css/bootstrap.min.css';
        $css = 'app/css/Links.css';
        $jquery = 'app/bootstrap-4/jquery-3.2.1.slim.min.js';
        $proper = 'app/bootstrap-4/popper.min.js';
        $bootstrapJS = 'app/bootstrap-4/js/bootstrap.min.js';
        include_once __DIR__.'/view/htmlView.php';
    }
}