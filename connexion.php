<?php



try {
    $pdo= new Pdo('mysql:host=127.0.0.1;dbname=boutique','root','');
} catch (PDOException $e ) {
         print_r($e);
}


?>