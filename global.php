<?php

function str_split_unicode($str, $l = 0) {                                     //utf-8 split
    if ($l > 0) {
        $ret = array();
        $len = mb_strlen($str, "UTF-8");
        for ($j = 0; $j < $len; $j += $l) {
            $ret[] = mb_substr($str, $j, $l, "UTF-8");
        }
        return $ret;
    }
    return preg_split("//u", $str, -1, PREG_SPLIT_NO_EMPTY);
}

 ?>
