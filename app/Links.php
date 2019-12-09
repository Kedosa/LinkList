<?php
namespace app;
use app\element\ElementFactory,     app\helper\HtmlHelper,
    app\helper\ArrayHelper,         app\helper\TableHelper,
    app\controller\UserController,  app\controller\DatabaseController,
    app\helper\UserHelper;

class  Links
{
    private $data;
    private $multiArray;
    private $htmlHelper;
    private $tableHelper;
    private $uHelper;
    private $uController;
    private $dController;
    private $favArray;

    /**
     * Links constructor.
     */
    public function __construct(){
        /*
         * var u = user
         */
        $this->arrayHelper  = new ArrayHelper();
        $this->htmlHelper   = new HtmlHelper();
        $this->tableHelper  = new TableHelper();
        $this->uHelper      = new UserHelper();
        $this->uController  = new UserController();
        $this->dController	= new DatabaseController();
        $this->multiArray   = $this->dController->getMenuArray();
        $this->data         = $this->multiArray['menu'];

    }

    /**
     * @return int|mixed|string|null
     */
    public function tableContent(){
        $table = $this->tableHelper->getTableOutputDirector( 'default', $this->data);
        if(!empty($_POST['table'])){
            !empty($_POST['table']) ? $tableData = $this->tableData() : $tableData  = $this->data;
            $table = $this->tableHelper->getTableOutputDirector(key($_POST['table']), $tableData);
        }
        return $table;
    }

    /**
     * @return array|void|null
     */
    public function tableData()
    {
        if(!empty($_SESSION['admin']) && !empty($_POST['table'])){
            $tableData = $this->dController->getMenuAction(key($_POST['table']));
        }
        return $tableData;
    }

    /**
     * @return array|false|int|mixed|string|null
     */
    public function userContent(){
        $res        = $this->htmlHelper->createLoginOutput();
        $output     = NULL;
        if(!empty($_SESSION) && !empty($_POST['user'])){
            !empty($_POST['updateDb']) ? $this->updateLinkDatabase() : $userData = $this->userData();
            if(is_array($_POST['user'])){
                $output     = array_keys($_POST['user']);
            }
            $res        = $this->uHelper->userOutput($output, $this->data, $userData);
        }
        elseif(!empty($_POST['user'])){
            $this->userData();
        }
        elseif(empty($_POST['user']) && !empty($_SESSION) && empty($_POST['table'])){
            $userData   = $this->userData('true');
            $res        = $this->uHelper->userOutput('home', $this->data, $userData);
        }
        return $res;
    }

    /**
     * @param string $favUser
     * @return array|int|void|null
     */
    public function userData($favUser = ''){
        $res            = NULL;
        if(!empty($_POST['user']['updateFav']) && !empty($_SESSION['userId'])){
            $userArray      = ['updateFav', 'getUserFav'];
            $res            = $this->uController->chooseUserAction($userArray);
            $this->favArray = $res[1];
        }
        elseif(!empty($favUser) && empty($_POST['user'])){
            $userAction     = array('userAdjustment', 'userFavo');
            $res            = $this->uController->chooseUserAction($userAction);
            $this->favArray = $res[1];
        }
        elseif (key($_POST['user']) === 'userFavo'){
            $res            = $this->uController->chooseUserAction(key($_POST['user']));
            $this->favArray = $res;
        }
        elseif(array_key_exists('user', $_POST)){
            $userAction = array_keys($_POST['user']);
            $res        = $this->uController->chooseUserAction($userAction);
        }
        return $res;
    }


    /**
     * @return mixed
     */
    public function createNav()
    {
        $navArray   = $this->multiArray['nav'];
        $dropArray  = $this->multiArray['dropdown'];
        $factory    = ElementFactory::getFactory();
        $elmntNav   = $factory->getElement($dropArray, 'nav','', '');
        $navLinks   = $elmntNav->getValues();
        $nav        = $this->htmlHelper->navMenu($navLinks, $navArray);
        return $nav;
    }

    /**
     * @return array|false|int|mixed|string|null
     */
    public function content(){
        $tableContent   = $this->tableContent();
        $userContent    = $this->userContent();
        $homePos        = strpos($userContent, 'HOME');
        !empty($this->favArray)? $favoriteTags = json_encode($this->favArray) : $favoriteTags = '';
        $res            = $this->htmlHelper->createFormTable($tableContent, $favoriteTags);
        if(!empty($_POST['table']) && !empty($_SESSION['admin'])){
            $form = $this->htmlHelper->embedTag($res, 'table', 'tableForm');
            $res = $form;
        }
        elseif(!empty($_POST['user']) || $homePos === FALSE && !empty($_SESSION)){
            $res        = $userContent;
        }
//        else{
//            $res = NULL;
//        }
        return $res;
    }

    /**
     *
     */
    public function createSite(){
        $nav            = $this->createNav();
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