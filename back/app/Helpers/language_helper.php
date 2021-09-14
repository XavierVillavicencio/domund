<?php
/* Language helper */
function getLanguageArray($currentLanguage = 'es',$module = 'api'){
    $out = json_decode(file_get_contents('../../languages/'.$module.'/location.'.$currentLanguage.'.json'));
    return  $out;
}

function getLanguageConfig($currentLanguage = 'es',$module = 'api'){
    $out = json_decode(file_get_contents('../../languages/'.$module.'/location.'.$currentLanguage.'.json'));
    return  $out->config;
}

function getLanguageKey($key = null,$currentLanguage = 'es',$module = 'api'){
    if(empty($key)): return null; endif;
    $out = json_decode(file_get_contents('../../languages/'.$module.'/location.'.$currentLanguage.'.json'));
    if(is_array($key)){
        foreach($key as $pieces){
            if(empty($out->content->$pieces)){
                $output[$pieces] = '';
            }else{
                $output[$pieces] = $out->content->$pieces;
            }
            
        }
        return $output;
    }else{
        return  $out->content->$key;
    }
}
