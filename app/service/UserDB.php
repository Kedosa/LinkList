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
//        if(!$this->pdo){
//            $this->pdo = new \PDO('mysql:host='.$this->cfg['host'].';dbname='.$this->cfg['dbname'].';charset='.$this->cfg['charset'], $this->cfg['user'], $this->cfg['pw']);
//        }
        try {
            $this->pdo = new \PDO('mysql:host='.$this->cfg['host'].';dbname='.$this->cfg['dbname'].';charset='.$this->cfg['charset'], $this->cfg['user'], $this->cfg['pw']);
        }
        catch (PDOException $error){
            print "Error!: " . $error->getMessage() . "<br/>";
            die();
        }
        return $this->pdo;
    }

    public function registerUser($name, $firstName, $username, $email, $password)
    {
        $sql        = 'INSERT INTO persons (name, vorname, username, email, password)
                        VALUES(:name, :firstname, :username, :email, :password);';
        $hash       = md5($sql);
        if(!isset($this->stmnts[$hash])){
            $this->stmnts[$hash] = $this->getPdo()->prepare($sql);
        }

        $statement  = $this->stmnts[$hash];
        $statement->execute(array(':name' => $name, ':firstname' => $firstName, ':username' => $username, ':email' => $email, ':password' => $password));
    }

    public function loginUser($name, $password)
    {
        $sql        = "SELECT username, password FROM persons WHERE username = :name LIMIT 1";
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
        $res = "0";
        if (!strcasecmp($name, $username))
        {
            if(password_verify($password, $key))
            {
                $res = "1";
            }
        }
        return $res;
    }

    public function fetchUsername($username)
    {
        $sql        = 'SELECT username FROM persons WHERE username = :username';
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
        $sql        = 'SELECT id FROM persons WHERE username = :user;';
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

    public function searchForLink($name, $category){
        $res        = NULL;
        $sql        = 'SELECT * FROM tag 
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
        $sql        = 'SELECT id FROM tag 
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
        $sql        = 'SELECT name, category FROM tag;';
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

    public function addToLink($name, $category){
        $res        = NULL;
        $sql        = 'INSERT INTO tag (name, category)
                        VALUES(:name, :category)';
        $hash       = md5($sql);
        if(!isset($this->stmnts[$hash])){
            $this->stmnts[$hash] = $this->getPdo()->prepare($sql);
        }
        $statement  = $this->stmnts[$hash];
        $statement->execute(array(':name' => $name, ':category' => $category));
        $res        = 1;
        return $res;
    }

    public function addToFavorite($userId, $tagId){
        $res        = NULL;
        $sql        = 'INSERT INTO favorite (user_id, tag_id)
                        VALUES(:user_id, :tag_id)';
        $hash       = md5($sql);
        if(!isset($this->stmnts[$hash])){
            $this->stmnts[$hash] = $this->getPdo()->prepare($sql);
        }
        $statement  = $this->stmnts[$hash];
        $statement->execute(array(':user_id' => $userId, ':tag_id' => $tagId));
        $res        = 1;
        return $res;
    }

    public function getUserFavTags($userId){
        $res        = NULL;
        $sql        = 'SELECT t.name FROM favorite 
                        INNER JOIN tag AS t 
                        on t.id = tag_id 
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

    public function deleteFromLink($name, $category){
        $res        = NULL;
        $sql        = 'DELETE FROM tag 
                        WHERE name = :name AND category = :category';
        $hash       = md5($sql);
        if(!isset($this->stmnts[$hash])){
            $this->stmnts[$hash] = $this->getPdo()->prepare($sql);
        }
        $statement  = $this->stmnts[$hash];
        $statement->execute(array(':name' => $name, ':category' => $category));
        $res        = 1;
        return $res;
    }

    public function deleteFromFav($userId, $tagId){
        $res        = NULL;
        $sql        = 'DELETE FROM favorite 
                        WHERE user_id = :userId AND tag_id = :tagId';
        $hash       = md5($sql);
        if(!isset($this->stmnts[$hash])){
            $this->stmnts[$hash] = $this->getPdo()->prepare($sql);
        }
        $statement  = $this->stmnts[$hash];
        $statement->execute(array(':userId' => $userId, ':tagId' => $tagId));
        $res        = 1;
        return $res;
    }
}