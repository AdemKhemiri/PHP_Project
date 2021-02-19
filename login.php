<?php
    session_start();
    ob_start();
    include 'database.php';
    $db = new database();
    
    if(isset($_SESSION['user']))
    {
        header("location: menu.php");
    }
  
    if(!empty($_POST))
    {
        $username = $_POST['username'];
        $psw = $_POST["password"];
        $hash = password_hash($psw, PASSWORD_DEFAULT);

        ///////////////////////////////////////////////////////////////////////////////////////////
            $cmd = "SELECT * FROM users ";                                                       //
            $e = $db->getMany($cmd);                        //     CHECKING FOR USER EXISTANCE   //
            // $querry = $pdo->prepare($cmd);                                                    //
            // $querry->execute();                                                               //
            // $e = $querry->fetchAll(PDO::FETCH_ASSOC);                                         //
        ///////////////////////////////////////////////////////////////////////////////////////////
        
        if(!empty($e))
        { 
            $nb = false;
            foreach ($e as $row)
            {
                if(password_verify($psw, $row['Password']) & $username == $row['Username'])
                {
                    $nb = true;
                    $_SESSION['user'] = [
                        'id' => $row['ID'],
                        'username' => $row['Username'],
                        'name' => $row['Name'],
                        
                    ];
                    if($row['Admin'] == 1) $_SESSION['isAdmin'] = true;
                    else $_SESSION['isAdmin'] = false;
                    
                    header('location:menu.php');
                    ob_end_flush();
                    exit();
                }
            }
            if(!$nb)
            {
                $error = 'Username or password is incorrect';
                include 'login.phtml';
                ob_end_flush();
                // header("refresh: 0");
            }
        }
    }
    else
    {
        $error = '';
        include 'login.phtml';
        ob_end_flush();
    }
?>