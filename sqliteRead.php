<!DOCTYPE html>
<html>
    
  <form action='' method='POST'>
    login  <input type='text' id='login' name='login' /><br/>
    password    <input type='text' id='pwd' name = 'pwd' /><br/>
    ID    <input type='text' id='id' name = 'id' /><br/>
           <input type='submit' name='submit' />
  </form>
  </br>

<?php

$db = new PDO ('sqlite:camagru.db'); 

// if (isset($_POST['submit'])) {
//  $stmt = db->prepare("INSERT INTO camagru VALUES (:login, :pwd, :id)");
//  $stmt->execute(array(:login => $_POST['login'],
//                                       :pwd => $_POST['pwd'],
//                                       :id => $_POST['id']));
//  
//}
//
//elseif (isset($_POST['delete'])) {
//  $stmt = db->prepare("DELETE FROM camagru WHERE login = :login");
//    
//}

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

if(isset($_POST['submit'])){
    
}
?>
    
</html>