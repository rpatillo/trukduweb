<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>Sqlite Admin</title>
        <link href="style.css" type="text/css" rel="stylesheet">
    </head>
    <body>
        <?php include 'header.php';?>
        <div id="wrapper">
            <div id="lead-banner">
                <img src="/img/CamagruBig.jpg" alt="Camagru">
            </div>
            <form action='' method='POST'>
                login  <input type='text' id='login' name='login' /><br/>
                password    <input type='text' id='pwd' name = 'pwd' /><br/>
                ID    <input type='text' id='id' name = 'id' /><br/>
                <input type='submit' name='action'  value="Save" />
                <input type='submit' name='action' value="Delete" />
            </form>
            </br>
        
            <?php
                // Table Impression
                $db = new PDO ('sqlite:camagru.db'); 
                print "<table border=1>";
                print "<tr><td>Login</td><td>Pwd</td><td>Id</td></tr>";
                $result = $db->query('SELECT * FROM camagru');
                foreach($result as $row)
                {
                print "<tr><td>".$row['login']."</td>";
                print "<td>".$row['pwd']."</td>";
                print "<td>".$row['id']."</td>";
                }
                print "</table>";
            ?>
            <br />

            <form action='' method='POST'>
                login  <input type='text' id='login_in' name='login_in' /><br/>
                password    <input type='text' id='pwd_in' name = 'pwd_in' /><br/>
                <input type='submit' name='action'  value="Log_in" />
            </form>
        

            </div>
        <?php include 'footer.php';?>
    </body>
<?php

$db = new PDO ('sqlite:camagru.db') or die ("cannot open"); 

// Script creation compte
if ($_POST['action'] == 'Save') {
    $stmt = $db->prepare("INSERT INTO camagru ('login', 'pwd', 'id') VALUES (:login, :pwd,              :id)");
    $stmt->bindValue('login', $_POST['login'], PDO::PARAM_STR);
    $stmt->bindValue('pwd', $_POST['pwd'], PDO::PARAM_STR);
    $stmt->bindValue('id', $_POST['id'], PDO::PARAM_INT);
    $stmt->execute(); 
    print_r ($stmt);
}

// Script suppression compte
elseif ($_POST['action'] == 'Delete') {
    $stmt = $db->prepare("DELETE FROM camagru WHERE login = :login");
    $stmt->bindValue('login', $_POST['login'], PDO::PARAM_STR);
    $stmt->execute();
}

// Check Login
if ($_POST['action'] == 'Log_in') {

    $stmt = $db->query('SELECT EXISTS(SELECT * FROM camagru WHERE login= :login AND pwd= :pwd)');
     print_r ($stmt);
    $stmt->bindValue(':login', $_POST['login_in'], PDO::PARAM_STR);
    $stmt->bindValue(':pwd', $_POST['pwd_in'], PDO::PARAM_STR);
    $result = $stmt->execute();
    
//    if ($result == 1) {
//        echo'worked';
//    }
//    else {
//        echo 'failed';
//    }
}
?>
    
</html>