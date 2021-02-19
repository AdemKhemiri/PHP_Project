<?php
session_start();
include 'database.php';
$db = new database();

    ob_start();

    if(isset($_SESSION['user'])) $logged = true;
    else $logged = false;
    
    $sql = "SELECT id, nom
            FROM categories";

    

    $categories = $db->getMany($sql);
    
    

    $id = $_GET['id'];

   $sql = "SELECT *
            FROM produits
            WHERE id=$id;";

    // $q = $pdo->query($sql);
    $produit = $db->getOne($sql);
    
    include 'editerProduit.phtml';

    if(isset($_POST['Editer']))
    {

        $nom=htmlspecialchars($_POST['nomproduit']);
        $desc=htmlspecialchars($_POST['description']);
        $prix=$_POST['prix'];
        $cat=$_POST['categories'];
    
        
       $sql = "UPDATE produits SET nom='$nom', description='$desc', prix='$prix', categories_id='$cat' WHERE id=$id";
       
       $db->sendSQL($sql);

       header('location:listeProduit.php');
       ob_end_flush();
    }

?>