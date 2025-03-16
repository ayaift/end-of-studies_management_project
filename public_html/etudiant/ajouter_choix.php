 <?php
require 'init.php';
$id = $_GET['id'];



if(empty($_SESSION['user']))
{

  header('Location: ../index.html');
  exit();
}

$select = mysqli_query($link, "SELECT nom,id FROM etudiant WHERE email = '".$_SESSION['user']."' ");
$result = mysqli_fetch_assoc($select) ;

$etudiant_id=$result['id'];


$select1 = mysqli_query($link, "SELECT sujet_id FROM choix WHERE etudiant_id = '".$result['id']."' and sujet_id = '".$_GET['id']."' ");

if(mysqli_num_rows($select1)) {
  echo "<script type='text/javascript'>alert('Ce titre est déjà on vos choix');</script>";
  echo "<script type='text/javascript'>document.location.href='{$_SERVER['HTTP_REFERER']}';</script>";
 
  
}else{
  

  $select2 = mysqli_query($link, "SELECT * FROM choix WHERE etudiant_id = '".$result['id']."'");
  $message= 'vous avez choisi le maximum des choix :15 ';
  

  $msg=0;
  if(mysqli_num_rows($select2)<(3)){
    $result2=mysqli_num_rows($select2);
    $_SESSION['msg']=$result2+1;
  
  
  
 
 
      

// Prepare an insert statement
$sql = "INSERT INTO choix (etudiant_id,sujet_id) VALUES (?,?) ";


if($stmt = mysqli_prepare($link, $sql)){
  // Bind variables to the prepared statement as parameters
  mysqli_stmt_bind_param($stmt, "ii", $etudiant_id,$id);

  // Set parameters

  // Attempt to execute the prepared statement
  if(mysqli_stmt_execute($stmt)){

    header("Location:{$_SERVER['HTTP_REFERER']}");

    
  } else{
      echo "ERROR: Could not execute query: $sql. " . mysqli_error($link);
  }
} else{
  echo "ERROR: Could not prepare query: $sql. " . mysqli_error($link);
}



mysqli_stmt_close($stmt);





// Close connection
mysqli_close($link);
  }
  else{
    echo "<script type='text/javascript'>alert('$message');</script>";
    echo "<script type='text/javascript'>document.location.href='{$_SERVER['HTTP_REFERER']}';</script>";
   
  
    
   
  }
}
?>