<?php
function mesfilmspreferes($films){
    for($i=0;$i<count($films);$i++){
        echo 'mon film préféré numéro '.($i+1).' est " '.$films[$i].' "<br/>';
    }
}
?>