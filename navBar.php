<?php
    session_start();
    
    if(isset($_SESSION['user'])) $logged = true;
    else $logged = false;
    
    include "navBar.phtml";
?>