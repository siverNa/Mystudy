<?php
    $filename = "readme.txt";

    if(is_writable($filename)){
        echo "This file is writable.";
    } else {
        echo "This file is not writable";
    }
?>