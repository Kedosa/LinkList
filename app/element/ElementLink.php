<?php


namespace app\element;

class ElementLink extends BaseElement
{
    /**
     * @return mixed|string|null
     */
    public function getValues(){
        $content    = $this->tplHelper->searchTemplate('tbody');
        if($this->tag === 'nav'){
            $content = $this->tplHelper->searchTemplate('dropdown');
        }
        elseif($this->tag === 'tableAdjust'){
            $content = $this->tplHelper->searchTemplate('tbodyDbConfig');
        }
        elseif($this->tag === 'userMenuTable'){
            $content = $this->tplHelper->searchTemplate('userTbLink');
        }
        elseif($this->tag === 'option'){
            $content = $this->tplHelper->searchTemplate('option');
        }
        elseif($this->tag === 'linkAdjust'){
            $content = $this->tplHelper->searchTemplate('menuConfigForm');
        }
        elseif($this->tag === 'userLinkAdjust'){
            $content = $this->tplHelper->searchTemplate('userLinkConfig');
        }
        $content    =  $this->replaceContentLink($content, $this->data, $this->tag, $this->template);
        $res        = $content;
        return $res;
    }

    /**
     * @param $file
     * @param $infoArray
     * @param $tag
     * @param null $template
     * @return mixed|string|null
     */
    protected function replaceContentLink($file, $infoArray, $tag, $template = NULL){
        $res = NULL;
        if(is_array($infoArray)){
            foreach($infoArray as $infoKey => $infoData) {

                $token  = '####' . $infoKey . '####';
                if($infoKey === 'favorite'){
                    !empty($infoData) ? $infoData = 'addFavorite' : $infoData = '';
                }
                elseif($infoKey === 'private'){
                    $infoData === '1' ? $infoData = 'checked' : $infoData = '';
                }
                if (strcmp($token, $template)) {
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

        if($tag === 'table' || $tag === 'tableAdjust' || $tag === 'userMenuTable'){
            !empty($_SESSION['userId']) ? $file = str_replace('####jsFunction####', 'favorite(this)', $file) : $file = str_replace('####jsFunction####', 'plsLogin()', $file);
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
        elseif($tag === 'option'){
            $res = $template.$file;
        }
        elseif($tag === 'linkAdjust' || $tag === 'userLinkAdjust'){
            $res = $file;
        }
        return $res;
    }
}