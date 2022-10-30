<?php
function currency_format($number, $suffix = 'đ'){
    return number_format($number).$suffix;
}
function gender_format(){
    return '##';
}
function format_list_cat($data, $parent_id = 0, $level = 0)
{
    $list_cat = array();
    foreach ($data as $cat)
        if ($cat['parent_id'] == $parent_id) {
            $cat['level'] = $level;
            $list_cat[] = $cat;
            $sub_cat = format_list_cat($data, $cat['id'], $level + 1);
            $list_cat = array_merge($list_cat, $sub_cat);
        }
    return $list_cat;
}