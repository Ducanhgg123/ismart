<?php
    // $file is $_FILE['file']
    function check_image($file,$file_dir='uploads/'){
        $error=array();
        $file_name=$file_dir.$file['name'];
        // Check extensions
        $type=pathinfo(strtolower(basename($file['name'])),PATHINFO_EXTENSION);
        $allowed_type=array('png','jpg','jpeg','gif');
        if (!in_array($type,$allowed_type))
            $error['type']='File ảnh phải có đuôi là .png, .jpg, .jpeg và .gif';
        // Check size
        $size=$file['size'];
        // Size >20MB
        if ($size>20971520)
            $error['size']='File ảnh không được vượt quá 20MB';
        return $error;
    }
    function get_copy_file($file_name,$file_dir="uploads/"){
        if (!file_exists(($file_name)))
            return $file_name;
        $extension=pathinfo($file_name,PATHINFO_EXTENSION);
        $name=basename($file_name);
        $new_file_name=$file_dir.$name."-Copy.".$extension;
        $i=1;
        while (file_exists($new_file_name)){
            $i++;
            $new_file_name=$file_dir.$name."-Copy (".$i.").".$extension;
        }
        return $new_file_name;
    }
?>