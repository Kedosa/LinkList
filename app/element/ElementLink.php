<?php


namespace app\element;


class ElementLink extends BaseElement
{
    public function getValues(){
        $tbody = $this->tplHelper->searchTemplate('tbody');
        $content = file_get_contents($tbody);
        if($this->tag === 'nav'){
            $navItemTpl = $this->tplHelper->searchTemplate('navItem');
            $content = file_get_contents($navItemTpl);
        }
        $content =  $this->replaceContentLink($content, $this->data, $this->tag, $this->template);
        $res = $content;
        return $res;
    }
    protected function replaceContentLink($file, $infoArray, $tag, $template = NULL){
        $res = NULL;
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

        }
        if($tag === 'table' ){
            $res = $template.$file;
        }

        if($tag === 'nav'){
            $res = $template;
        }

        return $res;
    }
}