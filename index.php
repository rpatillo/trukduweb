<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8"/>
    <title>Camagru</title>
    <link href="style.css" type="text/css" rel="stylesheet">
  </head>

  <body>
      <?php include 'header.php';?>
        <div id="wrapper">
            <div id="lead-banner">
                <img src="/img/CamagruBig.jpg" alt="Camagru">
            </div>
            <a href="/photo.php">[Goto Pictures]</a>
        </div>
        <?php include 'footer.php';?>
  </body>
</html>


PDOStatement Object ( [queryString] => INSERT INTO camagru ('login', 'pwd', 'id') VALUES (:login, :pwd, :id) )
PDOStatement Object ( [queryString] => SELECT EXISTS (SELECT * FROM camagru WHERE login= :login AND pwd= :pwd) )