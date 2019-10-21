<?php


namespace app\element;


class ElementUser extends BaseElement
{
    public function getValues()
    {
        $res        = NULL;
        $content    = $this->tplHelper->searchTemplate('userConfig');
        $adjust     = $this->tplHelper->searchTemplate('userPassword');
        if(!empty($_POST['user']['userToManage'])){
            $adjust     = $this->tplHelper->searchTemplate('adminAddAdmin');
        }
        $content    = str_replace('####adjustments####', $adjust, $content);
        $res        = $this->replaceContent($this->data, $content, $this->tag);
        if($this->tag === 'userTable'){
            $content    = $this->tplHelper->searchTemplate('userTB');
            $userTable  = $this->tplHelper->searchTemplate('userTable');
            $tableData  = $this->replaceContent($this->data, $content, $this->tag);
            $res        = str_replace('####userTablebody####', $tableData, $userTable);
        }

        return $res;
    }

    public function replaceContent($userArray, $vanillaTemp , $tag, $temp = '', $maxCount = '', $counter = ''){
        !empty($temp) ? $userTemplate = $temp : $userTemplate = $vanillaTemp;
        if(empty($counter) && $tag === 'userTable'){
            $maxCount = count($userArray)-2;
        }
        else{
            $maxCount = $maxCount;
        }

        foreach($userArray as $userKey =>  $userValue) {
            if(is_array($userValue)) {
                    $userTemplate = $this->replaceContent($userValue, $vanillaTemp, $tag, $userTemplate, $maxCount, $counter++);
            }
            $token  = '####' . $userKey . '####';
            if ($userKey === 'admin_state' && $tag === 'userTable') {
                empty($userValue) ? $userValue = 'No' : $userValue = 'Yes';
            }
            elseif($userKey === 'admin_state' || $userKey === 'home' || $userKey === 'user_interface'){
                empty($userValue) ? $userValue = '' : $userValue = 'checked';
            }
            elseif($userKey === 'favorite'){
                $userValue = 'addFavorite';
            }
            if(is_string($userValue)){
                $userTemplate = str_replace($token, $userValue, $userTemplate);
            }
        }
        $res    = $userTemplate;
        if($this->tag === 'userTable' && !empty($temp) && $counter <= $maxCount){
            $res = $userTemplate.$vanillaTemp;
        }
        return $res;
    }
}