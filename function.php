<?php

require_once(__DIR__ . '/config/mysql.php');

// function alert($message){
//     echo <script type='text/javascript'>alert('message');</script>
// }


function mb_ucfirst(string $str, string $encoding = null): string
{
    if ($encoding === null) {
        $encoding = mb_internal_encoding();
    }
    return mb_strtoupper(mb_substr($str, 0, 1, $encoding), $encoding) . mb_substr($str, 1, null, $encoding);
}

