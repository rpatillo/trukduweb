<!DOCTYPE html>
<?PHP
session_start();
?>
<html>
<body>
    <div id="wrapperheader">
        <nav id="main-navigation">
            <ul>
                <li><a href="/index.php">Home</a></li>
                
                <li><a href="/Clogin.php">
                    <?PHP 
                    if ($_SESSION['login'] != NULL) {
                        echo $_SESSION['login'];
                    } else {   
                        echo 'Login';
                    }
                    ?>
                    </a></li>
                <li><a href="/photo.php">Take pictures</a></li>
                <li><a href="#">Gallery</a></li>
                <li><a href="#">My photos</a></li>
            </ul>
        </nav>
    </div>
</body>
</html>