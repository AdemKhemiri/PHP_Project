<?php
session_start();

include 'database.php';
$db = new database();

ob_start();

if(!isset($_SESSION['user']))
{
    header('location:login.php');
    exit;
}

$e=$db->getMany("SELECT * FROM categories");

include('listeCategories.phtml');
ob_end_flush();

?>