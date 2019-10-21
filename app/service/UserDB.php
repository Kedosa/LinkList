<?php
namespace app\service;

class UserDB
{
    public  $cfg;
    public  $pdo;
    public  $stmnts;

    public function __construct($cfg)
    {
        $this->cfg      = $cfg;
        $this->stmnts   = array();
    }

    protected function getPdo()
    {
        try {
            $this->pdo = new \PDO('mysql:host='.$this->cfg['host'].';dbname='.$this->cfg['dbname'].';charset='.$this->cfg['charset'], $this->cfg['user'], $this->cfg['pw']);
        }
        catch (PDOException $error){
            print "Error!: " . $error->getMessage() . "<br/>";
            die();
        }
        return $this->pdo;
    }

    public function fetchMenu($searched = ''){
        $res = NULL;
        $searched = strtolower($searched);
        $searched = '%'.$searched.'%';
        $sql = 'SELECT m.id, m.name AS linkName, c.name, c.subcategory, c.type, m.link, m.comment, i.icon FROM menu AS m
                LEFT JOIN category AS c
                ON m.category_id = c.id
                LEFT JOIN icon AS i
                ON m.icon_id = i.id
                ORDER BY type, m.id;';
        if(!empty($_SESSION) && !empty($searched)){
            $sql = 'SELECT m.id, m.name AS linkName, c.name, c.subcategory, c.type, m.link, m.comment, i.icon, tag_id AS favorite FROM favorite as f 
                    RIGHT JOIN menu as m ON f.tag_id = m.id AND f.user_id = :userId 
                    LEFT JOIN category AS c ON m.category_id = c.id 
                    LEFT JOIN icon AS i ON m.icon_id = i.id 
                    WHERE LOWER(m.name) LIKE :searched OR LOWER(c.type) LIKE :searched
                    GROUP BY m.id 
                    ORDER BY type, m.id;';
        }
        elseif(!empty($_SESSION)){
            $sql = 'SELECT m.id, m.name AS linkName, c.name, c.subcategory, c.type, m.link, m.comment, i.icon, tag_id AS favorite FROM favorite as f 
                    RIGHT JOIN menu as m ON f.tag_id = m.id AND f.user_id = :userId 
                    LEFT JOIN category AS c ON m.category_id = c.id 
                    LEFT JOIN icon AS i ON m.icon_id = i.id 
                    GROUP BY m.id 
                    ORDER BY type, m.id;';
        }
        elseif(!empty($searched)){
            $sql = 'SELECT m.id, m.name AS linkName, c.name, c.subcategory, c.type, m.link, m.comment, i.icon FROM menu AS m
                LEFT JOIN category AS c 
                ON m.category_id = c.id
                LEFT JOIN icon AS i
                ON m.icon_id = i.id
                WHERE LOWER(m.name) LIKE :searched OR LOWER(c.type) LIKE :searched
                ORDER BY type, m.id;';
        }
        $hash       = md5($sql);
        if(!isset($this->stmnts[$hash])){
            $this->stmnts[$hash] = $this->getPdo()->prepare($sql);
        }
        $statement  = $this->stmnts[$hash];
        if(!empty($searched) && !empty($_SESSION)){
            if($statement->execute(array(':searched' => $searched, ':userId' => $_SESSION['userId']))){
                $res    = $statement->fetchAll(\PDO::FETCH_ASSOC);
            }
        }
        elseif(!empty($searched)){
            if($statement->execute(array(':searched' => $searched))){
                $res    = $statement->fetchAll(\PDO::FETCH_ASSOC);
            }
        }
        elseif(!empty($_SESSION)){
            if($statement->execute(array(':userId' => $_SESSION['userId']))){
                $res    = $statement->fetchAll(\PDO::FETCH_ASSOC);
            }
        }
        else{
            if($statement->execute()){
                $res    = $statement->fetchAll(\PDO::FETCH_ASSOC);
            }
        }
        return $res;
    }

    public function fetchFavMenu($userId){
        $res = NULL;
        $sql = 'SELECT m.id, m.name AS linkName, c.name, c.subcategory, c.type, m.link, m.comment, i.icon, tag_id AS favorite FROM favorite AS f 
                INNER JOIN users AS u ON f.user_id = u.id AND f.user_id = :userId 
                INNER JOIN menu AS m ON f.tag_id = m.id 
                INNER JOIN category AS c ON c.id = m.category_id 
                LEFT JOIN icon AS i ON i.id = m.icon_id GROUP BY m.id 
                ORDER BY type, m.id;';
        $hash = md5($sql);
        if(!isset($this->stmnts[$hash])){
            $this->stmnts[$hash] = $this->getPdo()->prepare($sql);
        }
        $statement  = $this->stmnts[$hash];
        if($statement->execute(array(':userId' => $userId))){
            $res    = $statement->fetchAll(\PDO::FETCH_ASSOC);
        }
        return $res;
    }

