<?php
session_start();
include_once 'database.php';
$db = new database();

ob_start();

if(isset($_SESSION['user'])) $logged = true;
    else $logged = false;

    $sql = "SELECT id, nom
            FROM categories";

    
    $categories = $db->getMany($sql);

    include 'ajoutProduit.phtml';    

if(isset($_POST['envoyer'])){
    if(empty($_POST['nomproduit'])||empty($_POST['description'])||empty($_POST['prix'])){
        echo '<script language="Javascript"> alert ("veuillez remplir le formulaire" )</script>';}
       else {echo 'verifier';}  
       
        $dir = "./img/";
        $filename = $_FILES['photo']['name'];
        $taille = $_FILES['photo']['size'];
        $type = $_FILES['photo']['type'];
        $nom_tmp = $_FILES['photo']['tmp_name'];
        if(is_uploaded_file($_FILES['photo']['tmp_name']))
        {
            move_uploaded_file($nom_tmp,$dir.$filename);
        }
        else $filename = ''; //die("Probleme d'envoi de fichier");

        
       $nom=$_POST['nomproduit'];
       $desc=$_POST['description'];
       $prix=$_POST['prix'];
       $cat=$_POST['categories'];
     
 
       $insert=("INSERT INTO produits VALUES('id','$nom','$desc',$prix,'$filename',$cat,NOW(),NOW())");

       if ($db->sendSQL($insert)) 
       {
        echo "New record created successfully";
      }
      header('location:listeProduit.php'); 
      ob_end_flush();
    }

?>