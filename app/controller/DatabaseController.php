<?php

namespace app\controller;

class DatabaseController extends BaseController{

    public function getMenuArray(){
        $db         = $this->dbConnection();
        !empty($_GET['searchValue']) ? $menuArray  = $db->fetchMenu($_GET['searchValue']) : $menuArray  = $db->fetchMenu();
        $navArray   = $db->fetchNav();
        $dropArray  = $db->fetchDropName();
        $resArray   = [
            'menu'      => $menuArray,
            'nav'       => $navArray,
            'dropdown'  => $dropArray
        ];
        return $resArray;
    }

    public function getMenuAction($action){
        $res = NULL;
        if(!empty($_SESSION['admin'])){
            switch ($action){
                case 'dataConfig':
                    $data = $this->getAdjustData();
                    break;
                case 'saveManage':
                    $data = $this->saveAdjustedData();
                    break;
                case 'saveLink':
                    $data = $this->saveNewLink();
                    break;
                case 'add':
                    $data = $this->getNecessaryLinkData();
                    break;
                case 'deleteData':
                    $data = $this->deleteLink();
                    break;
                case 'abortManage':
                    header('Location:index.php');
                    break;
                default:
                    $data = $this->getDefaultArray();
                    break;
            }
        }
        $res = $data;
        return $res;
    }

    public function getDefaultArray()
    {
        $db = $this->dbConnection();
        $menuArray = $db->fetchMenu();
        return $menuArray;
    }

    public function getAdjustData(){
        $db = $this->dbConnection();
        $menuId = $_POST['table']['dataConfig'];
        $menuData = $db->fetchMenuData($menuId);
        $iconData = $db->fetchIcons();
        $categoryData = $db->fetchCategories();

        $res = [
            'menuData' => $menuData,
            'icon' => $iconData,
            'category' => $categoryData
        ];
        return $res;
    }

    public function saveAdjustedData(){
        if(!empty($_SESSION['admin'])){
            if(!empty($_POST)){
                $id = $_POST['id'];
                $name = $_POST['name'];
                $link = $_POST['link'];
                $comment = $_POST['comment'];
                $icon = $_POST['iconId'];
                $category = $_POST['categoryId'];
            }
            $updateArray = [
                'id' => $id,
                'name' => $name,
                'link' => $link,
                'comment' => $comment,
                'icon_id' => $icon,
                'category_id' => $category
            ];
            $this->updateHelper($updateArray);
        }
        header('Location:index.php');
    }

    public function saveNewLink(){
        if(!empty($_SESSION['admin'])){
            $db = $this->dbConnection();
            if(!empty($_POST['name']) && !empty($_POST['link']) && $_POST['categoryId']){
                $name = $_POST['name'];
                $link = $_POST['link'];
                !empty($_POST['comment']) ? $comment = $_POST['comment'] : $comment = '';
                !empty($_POST['iconId'])  ? $icon = $_POST['iconId'] : $icon = '';
                $category = $_POST['categoryId'];
                $db->addToMenu($name, $category, $link, $comment, $icon, 1);
            }

        }
        header('Location:index.php');
    }

    public function getNecessaryLinkData(){
        $db = $this->dbConnection();
        $iconData = $db->fetchIcons();
        $categoryData = $db->fetchCategories();
        $res = [
            'icon' => $iconData,
            'category' => $categoryData
        ];
        return $res;
    }

    public function deleteLink(){
        if(!empty($_SESSION['admin'])){
            $db = $this->dbConnection();
            $id = $_POST['id'];
            $db->deleteLink($id);
            $db->deleteFromFav($id);
            $db->deleteFromUserMenu($id);
        }
        header('Location:index.php');
    }


    public function updateHelper($updateArray){
        $db = $this->dbConnection();
        $id = $updateArray['id'];
        foreach($updateArray as $updateKey => $updateValue){
            if(empty($updateValue) || $updateValue === '0' || $updateKey === 'id'){
                continue;
            }
            $sql = 'UPDATE menu SET '.$updateKey.' = :newData WHERE id = :id';
            $db->updateLink($sql, $id, $updateValue);
        }
    }
}