<?php
function dbconnect(){
    $bdd = mysqli_connect('localhost', 'root', '', 'employees');
    return $bdd;
}
?>
