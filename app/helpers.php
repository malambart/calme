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
 * Vérifie si un array est vide. Le paramètre default sert a indiquer le nombre d'éléments non mull par défaut.
 * @param $arr
 * @param $default
 * @return bool
 */
function non_empty_array($arr, $default = 0) {
    $el = 0;
    foreach ($arr as $value) {
        if(!is_null($value)) {
            $el = $el+1;
        }
    }
    if ($el >= 1+$default) {
        return true;
    }
    else {
        return false;
    }
}


