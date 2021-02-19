<?php
session_start();
ob_start();
include 'database.php';
$db = new database();

if(!isset($_SESSION['user']))
{
    header('location:login.php');
    exit;
}
$Admin = false;

if(isset($_SESSION['isAdmin'])) $isAdmin = true;
else $isAdmin = false;


$username = $_SESSION['user']['name'];
// print_r($_SESSION['user']);

$sql= "SELECT produits.id,produits.nom AS nom_produit , produits.description ,produits.prix , produits.image, categories.nom    
        FROM produits  , categories 
        WHERE  produits.categories_id=categories.id";

$res = $db->getMany($sql);


include("listeProduit.phtml");
ob_end_flush();
?>