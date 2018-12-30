<?php
$url=$_SERVER['REQUEST_URI'];
//var_dump($url);
if ($url=='/list'){
    require '../index.php';
    echo "here";
}
elseif ($url=='/contact'){
    require '../show.php';
}

