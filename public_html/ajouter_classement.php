<?php

include "db.php";

  if(isset($_POST['update'])){
    $ids = array_keys($_POST['id']);
    
    foreach ($ids as $id) {
     
     $classement = mysqli_real_escape_string($link,$_POST['classement'][$id]);
     $id = mysqli_real_escape_string($link,$_POST['id'][$id]);

     $id = mysqli_real_escape_string($link,$id);
    $update = mysqli_query($link,"update etudiant set classement ='$classement' where id ='$id'");
    }



    if ($update) {
     $result = "yes";
$id = $_GET['id'];

header("location:/univ-mosta.tech/public_html/classement.php?result=" . urlencode($result) . "&id=" . urlencode($id));
exit();


      

  }
}

?>



