<?php


namespace app\element;

class ElementLink extends BaseElement
{
    public function getValues(){
        $content    = $this->tplHelper->searchTemplate('tbody');
        if($this->tag === 'nav'){
            $content = $this->tplHelper->searchTemplate('dropdown');
        }
        elseif($this->tag === 'tableAdjust'){
            $content = $this->tplHelper->searchTemplate('tbodyDbConfig');
        }
        elseif($this->tag === 'option'){
            $content = $this->tplHelper->searchTemplate('option');
        }
        elseif($this->tag === 'linkAdjust'){
            $content = $this->tplHelper->searchTemplate('menuConfigForm');
        }
//        elseif($this->tag === 'linkAdd'){
//            $content = $this->tplHelper->searchTemplate('newLink');
//        }
        $content    =  $this->replaceContentLink($content, $this->data, $this->tag, $this->template);
        $res        = $content;
        return $res;
    }

    protected function replaceContentLink($file, $infoArray, $tag, $template = NULL){
        $res = NULL;
        if(is_array($infoArray)){
            foreach($infoArray as $infoKey => $infoData) {
                $token  = '####' . $infoKey . '####';
                if($infoKey === 'favorite'){
                    !empty($infoData) ? $infoData = 'addFavorite' : $infoData = '';
                }
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
            }
        }
        else{
            $token = '####name####';
            $infoData = $infoArray;
            $template = str_replace($token, $infoData, $file);
        }

        if($tag === 'table' || $tag === 'tableAdjust'){
            !empty($_SESSION['admin']) ? $file = str_replace('####jsFunction####', 'favorite(this)', $file) : $file = str_replace('####jsFunction####', 'plsLogin()', $file);
            $findToken = strpos($file, '####linkName');
            if($findToken !== FALSE){
                $res = $template;
            }
            else{
                $res = $template.$file;
            }
        }
        elseif($tag === 'nav'){
            $findToken = strpos($file, '####name');
            if($findToken !== FALSE){
                $res = $template;
            }
            else{
                $res = $template.$file;
            }
        }
        elseif($tag === 'searched'){
            $res = $template.$file;
        }
        elseif($tag === 'option'){
            $res = $template.$file;
        }
        elseif($tag === 'linkAdjust'){
            $res = $file;
        }
        return $res;
    }
}