    public function fetchMenuData($menuId){
        $res = NULL;
        $sql = 'SELECT m.id, m.name AS linkName, c.name, c.subcategory, c.type, m.link, m.comment, i.icon FROM menu AS m 
                INNER JOIN category AS c ON m.category_id = c.id 
                LEFT JOIN icon AS i ON m.icon_id = i.id 
                WHERE m.id = :menuId
                ORDER BY type;';
        $hash       = md5($sql);
        if(!isset($this->stmnts[$hash])){
            $this->stmnts[$hash] = $this->getPdo()->prepare($sql);
        }
        $statement  = $this->stmnts[$hash];
        if($statement->execute(array(':menuId' => $menuId))){
            $res    = $statement->fetch(\PDO::FETCH_ASSOC);
        }
        return $res;

    }

    public function fetchNav(){
        $res = NULL;
        $sql = 'SELECT name, subcategory, type FROM category ORDER BY name, subcategory;';
        $hash       = md5($sql);
        if(!isset($this->stmnts[$hash])){
            $this->stmnts[$hash] = $this->getPdo()->prepare($sql);
        }
        $statement  = $this->stmnts[$hash];
        if($statement->execute()){
            $res    = $statement->fetchAll(\PDO::FETCH_ASSOC);
        }
        return $res;
    }

    public function fetchIcons(){
        $res = NULL;
        $sql = 'SELECT * FROM icon ORDER BY name;';
        $hash       = md5($sql);
        if(!isset($this->stmnts[$hash])){
            $this->stmnts[$hash] = $this->getPdo()->prepare($sql);
        }
        $statement  = $this->stmnts[$hash];
        if($statement->execute()){
            $res    = $statement->fetchAll(\PDO::FETCH_ASSOC);
        }
        return $res;
    }

    public function fetchCategories(){
        $res = NULL;
        $sql = 'SELECT id, subcategory AS name FROM category ORDER BY subcategory;';
        $hash = md5($sql);
        if(!isset($this->stmnts[$hash])){
            $this->stmnts[$hash] = $this->getPdo()->prepare($sql);
        }
        $statement  = $this->stmnts[$hash];
        if($statement->execute()){
            $res    = $statement->fetchAll(\PDO::FETCH_ASSOC);
        }
        return $res;
    }

    public function fetchDropName(){
        $res = NULL;
        $sql = 'SELECT DISTINCT(name) FROM category ORDER BY name;';
        $hash       = md5($sql);
        if(!isset($this->stmnts[$hash])){
            $this->stmnts[$hash] = $this->getPdo()->prepare($sql);
        }
        $statement  = $this->stmnts[$hash];
        if($statement->execute()){
            $res    = $statement->fetchAll(\PDO::FETCH_ASSOC);
        }
        return $res;
    }

    public function updateLink($sql, $id, $value){
        $hash       = md5($sql);
        if(!isset($this->stmnts[$hash])){
            $this->stmnts[$hash] = $this->getPdo()->prepare($sql);
        }
        $statement  = $this->stmnts[$hash];
        $statement->execute(array(':id' => $id, ':newData' => $value));
    }

    public function deleteLink($id){
        $sql        = 'DELETE FROM menu 
                        WHERE id = :id;';
        $hash       = md5($sql);
        if(!isset($this->stmnts[$hash])){
            $this->stmnts[$hash] = $this->getPdo()->prepare($sql);
        }
        $statement  = $this->stmnts[$hash];
        $statement->execute(array(':id' => $id));
    }


    public function registerUser($name, $firstName, $username, $email, $password)
    {
        $sql        = 'INSERT INTO users (name, firstname, username, email, password)
                        VALUES(:name, :firstname, :username, :email, :password);';
        $hash       = md5($sql);
        if(!isset($this->stmnts[$hash])){
            $this->stmnts[$hash] = $this->getPdo()->prepare($sql);
        }

        $statement  = $this->stmnts[$hash];
        $statement->execute(array(':name' => $name, ':firstname' => $firstName, ':username' => $username, ':email' => $email, ':password' => $password));
    }

