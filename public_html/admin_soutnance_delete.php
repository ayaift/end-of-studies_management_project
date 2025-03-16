<?php
require 'init.php';
$id = $_GET['id'];

if(empty($_SESSION['user']))
{

  header('Location:index.html');
  exit();
}


$select = mysqli_query($link, "DELETE FROM events WHERE id = $id");
if($select) {
    
      header("location: /univ-mosta.tech/public_html/soutnance/liste.php");
    exit;

}else{

    exit('operation impossibles');  
}


// Close connection
mysqli_close($link);

?>