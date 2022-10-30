<?php
function get_num_file(){
    $tmp = scandir("public/uploads");
    $tmp = array_slice($tmp, 2, count($tmp) - 2);
    $list_file = array();
    foreach ($tmp as $file) {
            // echo $file;
            $list_file[] = array('name' => $file);
        }
    return count($list_file);
}
?>