    public function updateUser($userId, $sql, $value = ''){
        $hash       = md5($sql);
        if(!isset($this->stmnts[$hash])){
            $this->stmnts[$hash] = $this->getPdo()->prepare($sql);
        }

        $statement  = $this->stmnts[$hash];
        if(!empty($value)){
            $statement->execute(array(':userId' => $userId, ':value' => $value));
        }
        elseif($value === '0'){
            $statement->execute(array(':userId' => $userId, ':value' => 0));

        }
        else{
            $statement->execute(array(':userId' => $userId));
        }
    }

    public function loginUser($name, $password)
    {
        $sql        = "SELECT username, password FROM users WHERE username = :name LIMIT 1";
        $hash       = md5($sql);
        if(!isset($this->stmnts[$hash]))
        {
            $this->stmnts[$hash] = $this->getPdo()->prepare($sql);
        }
        $res        = null;

        $statement  = $this->stmnts[$hash];
        if($statement->execute(array(':name' => $name)))
        {
            $user   = $statement->fetch(\PDO::FETCH_ASSOC);

            $key    = $user['password'];
            $username = $user['username'];
        }
        if (!strcasecmp($name, $username))
        {
            if(password_verify($password, $key))
            {
                $res = "1";
            }
        }
        return $res;
    }

    public function verifyPassword($id, $password){
        $sql        = "SELECT password FROM users WHERE id = :id";
        $hash       = md5($sql);
        if(!isset($this->stmnts[$hash]))
        {
            $this->stmnts[$hash] = $this->getPdo()->prepare($sql);
        }
        $res        = null;

        $statement  = $this->stmnts[$hash];
        if($statement->execute(array(':id' => $id)))
        {
            $user   = $statement->fetch(\PDO::FETCH_ASSOC);

            $key    = $user['password'];
        }

        if(password_verify($password, $key))
        {
            $res = "1";
        }
        return $res;

    }

    public function fetchUsername($username)
    {
        $sql        = 'SELECT username FROM users WHERE username = :username';
        $hash       = md5($sql);
        if(!isset($this->stmnts[$hash])){
            $this->stmnts[$hash] = $this->getPdo()->prepare($sql);
        }

        $statement  = $this->stmnts[$hash];
        if($statement->execute(array(':username' => $username))){
            $res    = $statement->fetch(\PDO::FETCH_ASSOC);
        }
        return $res;
    }

    public function fetchUserId($user)
    {
        $sql        = 'SELECT id FROM users WHERE username = :user;';
        $hash       = md5($sql);
        if(!isset($this->stmnts[$hash]))
        {
            $this->stmnts[$hash] = $this->getPdo()->prepare($sql);
        }
        $res        = null;
        $statement  = $this->stmnts[$hash];
        if($statement->execute(array(':user' => "$user")))
        {
            $res    = $statement->fetch(\PDO::FETCH_ASSOC);
        }
        return $res;
    }

    public function fetchAdminState($userId){
        $sql        = 'SELECT admin_state FROM admin
                        WHERE user_id = :userId;';
        $hash       = md5($sql);
        if(!isset($this->stmnts[$hash])){
            $this->stmnts[$hash] = $this->getPdo()->prepare($sql);
        }
        $res        = NULL;
        $statement  = $this->stmnts[$hash];
        if($statement->execute(array(':userId' => $userId))){
            $res    = $statement->fetch(\PDO::FETCH_ASSOC);
        }
        return $res;
    }

    public function searchForLink($name, $category){
        $res        = NULL;
        $sql        = 'SELECT * FROM menu
                        WHERE name = :name AND category = :category;';
        $hash       = md5($sql);
        if(!isset($this->stmnts[$hash])){
            $this->stmnts[$hash] = $this->getPdo()->prepare($sql);
        }
        $statement  = $this->stmnts[$hash];
        if($statement->execute(array(':name' => $name, ':category' => $category)))
        {
            $res    = $statement->fetch(\PDO::FETCH_ASSOC);
        }
        return $res;
    }

    public function getTagId($name){
        $res        = NULL;
        $sql        = 'SELECT id FROM menu 
                        WHERE name = :name;';
        $hash       = md5($sql);
        if(!isset($this->stmnts[$hash])){
            $this->stmnts[$hash] = $this->getPdo()->prepare($sql);
        }
        $statement  = $this->stmnts[$hash];
        if($statement->execute(array(':name' => $name)))
        {
            $res    = $statement->fetch(\PDO::FETCH_ASSOC);
        }
        return $res;
    }

