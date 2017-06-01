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


