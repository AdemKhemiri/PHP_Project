<?php
    session_start();
    ob_start();
    include 'database.php';
    $db = new database();

    include 'connexion.php';
    


    if(!empty($_POST)){

        $name = $_POST['name'];
        $username = $_POST['username'];
        $psw = $_POST['password'];
        
        $hash = password_hash($psw, PASSWORD_DEFAULT);
        
        // CHECK FOR EXISTANT USERNAME
        $cmd = "SELECT * FROM users WHERE Username='$username'";
        // $e = $db->getOne($cmd);
        $querry = $pdo->prepare($cmd);
        $querry->execute();
        $e = $querry->fetchAll(PDO::FETCH_ASSOC); 
        
        // print_r($e);
         
        if(!empty($e))
        {
            // print_r($e);
            if($e['Username'] == $username)
            {
                $canSignup = false;
                $error = "Username already exist";
                include "Signup.phtml";
                ob_end_flush();
            }
        }
        else
        {
            
            $canSignup = true;
            // header("location:Signup.php");
            // echo "username exist";
        }
        
        //////////////////////////////////////////////
        if($canSignup)
        {
            echo $canSignup;
            $insert = "INSERT INTO users VALUES ('id', '$name', '$username', '$hash','')";
            $query = $pdo->prepare($insert);
            if($e = $query->execute())
            // if($db->sendSQL($insert))
            {
                $_SESSION['user'] = [
                    'id' => $e['ID'],
                    'name' => $name,
                    'username' => $username
                ];

                header("location:menu.php");
                ob_end_flush();
                exit();
            }
        }
    }
    else
    {
        $error = '';
        include("Signup.phtml");
        ob_end_flush();
    }
?>