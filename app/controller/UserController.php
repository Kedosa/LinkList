<?php


namespace app\controller;

class UserController extends BaseController
{
    public function getUserData($function = '', $db = ''){
        !empty($db) ? NULL : $db         = $this->dbConnection();
            switch ($function){
                case 'register':
                    $res    = $this->registerUser($db);
                    break;
                case 'login':
                    $res    = $this->loginUser($db);
                    break;
                case 'logout':
                    $res    = $this->logoutUser();
                    break;
                case 'updateFav':
                    $res    = $this->updateFavToUser($db);
                    break;
                case 'getUserFav':
                    $res    = $this->getUserFavs($db);
                    break;
                default:
                    echo 'Error function doesnt exist!';
                    break;
            }
        return $res;
    }

    public function chooseUserAction($functionArray){
        $db         = $this->dbConnection();
        if(is_array($functionArray)){
            foreach($functionArray as $function){
                $res[]  = $this->getUserData($function, $db);
            }
        }
        else{
            $res    = $this->getUserData($functionArray, $db);
        }
        return $res;
    }

    protected function registerUser($db){
        $firstName  = $_POST['regFirstName'];
        $name       = $_POST['regName'];
        $username   = $_POST['regUsername'];
        $eMail      = $_POST['regE-mail'];
        $password   = $_POST['regPassword'];
        $pwdLength  = strlen($password);
        $userExist  = $db->fetchUsername($username);
        $res        = 0;
        if(empty($userExist) && $pwdLength >= 8){
            $password   = password_hash($password, PASSWORD_DEFAULT);
            $db->registerUser($name, $firstName, $username, $eMail, $password);
            $res = 1;
        }
        return $res;
    }

    protected function loginUser($db){
        $username   = $_POST['username'];
        $password   = $_POST['password'];
        $res        = 0;
        $login      = $db->loginUser($username, $password);
        if($login === '1'){
            $userId     = $db->fetchUserId($username);
            $userId     = $userId['id'];
            $userArray  = array(
                'userId'    => $userId,
                'username'  => $username
            );
            $this->session->setSessionUserName($userArray);
            $res        = 1;
        }
        header('Location:index.php');
        return $res;
    }

    protected function updateFavToUser($db){
        !empty($_SESSION['userId']) ? $userId   = $_SESSION['userId']  :    $userId    = NULL ;
        if(!empty($userId)){
            if(!empty($_POST['addFav'])){
                $favArray	    = json_decode($_POST['addFav']);
                $this->updateHelper($favArray, $db, $userId, 'add');
            }
            if(!empty($_POST['deleteFav'])){
                $noFavArray	= json_decode($_POST['deleteFav']);
                $this->updateHelper($noFavArray, $db, $userId, 'remove');
            }
        }
        if(empty($_POST['user'])){
            header('Location:index.php');
        }
    }

    protected function updateHelper($array,$db ,$userId, $adjustment){
        foreach($array as $data){
            $tagId          = $db->getTagId($data);
            $tagIdArray[]   = $tagId;
        }
        if(!empty($tagIdArray)) {
            foreach ($tagIdArray as $tagId) {

                $adjustment==='add' ? $db->addToFavorite($userId, $tagId['id']) : $db->deleteFromFav($userId, $tagId['id']);
            }
        }
    }

    protected function getUserFavs($db){
        $res    = NULL;
        $userId = $_SESSION['userId'];
        if(!empty($db->getUserFavTags($userId))){
            $favArray   = $db->getUserFavTags($userId);
            $res        = $favArray;
        }
        return $res;
    }

    protected function logoutUser(){
        if(!empty($_POST['logout'])){
            session_destroy();
        }
        header('Location:index.php');
    }
}