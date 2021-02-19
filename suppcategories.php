<?php
ob_start();
include 'database.php';
$database = new database();

$id=$_GET['id'];

$sql=("DELETE from categories where id=$id");
// //$sql1=$pdo->query("select * from produits where id = $id");
// //$res1=$sql1->fetchAll(PDO::FETCH_ASSOC);
// //print_r($res1);
// $res=$pdo->prepare($sql);
// $res->execute([$id]);
$database->sendSQL($sql);

header("Refresh:0; url=listeCategories.php");
ob_end_flush();
?>