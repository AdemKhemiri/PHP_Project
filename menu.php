<?php
    session_start();
    if(isset($_SESSION['user']))
        $name = $_SESSION['user']['name'];

        if(isset($_SESSION['user'])) $logged = true;
        else $logged = false;
        
    include("menu.phtml");
?>