<?php

require("db.php");
$id=$_GET['id'];
$token=$_GET['token'];
$update = "UPDATE enseignant SET status = 'ACTIVE' WHERE id = '$id' AND token = '$token' ";
$result = mysqli_query($link, $update);

if ($result){


$result='<div class="alert alert-success">Felisitation , vous pouvez connecter </div>';

header("location: /univ-mosta.tech/public_html/prof/connect.php?result=".urlencode($result));


}
else{
echo " vérification n'a pas faite une erreur s'est produite";


}





