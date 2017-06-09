<?php

/**
 *
 * Transforme un array en liste séparée par des virgules.
 *
 * @param $arr
 * @param $casse
 * @return string
 */
function toCSL($arr = [], $casse = null) {
    $list = implode(", ", $arr).".";

    if ($casse=='min') {
        $list = strtolower($list);
    }
    return $list;
}

/**
 * Vérifie si un array est vide
 * @param $arr
 * @return bool
 */
function non_empty_array($arr) {
    $el = 0;
    foreach ($arr as $k) {
        if(!is_null($k)) {
            $el = $el++;
        }
    }
    if ($el >= 1) {
        return true;
    }
    else {
        return false;
    }
}


