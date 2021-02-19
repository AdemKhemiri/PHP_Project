<?php
session_start();

include 'database.php';
$db = new database();
ob_start();

if(isset($_SESSION['user'])) $logged = true;
    else $logged = false;

include("ajoutCategories.phtml");


if(isset($_POST['envoyer'])){
    if(empty($_POST['nom'])||empty($_POST['description'])){
        echo '<script language="Javascript"> alert ("veuillez remplir le formulaire" )</script>';}
       else {echo 'verifier';}  
       
       $nom=$_POST['nom'];
       $desc=$_POST['description'];
       
 
       $insert=("INSERT INTO categories values(null,?,?,NULL,NOW(),NOW())");
       
       if ($db->sendSQL($insert,[$nom,$desc])) 
       {
            echo "New Categorie created successfully";
            header('location:listeCategories.php');
            ob_end_flush();
        }
      
    
    }



?>