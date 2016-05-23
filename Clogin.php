<!DOCTYPE html>
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
        
            <form action="index.php" method="$_GET">

	           Identifiant: <input type="text" name="login" value="<?php echo $_SESSION['Identifiant']; ?>" />
	           <br />
	           Mot de passe: <input type="text" name="passwd" value="<?php echo $_SESSION['Mot de passe']; ?>" />
	           <input type="submit" name="submit" value="OK" />

            </form>
            
        </div>
        <?php include 'footer.php';?>
  </body>
</html>

<?PHP

if ($_POST['login'] !== NULL && $_POST['passwd'] !== NULL && $_POST['submit'] !== NULL && $_POST['submit'] === "OK" && $_POST['passwd'] !== "" && $_POST['login'] !== "")
{
    $db = new PDO ('sqlite:camagru.db') or die ("cannot open");
    $tab = array();
    $login = $_POST['login'];
    
    // Ici verifier retour de QUERY sur DB
    
    
    // rajouter une protection sup ? (concatener avec un autre ?)
    $pass = hash('whirlpool', $_POST['passwd']);
    
    // ADD dans la DB
    //$tab[] = array ("login" => $login, "passwd" => $pass);
    
    echo "OK\n";
}
else
    echo "ERROR\n";
?>