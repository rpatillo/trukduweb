<!DOCTYPE html>
<?PHP
session_start();
?>
<html>
  <head>
    <meta charset="utf-8"/>
    <title>Clogin</title>
    <link href="style.css" type="text/css" rel="stylesheet">
  </head>

  <body>
      <?php include 'header.php';?>
        <div id="wrapper">
            <div id="lead-banner">
                <img src="/img/CamagruBig.jpg" alt="Camagru">
            </div>
            <form action='' method="post">
	           Login: <input type="text" name="login" />
	           <br />
	           Password: <input type="text" name="passwd" />
                <br />
	           Email: <input type="text" name="mail" />
                <br />
	           <input type="submit" name='log_in' value="Creer votre compte" />
            </form>
            
            <?PHP
            if ($_POST['log_in'] === "Creer votre compte")
            {
                $db = new PDO ('sqlite:camagru.db');
    
                $stmt = $db->prepare('SELECT 1 FROM camagru WHERE login = :login');
                $stmt->bindParam(':login', $_POST['login']);
                $stmt->execute();
    
                if ($stmt->fetch()) {
                    echo 'Sorry, this user name already exist.';
                } else {
                    $pass = hash('whirlpool', 'Toto' . $_POST['passwd']);
                    $stmt = $db->prepare("INSERT INTO camagru ('login', 'pwd', 'mail', 'id') VALUES (:login, :pwd, :mail, null)");
                    $stmt->bindValue('login', $_POST['login'], PDO::PARAM_STR);
                    $stmt->bindValue('pwd', $pass, PDO::PARAM_STR);
                    $stmt->bindValue('mail', $_POST['mail'], PDO::PARAM_STR);
                    $stmt->execute();
                    $_SESSION['login'] = $_POST['login'];
                    echo $_SESSION['login'] . ' your account has been created. </br>';
                    header("refresh : 5, url=/photo.php"); 
                }
                // rajouter une protection sup ? (concatener avec un autre ?)
                //$pass = hash('whirlpool', 'Toto' . $_POST['passwd']);
            }
            ?>
            
        </div>
        <?php include 'footer.php';?>
  </body>
</html>

<!--
$_POST['login'] !== NULL && $_POST['passwd'] !== NULL && 
$_POST['submit'] !== NULL &&
 && $_POST['passwd'] !== "" && $_POST['login'] !== ""
-->