    public function getLinkNames(){
        $res        = NULL;
        $sql        = 'SELECT name, category FROM menu;';
        $hash       = md5($sql);
        if(!isset($this->stmnts[$hash])){
            $this->stmnts[$hash] = $this->getPdo()->prepare($sql);
        }
        $statement  = $this->stmnts[$hash];
        if($statement->execute()){
            $res    = $statement->fetchAll(\PDO::FETCH_ASSOC);
        }
        return $res;
    }

    public function addToMenu($name, $categoryId, $link, $comment, $iconId){
        $res        = NULL;
        $sql        = 'INSERT INTO menu (name, category_id, link, comment, icon_id)
                        VALUES(:name, :categoryId, :link, :comment, :iconId)';
        $hash       = md5($sql);
        if(!isset($this->stmnts[$hash])){
            $this->stmnts[$hash] = $this->getPdo()->prepare($sql);
        }
        $statement  = $this->stmnts[$hash];
        $statement->execute(array(':name' => $name, ':categoryId' => $categoryId, ':link' => $link, ':comment' => $comment, ':iconId' => $iconId));
        $res        = 1;
        return $res;
    }

    public function addToConfig($id){
        $res        = NULL;
        $default    = "0";
        $sql        = 'INSERT INTO config (user_id, home, user_interface)
                        VALUES(:user_id, :home, :userInterface)';
        $hash       = md5($sql);
        if(!isset($this->stmnts[$hash])){
            $this->stmnts[$hash] = $this->getPdo()->prepare($sql);
        }
        $statement  = $this->stmnts[$hash];
        $statement->execute(array(':user_id' => $id, ':home' => $default, ':userInterface' => $default));
        $res        = 1;
        return $res;
    }


    public function addToFavorite($userId, $tagId){
        $res = NULL;
        $sql        = 'INSERT INTO favorite (user_id, tag_id)
                        VALUES(:user_id, :tag_id)';
        $hash       = md5($sql);
        if(!isset($this->stmnts[$hash])){
            $this->stmnts[$hash] = $this->getPdo()->prepare($sql);
        }
        $statement  = $this->stmnts[$hash];
        $statement->execute(array(':user_id' => $userId, ':tag_id' => $tagId));
        $res = 1;
        return $res;
    }

    public function deleteAdmin($userId){
        $res        = NULL;
        $sql        = 'DELETE FROM admin 
                        WHERE user_id = :user_id';
        $hash       = md5($sql);
        if(!isset($this->stmnts[$hash])){
            $this->stmnts[$hash] = $this->getPdo()->prepare($sql);
        }
        $statement  = $this->stmnts[$hash];
        $statement->execute(array(':user_id' => $userId));
        $res        = 1;
        return $res;
    }

    public function addAdmin($userId, $admin){
        $res        = NULL;
        $sql        = 'INSERT INTO admin (user_id, admin_state)
                        VALUES (:user_id, :admin)';
        $hash       = md5($sql);
        if(!isset($this->stmnts[$hash])){
            $this->stmnts[$hash] = $this->getPdo()->prepare($sql);
        }
        $statement  = $this->stmnts[$hash];
        $statement->execute(array(':user_id' => $userId, ':admin' => $admin));
        $res        = 1;
        return $res;

    }

    public function getUserFavTags($userId){
        $res        = NULL;
        $sql        = 'SELECT m.name FROM favorite 
                        INNER JOIN menu AS m 
                        on m.id = tag_id 
                        WHERE user_id = :userId ';
        $hash       = md5($sql);
        if(!isset($this->stmnts[$hash])){
            $this->stmnts[$hash] = $this->getPdo()->prepare($sql);
        }
        $statement  = $this->stmnts[$hash];
        if($statement->execute(array(':userId' => $userId))){
            $res    = $statement->fetchAll(\PDO::FETCH_ASSOC);
        }
        return $res;
    }

//    public function deleteFromLink($name, $category){
//        $res        = NULL;
//        $sql        = 'DELETE FROM menu
//                        WHERE name = :name AND category = :category';
//        $hash       = md5($sql);
//        if(!isset($this->stmnts[$hash])){
//            $this->stmnts[$hash] = $this->getPdo()->prepare($sql);
//        }
//        $statement  = $this->stmnts[$hash];
//        $statement->execute(array(':name' => $name, ':category' => $category));
//        $res        = 1;
//        return $res;
//    }

