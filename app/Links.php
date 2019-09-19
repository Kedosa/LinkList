<?php
namespace app;
use app\element\ElementFactory,     app\helper\HtmlHelper,
    app\helper\ArrayHelper,         app\helper\TableHelper,
    app\controller\UserController,  app\controller\DatabaseController;

class Links
{
    private $data;
    private $htmlHelper;
    private $tableHelper;
    private $searchTable;
    private $uController;
	private $dController;
	private $favUserArray;
	private $username;

    public function __construct($data)
    {
        /*
         * var u = user
         */
        $this->data         = $data;
        $this->arrayHelper  = new ArrayHelper();
        $this->htmlHelper   = new HtmlHelper();
        $this->tableHelper  = new TableHelper();
        $this->uController  = new UserController();
		$this->dController	= new DatabaseController();
//        $this->favUserArray = $this->uController->getUserData('getUserFav');

    }

    public function searchArray(){
        if(!empty($_GET['searchValue'])){
            $search             = $_GET['searchValue'];
            $search             = strtolower($search);
            $filterArray        = $this->arrayHelper->getSearchedArray($this->data, $search);
            $removedEmptyArray  = $this->arrayHelper->removeEmptySpaceFromArraySearch($filterArray);
            $this->data         = $removedEmptyArray;
            $this->searchTable  = TRUE;
        }
    }

    public function userData(){
        $res                = NULL;
        $this->username     = NULL;
        if(!empty($_POST['login'])){
            $res        = $this->uController->getUserData('login');
        }
        elseif(!empty($_POST['register'])){
            $res        = $this->uController->getUserData('register');
        }
        elseif(!empty($_POST['logout'])){
            $res        = $this->uController->getUserData('logout');
        }
        if(!empty($_POST['updateFav']) && !empty($_SESSION['userId'])){
            $userArray  = ['updateFav', 'getUserFav'];
            $res        = $this->uController->chooseUserAction($userArray);
            $this->favUserArray = $res[1];
        }
        elseif(!empty($_POST['updateFav'])){
            $res        = $this->uController->getUserData('updateFav');
        }
        elseif(!empty($_SESSION['userId'])){
            $this->favUserArray = $this->uController->getUserData('getUserFav');
        }

            return $res;
    }

    public function userFavOutput(){
        $res            = NULL;
        if(!empty($this->favUserArray)){
            foreach($this->favUserArray as $tag){
                $name       = strtolower($tag['name']);
                $userTag    = $this->arrayHelper->getSearchedArray($this->data, $name);
                $favTags[]  = $userTag;
            }
            $removedEmptyArray  = $this->arrayHelper->removeEmptySpaceFromArrayFav($favTags);
            $favTagsTableBody   = $this->createTable($removedEmptyArray);
            $favTagsTable       = $this->tableHelper->encloseTable($favTagsTableBody);
            $res                = $favTagsTable;
        }
        return $res;
    }

    public function loginOutput(){
        return $output  = $this->htmlHelper->createLoginOutput();
    }

    public function logoutOutput(){
        $logoutOutput   = $this->htmlHelper->createLogoutOutput();
        $favTagOutput   = $this->userFavOutput();
        $output         = $logoutOutput.$favTagOutput;
        return $output;
    }

	public function updateLinkDatabase(){
		$res 		= array();
        if(!empty($_POST['updateDb'])){
            $newArray 	    = $this->dController->addLinksToDB($this->data);
            $deletedArray 	= $this->dController->deleteLinkFromDB($this->data);
            $res            = [$newArray, $deletedArray];
        }
        return $res;
	}
	
    public function createTable($tableData = '')
    {
        $table      = 0;
        $factory    = ElementFactory::getFactory();
        empty($tableData) ? $tableData = $this->data : NULL;
        if($this->searchTable === TRUE){
            if(!empty($tableData)) {
                $element = $factory->getElement($tableData, 'table', '', '');
                $table   = $element->getValues();
            }
            $table       = $this->tableHelper->foundTable($table);
        }
        else{
            $element     = $factory->getElement($tableData, 'table','', '');
            $table       = $element->getValues();
        }
        $table      = $this->htmlHelper->closeTable($table);
        return $table;
    }

    public function createNav($array)
    {
        $factory        = ElementFactory::getFactory();
        $element        = $factory->getElement($array, 'nav','', '');
        $navLinks       = $element->getValues();
        $nav            = $this->htmlHelper->navMenu($navLinks, $array);
        return $nav;
    }

    public function content()
    {
        !empty($this->favUserArray)? $favoriteTags = json_encode($this->favUserArray) : $favoriteTags = '';
        $tableContent   = $this->createTable('');
        $userContent    = $this->loginOutput();
        $res            = $this->htmlHelper->createFormTable($tableContent, $favoriteTags);
//        if(!empty($_SESSION['userId']) && empty($_POST['user'])){
//            $favoriteTags   = $this->favUserArray;
//            $favoriteTags   = json_encode($favoriteTags);
//            $res = $this->htmlHelper->createFormTable($tableContent, $favoriteTags);
//        }
        if(!empty($_SESSION) && !empty($_POST['user'])){
            $userContent  = $this->logoutOutput();
        }
        !empty($_POST['register'])  ? $userValidate   = $this->userData()        : $userValidate = 1;
        !empty($_POST['login'])     ? $userValidate   = $this->userData()        : $userValidate = 1;
        !empty($_POST['logout'])    ? $userValidate   = $this->userData()        : $userValidate = 1;
        if(!empty($_POST['user']) || $userValidate === 0){
            $_POST      = array();
            $res        = $userContent;

        }
        return $res;
    }


    public function createSite($array)
    {
        !empty($_GET['filterBy'])       ? $filterBy = 'Es wird nach der Kategorie "'.$_GET['filterBy'].'" gefiltert.' : $filterBy = " ";
        !empty($_POST['addLinksToDb'])  ? $this->updateLinkDatabase() : NULL;
        !empty($_SESSION['userId'])     ? $this->userData() : NULL;
        $nav            = $this->createNav($array);
        $content        = $this->content();
        $bootstrap4     = 'app/bootstrap-4/css/bootstrap.min.css';
        $css            = 'app/css/Links.css';
        $fontAwsome     = 'app/css/Font-Awesome-fa-4/css/font-awesome.css';
        $jquery         = 'app/bootstrap-4/jquery-3.2.1.slim.min.js';
        $proper         = 'app/bootstrap-4/popper.min.js';
        $bootstrapJS    = 'app/bootstrap-4/js/bootstrap.min.js';
        $filterScript   = 'app/javascript/filter.js';
        !empty($_GET['searchValue'])    ? $searched = $_GET['searchValue'] : $searched = NULL;
        include_once __DIR__.'/view/htmlView.php';
    }
}