<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<?php

include "db.php";

  if(isset($_POST['submit'])){
    $ids = array_keys($_POST['sujet_id']);
    
    foreach ($ids as $id) {
     
     $priorité = mysqli_real_escape_string($link,$_POST['priorité'][$id]);
     $sujet_id = mysqli_real_escape_string($link,$_POST['sujet_id'][$id]);
     $etudiant_id = mysqli_real_escape_string($link,$_POST['etudiant_id'][$id]);
     $id = mysqli_real_escape_string($link,$id);
    $update = mysqli_query($link,"update choix set priorité ='$priorité' where etudiant_id ='$etudiant_id' and sujet_id = '$sujet_id'");
    }



    if ($update) {
$select = mysqli_query($link, "SELECT sujet_id, etudiant_id FROM choix WHERE priorité = 1 AND etudiant_id = '$etudiant_id'");
$row = mysqli_fetch_assoc($select);
$sujet_id = $row['sujet_id'];
$etudiant_id = $row['etudiant_id'];

$sql = "UPDATE etudiant SET sujet_id = ? WHERE id = ?";
$stmt = mysqli_prepare($link, $sql);

mysqli_stmt_bind_param($stmt, "ii", $sujet_id, $etudiant_id);
mysqli_stmt_execute($stmt);

 
    $result=1;
      header("location:".$_SERVER['HTTP_REFERER']."?result=".urlencode($result));
      

  }
}

?>









