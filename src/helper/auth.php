<?php
session_start();
//controleren of ingelogd
function checkLoggedin() {
    //indien niet verwijzen naar login.php
    if(!isset($_SESSION['ingelogd'])){
        header("location:login.php");
        exit();
    }
}

?>