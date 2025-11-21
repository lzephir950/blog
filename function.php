<?php

require_once(__DIR__ . '/config/mysql.php');

function alert($message){
    echo <script type='text/javascript'>alert('message');</script>
}