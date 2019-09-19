<?php


namespace app\element;
use app\controller\UserController;

class ElementLink extends BaseElement
{
    public function getValues(){
        $content = $this->tplHelper->searchTemplate('tbody');
        if($this->tag === 'nav'){
            $content = $this->tplHelper->searchTemplate('link');
        }
        $content =  $this->replaceContentLink($content, $this->data, $this->tag, $this->template);
        $res = $content;
        return $res;
    }

    protected function replaceContentLink($file, $infoArray, $tag, $template = NULL){
        $uController    = new UserController();
        $res            = NULL;
        if(is_array($infoArray)){
            foreach($infoArray as $infoKey => $infoData) {
                $token = '####' . $infoKey . '####';
                if (empty($template) && strcmp($token, $file)) {
                    empty($infoData) ? $infoData = 'Kein Kommentar' : $infoData;
                    $file = str_replace($token, $infoData, $file);
                }
                elseif(strcmp($token, $template) && $tag === 'nav'){
                    $template = str_replace($token, $infoData, $template);
                }
                elseif (strcmp($token, $template)) {
                    empty($infoData) ? $infoData = 'Kein Kommentar' : $infoData;
                    $template = str_replace($token, $infoData, $template);
                    $file = str_replace($token, $infoData, $file);
                }
//                if($infoKey === 'name' && !empty($_SESSION['userId'])){
//                    $favArray   = $uController->getUserFavs();
//                }
            }
        }
        else{
            $token = '####category####';
            $infoData = $infoArray;
            $template = str_replace($token, $infoData, $template);
        }
        if($tag === 'table' ){
            $findToken = strpos($file, '####name');
            if($findToken !== FALSE){
                $res = $template;
            }
            else{
                $res = $template.$file;
            }
        }
        if($tag === 'nav'){
            $res = $template;
        }
        if($tag === 'searched'){
            $res = $template.$file;
        }
        return $res;
    }
}