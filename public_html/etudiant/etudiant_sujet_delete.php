<?php
require 'init.php';
$id = $_GET['id'];

if(empty($_SESSION['user']))
{

  header('Location: ../index.html');
  exit();
}

$select2 = mysqli_query($link, "SELECT nom,id FROM etudiant WHERE  email = '".$_SESSION['user']."'");
$result2 = mysqli_fetch_assoc($select2) ;
$etudiant_id = $result2['id'];


$select = mysqli_query($link, "DELETE FROM choix WHERE etudiant_id = $etudiant_id and sujet_id=$id");
if($select) {
    
    header("Location:{$_SERVER['HTTP_REFERER']}");
    exit;

}else{

    exit('operation impossibles');  
}


// Close connection
mysqli_close($link);

?>