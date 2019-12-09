<?php


namespace app\controller;

class UserController extends BaseController
{
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
            case 'addFav':
                $res    = $this->addFavToUser($db);
                break;
            case 'deleteFav':
                $res    = $this->deleteFavToUser($db);
                break;
            case 'user':
                $res    = $this->getUserConfigData($db);
                break;
            case 'userFavo':
                $res    = $this->getUserFavs($db);
                break;
            case 'userManagement':
                $res    = $this->getAllUsers($db);
                break;
            case 'userToManage':
                $res    = $this->getUserConfigData($db);
                break;
            case 'userAdjustment':
                $res    = $this->getUserConfigData($db);
                break;
            case 'abortManage':
                header('Location:index.php');
                break;
            case 'saveManage':
                $res    = $this->updateUserData($db);
                break;
            case 'deleteUser':
                $res    = $this->deleteUser($db);
                break;
            case 'userLinks':
                $res    = $this->getUserLinks($db);
                break;
            case 'addLinkUser':
                $res    = $this->fetchIcons($db);
                break;
            case 'saveLink':
                $res    = $this->saveUserLink($db);
                break;
            case 'linkConfig':
                $res = $this->getUserLinktData($db);
                break;
            case 'saveConfigLink':
                $res = $this->saveAdjustedData($db);
                break;
            case 'deleteLink':
                $res = $this->deleteLink($db);
                break;
            default:
                $res    = NULL;
                break;
        }
        return $res;
    }

    public function getUserLinktData($db){
        $menuId = $_POST['user']['linkConfig'];
        $menuData = $db->fetchMenuData($menuId);
        $iconData = $db->fetchIcons();
        $res = [
            'menuData' => $menuData,
            'icon' => $iconData,
        ];
        return $res;
    }

    public function getAllUsers($db){
        $res    = NULL;
        if(!empty($_SESSION['admin'])){
            $res    = $db->fetchAllUser();
        }
        return $res;
    }

    public function getUserConfigData($db){
        $res    = NULL;
        $userData = NULL;
        if(!empty($_SESSION['admin'])){
            empty($_POST['user']['userToManage']) ? $username = $_SESSION['username'] : $username   = $_POST['user']['userToManage'];
            $userId     = $db->fetchUserId($username)['id'];
            $userData   = $db->fetchUserConfigData($userId);
            $res        = $userData;
        }
        elseif(!empty($_POST['user']['userAdjustment']) || !empty($_SESSION)){
            $username = $_SESSION['username'];
            $userId     = $db->fetchUserId($username)['id'];
            $userData   = $db->fetchUserConfigData($userId);
            $res        = $userData;
        }
        if(!empty($_POST['user']['user']) && $userData['user_interface'] === '1'){
            $res        = $this->getUserFavs($db);
        }
        return $res;
    }

    public function updateUserData($db){
        $adminState = NULL;
        if(!empty($_SESSION)){
            foreach($_POST as $updateKey => $updateValue){
                $userId     = $_POST['id'];
                if($updateKey === 'admin_state' && !empty($updateValue)){
                    $adminState = '1';
                    $checkAdmin = $db->fetchAdmin($userId)['admin_state'];
                    if($checkAdmin != '1' || empty($checkAdmin)){
                        $res        = $db->addAdmin($userId, $adminState);
                    }
                }
                elseif($updateKey === 'home' || $updateKey === 'user_interface'){
                    $sql        = 'UPDATE config SET '.$updateKey.' = :value WHERE user_id = :userId';
                    $res        = $db->updateUser($userId, $sql, 1);
                }
                elseif($updateKey === 'oldPassword'){
                    $verified   = $db->verifyPassword($userId, $updateValue);
                }
                elseif(!empty($_SESSION['admin']) && $updateKey === 'newPassword' || !empty($verified) && $updateKey === 'newPassword'){
                    if(strlen($updateValue) >= '8'){
                        $updateValue = password_hash($updateValue, PASSWORD_DEFAULT);
                        $sql         = 'UPDATE users SET password = :value WHERE id = :userId';
                        $res         = $db->updateUser($userId, $sql, $updateValue);
                    }
                }
                elseif(!empty($updateValue) && is_string($updateValue) && $updateKey != 'newPassword'){
                    $sql        = 'UPDATE users SET '.$updateKey.' = :value WHERE id = :userId';
                    $res        = $db->updateUser($userId, $sql, $updateValue);
                }
            }
            if(!key_exists('admin_state' , $_POST) && !empty($_POST['adminConfig'])){
                $res        = $db->deleteAdmin($userId);
            }
            elseif(!key_exists('home' , $_POST) && !key_exists('user_interface' , $_POST) && !empty($_POST['userConfig'])){
                $sql        = 'UPDATE config SET home = :value WHERE user_id = :userId';
                $db->updateUser($userId, $sql, '0');
                $sql        = 'UPDATE config SET user_interface = :value WHERE user_id = :userId';
                $db->updateUser($userId, $sql, '0');

            }
            elseif(!key_exists('home' , $_POST)  && !empty($_POST['userConfig']) || !key_exists('user_interface' , $_POST)  && !empty($_POST['userConfig'])){
                $sql        = 'UPDATE config SET home = :value WHERE user_id = :userId';
                if(!key_exists('user_interface' , $_POST)){
                    $sql        = 'UPDATE config SET user_interface = :value WHERE user_id = :userId';
                }
                $res        = $db->updateUser($userId, $sql, '0');

            }
        }
        header('Location:index.php');
        return $res;
    }

    public function deleteUser($db){
        if(!empty($_SESSION['admin'])){
            $userId = $_POST['id'];
            $userLinkIdArray = $db->fetchUserLinkId($userId);
            foreach($userLinkIdArray[0] as $userLinkIdKey => $userLinkId){
                $db->deleteLink($userLinkId);
                $db->deleteFromUserMenu($userLinkId);
            }
            die;
            $db->deleteUser($userId);

            header('Location:index.php');
        }
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
            $userId     = $db->fetchUserId($username)['id'];
            $db->addToConfig($userId);
            $res = 1;
        }
        return $res;
    }

    protected function loginUser($db){
        $username   = $_POST['username'];
        $password   = $_POST['password'];
        $res        = 0;
        $adminState = NULL;
        $login      = $db->loginUser($username, $password);
        if($login === '1'){
            $userId     = $db->fetchUserId($username);
            $userId     = $userId['id'];
            $adminState = $db->fetchAdminState($userId);
            !empty($adminState) ? $admin = $adminState['admin_state'] : $admin = NULL;
            $userArray  = array(
                'userId'    => $userId,
                'username'  => $username,
                'admin'     =>  $admin
            );
            $this->session->setSessionUserName($userArray);
            $res        = 1;
        }
        header('Location:index.php');
        return $res;
    }

    protected function addFavToUser($db){
        !empty($_SESSION['userId']) ? $userId   = $_SESSION['userId']  :    $userId    = NULL ;
        if(!empty($userId)){
            if(!empty($_POST['user']['addFav'])){
                $favTag	= $_POST['user']['addFav'];
                $this->updateHelper($favTag, $db, $userId, 'add');
            }
        }
        if(!empty($_POST['user'])){
            header('Location:index.php');
        }
    }

    protected function deleteFavToUser($db){
        !empty($_SESSION['userId']) ? $userId   = $_SESSION['userId']  :    $userId    = NULL ;
        if(!empty($userId)){
            if(!empty($_POST['user']['deleteFav'])){
                $favTag	= $_POST['user']['deleteFav'];
                $this->updateHelper($favTag, $db, $userId, 'remove');
            }
        }
        if(!empty($_POST['user'])){
            header('Location:index.php');
        }
    }

    protected function updateHelper($tag, $db, $userId, $adjustment){
        $res            = NULL;
        $tagId          = $db->getTagId($tag)['id'];
        if(!empty($tagId)) {
                if($adjustment === 'add'){
                    $db->addToFavorite($userId, $tagId);
                }
                else{
                    $db->deleteFromFav($tagId, $userId);
                }
        }
        return $res;
    }

    protected function getUserFavs($db){
        $res    = NULL;
        $userId = $_SESSION['userId'];
        if(!empty($db->fetchFavMenu($userId))){
            $favArray   = $db->fetchFavMenu($userId);
            $res        = $favArray;
        }
        return $res;
    }

    protected function getUserLinks($db){
        $res    = NULL;
        $userId = $_SESSION['userId'];
        if(!empty($db->fetchUserlinks($userId))){
            $linkArray  = $db->fetchUserlinks($userId);
            $res        = $linkArray;
        }
        return $res;
    }

    protected function fetchIcons($db){
        $res    = NULL;
        if(!empty($db->fetchIcons())){
            $iconArray = $db->fetchIcons();
            $res        = $iconArray;
        }
        return $res;
    }

    public function saveUserLink($db){
        $res = NULL;
        if(!empty($_SESSION)){
            $name = $_POST['name'];
            $link = $_POST['link'];
            $comment = $_POST['comment'];
            $iconId = $_POST['iconId'];
            !empty($_POST['private']) ? $private = $_POST['private'] : $private = 0;
            $res = $db->addUserLinkToMenu($name, $link, $comment, $iconId, $private);
            header('Location:index.php');
        }
    }

    public function saveAdjustedData($db){
        if(!empty($_SESSION['userId'])){
            if(!empty($_POST)){
                $id = $_POST['id'];
                $name = $_POST['name'];
                $link = $_POST['link'];
                $comment = $_POST['comment'];
                $icon = $_POST['iconId'];
                $private = $_POST['private'];
                $private === 'on' ? $private = 1 : $private = 0;
            }
            $updateArray = [
                'id' => $id,
                'name' => $name,
                'link' => $link,
                'comment' => $comment,
                'icon_id' => $icon,
                'private' => $private
            ];
            $this->updateLinkHelper($db, $updateArray);
        }
        header('Location:index.php');
    }

    public function deleteLink($db){
        if(!empty($_SESSION['userId'])){
            $id = $_POST['id'];
            $db->deleteLink($id);
            $db->deleteFromFav($id);
            $db->deleteFromUserMenu($id);
        }
        header('Location:index.php');
    }

    public function updateLinkHelper($db, $updateArray){
        $id = $updateArray['id'];
        foreach($updateArray as $updateKey => $updateValue){
            if(empty($updateValue) || $updateValue === '0' || $updateKey === 'id'){
                continue;
            }
            $sql = 'UPDATE menu SET '.$updateKey.' = :newData WHERE id = :id';
            if($updateKey === 'private'){
                $sql = 'UPDATE user_menu SET '.$updateKey.' = :newData WHERE menu_id = :id';
            }
            $db->updateLink($sql, $id, $updateValue);
        }
    }

    protected function logoutUser(){
        session_destroy();
        header('Location:index.php');
    }
}