    public function deleteFromFav($tagId, $userId = ''){
        $res = NULL;
        $sql = 'DELETE FROM favorite 
                  WHERE tag_id = :tagId';
        if(!empty($userId)){
            $sql = 'DELETE FROM favorite 
                  WHERE user_id = :userId AND tag_id = :tagId';
        }
        $hash = md5($sql);
        if(!isset($this->stmnts[$hash])){
            $this->stmnts[$hash] = $this->getPdo()->prepare($sql);
        }
        $statement = $this->stmnts[$hash];
        if(empty($userId)){
            $statement->execute(array(':tagId' => $tagId));
        }
        elseif(!empty($userId)){
            $statement->execute(array(':tagId' => $tagId, ':userId' => $userId));
        }
        $res = 1;
        return $res;
    }

    public function deleteUser($userId){
        $res        = NULL;
        $sql        = 'DELETE FROM users 
                        WHERE id = :userId';
        $hash       = md5($sql);
        if(!isset($this->stmnts[$hash])){
            $this->stmnts[$hash] = $this->getPdo()->prepare($sql);
        }
        $statement  = $this->stmnts[$hash];
        $statement->execute(array(':userId' => $userId));
        $res        = 1;
        return $res;
    }

    public function fetchAllUser(){
        $res        = NULL;
        $sql        = 'SELECT u.id, u.username, admin_state 
                        FROM users AS u 
                        LEFT JOIN admin AS a ON u.id = a.user_id ';
        $hash       = md5($sql);
        if(!isset($this->stmnts[$hash])){
            $this->stmnts[$hash] = $this->getPdo()->prepare($sql);
        }
        $statement  = $this->stmnts[$hash];
        if($statement->execute()){
            $res    = $statement->fetchAll(\PDO::FETCH_ASSOC);
        }
        return $res;
    }

    public function fetchAdmin($userId){
        $res        = NULL;
        $sql        = 'SELECT admin_state FROM admin WHERE user_id = :userId ';
        $hash       = md5($sql);
        if(!isset($this->stmnts[$hash])){
            $this->stmnts[$hash] = $this->getPdo()->prepare($sql);
        }
        $statement  = $this->stmnts[$hash];
        if($statement->execute(array(':userId' => $userId))){
            $res    = $statement->fetch(\PDO::FETCH_ASSOC);
        }
        return $res;
    }

    public function fetchUserConfigData($userId){
        $res        = NULL;
        $sql        = 'SELECT u.id, u.firstname, u.name, u.username, u.email, c.home, c.user_interface, admin_state FROM users AS u 
                        LEFT JOIN admin AS a ON u.id = a.user_id 
                        LEFT JOIN config AS c ON u.id = c.user_id
                        WHERE u.id = :userId;';
        $hash       = md5($sql);
        if(!isset($this->stmnts[$hash])){
            $this->stmnts[$hash] = $this->getPdo()->prepare($sql);
        }
        $statement  = $this->stmnts[$hash];
        if($statement->execute(array(':userId' => $userId))){
            $res    = $statement->fetch(\PDO::FETCH_ASSOC);
        }
        return $res;
    }

    public function fetchCategoryId($name){
        $res        = NULL;
        $sql        = 'SELECT id FROM category WHERE type = :name ;';
        $hash       = md5($sql);
        if(!isset($this->stmnts[$hash])){
            $this->stmnts[$hash] = $this->getPdo()->prepare($sql);
        }
        $statement  = $this->stmnts[$hash];
        if($statement->execute(array(':name' => $name))){
            $res    = $statement->fetch(\PDO::FETCH_ASSOC);
        }
        return $res;
    }

    public function fetchIconId($name){
        $res        = NULL;
        $sql        = 'SELECT id FROM icon WHERE icon = :name ;';
        $hash       = md5($sql);
        if(!isset($this->stmnts[$hash])){
            $this->stmnts[$hash] = $this->getPdo()->prepare($sql);
        }
        $statement  = $this->stmnts[$hash];
        if($statement->execute(array(':name' => $name))){
            $res    = $statement->fetch(\PDO::FETCH_ASSOC);
        }
        return $res;
    }

    public function fetchCount(){
        $sql = 'SELECT COUNT(id) FROM menu';
        $hash       = md5($sql);
        if(!isset($this->stmnts[$hash])){
            $this->stmnts[$hash] = $this->getPdo()->prepare($sql);
        }
        $statement  = $this->stmnts[$hash];
        if($statement->execute()){
            $res    = $statement->fetch(\PDO::FETCH_ASSOC);
        }
        return $res;
    }
}