<?php


namespace app\helper;
use app\element\ElementFactory;

class UserHelper
{
    /**
     * @param $outputArray
     * @param string $menuArray
     * @param string $userData
     * @return array|false|int|mixed|string|null
     */
    public function userOutput($outputArray, $menuArray = '', $userData = ''){
        $res    = NULL;
        if(is_array($outputArray)){
            foreach($outputArray as $output){
                $res[]  = $this->getUserOutputDirector($output, $menuArray, $userData);
            }
        }
        else{
            $res    = $this->getUserOutputDirector($outputArray, $menuArray, $userData);
        }
        if(is_array($res) && count($res) === 1){
            return $res[0];
        }
        return $res;
    }

    /**
     * @param $output
     * @param string $menuArray
     * @param string $userData
     * @return false|int|mixed|string|null
     */
    public function getUserOutputDirector($output, $menuArray = '', $userData = ''){
        switch ($output){
            case 'home':
                $content    = $this->userHomeOutput($userData);
                break;
            case 'user':
                if(!isset($userData[0]['user_interface'])){
                    $content = $this->userFavOutput($userData);
                }
                break;
            case 'userFavo':
                $content    = $this->userFavOutput($userData);
                break;
            case 'userAdjustment':
                $content    = $this->userAdjustmentOutput($userData);
                break;
            case 'userManagement':
                $content    = $this->adminOutput($userData);
                break;
            case 'userToManage':
                $content    = $this->adminUserOutput($userData);
                break;
            case 'userLinks':
                $content    = $this->userLinkOutput($userData[0]);
                break;
            case 'addLinkUser':
                $content    = $this->userAddLinkOutput($userData[0]);
                break;
            case 'linkConfig':
                $content = $this->userLinkConfigOutput($userData[0]);
                break;
            default:
                $content    = NULL;
                break;
        }
        $mainOutput = $this->userMainOutput();
        $res        = $mainOutput;
        if(empty($_POST['user']) && !empty($content)){
            $res            = $content;
        }
        elseif(!empty($_POST['user']) && !empty($content)){
            $res            = $mainOutput.$content;
        }
        return $res;
    }

    public function userLinkConfigOutput($linkArray){
        $res = NULL;
        if(!empty($_SESSION['admin'])){
            $iconArray = $linkArray['icon'];
            $menuDataArray[] = $linkArray['menuData'];
            $factory = ElementFactory::getFactory();
            $elementIcon = $factory->getElement($iconArray, 'option', '', '');
            $iconOption = $elementIcon->getValues();
            $elementLink = $factory->getElement($menuDataArray, 'userLinkAdjust', 'table', '');
            $link  = $elementLink->getValues();
            $link = str_replace('####iconOption####', $iconOption, $link);
            $res = $link;
        }
        return $res;
    }

    /**
     * @param $userData
     * @return false|int|mixed|string|null
     */
    public function userHomeOutput($userData){
        if($userData[0]['home'] === '1'){
            $homeArray[] = $userData['1'];
            $res    = $this->userFavOutput($homeArray);
        }
        else{
            $res   = "HOME";
        }
        return $res;
    }

    /**
     * @return mixed|null
     */
    public function userMainOutput(){
        $tplHelper  = new TplHelper();
        $res        = NULL;
        if(!empty($_SESSION)){
            $userOutput = $tplHelper->searchTemplate('userInterface');
            if($_SESSION['admin'] === '1'){
                $admin  = $tplHelper->searchTemplate('adminAdjustment');
                $res    = str_replace('####admin####', $admin, $userOutput);
            }
            else{
                $res    = str_replace('####admin####', '', $userOutput);
            }
            $res        = str_replace('####username####', $_SESSION['username'], $res);
        }
        return $res;
    }

    /**
     * @param $userData
     * @return false|int|mixed|string|null
     */
    public function userFavOutput($userData){
        $tableHelper = new TableHelper();
        $res = NULL;
        if(!empty($userData)){
            if(!empty($_POST) && key($_POST['user']) === 'userFavo'){
                $favTagsTableBody = $tableHelper->createTable($userData);
            }
            else{
                $favTagsTableBody = $tableHelper->createTable($userData[0]);
            }
            $res = $favTagsTableBody;
        }
        return $res;
    }

    /**
     * @param $userArray
     * @return mixed|string|null
     */
    public function userAdjustmentOutput($userArray){
        $res    = NULL;
        if(!empty($_SESSION['username'])){
            $factory    = ElementFactory::getFactory();
            $element    = $factory->getElement($userArray[0], 'userConfig', 'user', '');
            $res        = $element->getValues();
        }
        return $res;
    }

    /**
     * @param $userArray
     * @return mixed|string|null
     */
    public function adminUserOutput($userArray){
        $res    = NULL;
        if($_SESSION['admin']){
            $factory    = ElementFactory::getFactory();
            $element    = $factory->getElement($userArray[0], 'userConfig', 'user', '');
            $res        = $element->getValues();
        }
        return $res;
    }

    /**
     * @param $userArray
     * @return mixed|string|null
     */
    public function adminOutput($userArray){
        $res = NULL;
        if(!empty($_SESSION['admin'])) {
            $factory = ElementFactory::getFactory();
            $element = $factory->getElement($userArray[0], 'userTable', 'user', '');
            $res = $element->getValues();
        }
        return $res;
    }

    public function userLinkOutput($userMenuArray){
        $res = NULL;
        if(!empty($_SESSION)){
            $htmlHelper = new HtmlHelper();
            $tplHelper = new TplHelper();
            $table = $tplHelper->searchTemplate('userAddLinkBtn');
            $factory = ElementFactory::getFactory();
            if(!empty($userMenuArray)){
                $element = $factory->getElement($userMenuArray, 'userMenuTable','table', '');
                $table = $element->getValues();
                $table = $htmlHelper->embedTag($table, 'table', 'tableForm');
            }

            return $table;
        }
    }
    public function userAddLinkOutput($iconArray){
        $res = NULL;
        if(!empty($_SESSION)){
            $htmlHelper = new HtmlHelper();
            $factory = ElementFactory::getFactory();
            $elementIcon = $factory->getElement($iconArray, 'option', '', '');
            $iconOption = $elementIcon->getValues();
            $link = $htmlHelper->embedTag($iconOption, 'iconOption', 'userAddLink');
            $res = $link;
        }
        return $res;
    }

}