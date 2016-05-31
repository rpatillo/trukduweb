<!DOCTYPE html>
<?PHP
session_start();
?>
<html>
  <head>
    <meta charset="utf-8"/>
    <title>Camagru</title>
    <link href="style.css" type="text/css" rel="stylesheet">
  </head>

  <body>
      <?PHP include 'header.php'; ?>

      <div id="wrapperbody"> 
            <div id="lead-banner">
                <img src="/img/CamagruBig.jpg" alt="Camagru">
            </div>
          <?PHP if (!isset($_SESSION['login'])) : ?>
            <form action='' method="post">
	           Login: <input type="text" name="login" />
	           <br />
	           Password: <input type="text" name="passwd" />
                <br />
	           Email: <input type="text" name="mail" />
                <br />
	           <input type="submit" name='Sub_in' value="Creer votre compte" />
            </form> 
          <br />
          <br />
          <form action='' method="post">
	           Login: <input type="text" name="SubLog" />
	           <br />
	           Password: <input type="text" name="SubPwd" />
                <br />
	           <input type="submit" name='log_in' value="Login-in" />
        <?PHP else : ?>
            <p>You are allready logged in. Please logout to create another account.</p>
        <?PHP endif; ?>
              
              
              
            <?PHP
          //ACCOUNT CREATIOn
            if ($_POST['Sub_in'] === "Creer votre compte")
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
                    echo $_POST['login'] . ' your account has been created, a mail as been sent to you. </br>';
                    
                    // CREATION MAIL
                    $to = $_POST['mail'];
                    $subject = 'Account created on Camagru';
                    $message = 'Hi, your account as been created. Welcome aboard and have a nice day !';
                    mail($to, $subject, $message, $headers);
//                  header("refresh : 5, url=/Clogin.php"); 
                }
            }  
                            
              //LOGIN FONCT
               if ($_POST['log_in'] === "Login-in")
                {
                    $db = new PDO ('sqlite:camagru.db');
                    $pass = hash('whirlpool', 'Toto' . $_POST['SubPwd']);
                    $stmt = $db->prepare('SELECT 1 FROM camagru WHERE login = :login AND pwd = :pwd');
                    $stmt->bindParam(':login', $_POST['SubLog']);
                    $stmt->bindValue(':pwd', $pass, PDO::PARAM_STR);
                    $stmt->execute();
    
                    if ($stmt->fetch()) {
                        $_SESSION['login'] = $_POST['SubLog'];
                        echo 'Welcome ' . $_SESSION['login']; 
                   } else {
                        echo $_POST['SubLog'];
                        echo $pass;
                        echo 'Sorry, this user name already exist.';
                }
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