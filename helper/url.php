<?php

function base_url($url = "") {
    global $config;
    return $config['base_url'].$url;
}
function redirect($url = ""){
    if (empty($url)){
        $url=base_url();
    }
    header("Location: $url");
}
function makeURL($url){
    $url=trim($url);
    $url=str_replace(' ','-',$url);
    $url=preg_replace("/(á|à|ă|ắ|ằ|ạ)/",'a',$url);
    $url=preg_replace("/(đ)/",'d',$url);
    $url=preg_replace("/(ê|ế|ề|ể|ễ|ẹ)/",'e',$url);
    $url=preg_replace("/(ị|ỉ|ì|í|ĩ)/",'i',$url);
    $url=preg_replace("/(ó|ò|ỏ|õ|ọ|ố|ồ|ổ|ỗ|ộ|ơ|ở|ỡ|ớ|ờ)/",'o',$url);
    $url=preg_replace("/(ú|ù|ủ|ụ|ũ|ử|ứ|ừ|ự|ữ)/",'u',$url);
    $url=preg_replace("/(ý|ỳ|ỷ|ỹ|ỵ)/",'y',$url);
    return $url;
}
