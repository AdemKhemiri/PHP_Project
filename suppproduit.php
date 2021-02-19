<?php
ob_start();
include_once 'database.php';
$database = new database();

$id=$_GET['id'];

$sql=("DELETE from produits where id=$id");
//$sql1=$pdo->query("select * from produits where id = $id");
//$res1=$sql1->fetchAll(PDO::FETCH_ASSOC);
//print_r($res1);
$database->sendSQL($sql);


header("Refresh:0; url=listeProduit.php");
ob_end_flush();
?>