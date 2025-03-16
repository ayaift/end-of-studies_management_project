<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<?php
require 'init.php';

if(empty($_SESSION['user'])) {
  header('Location: ../index.html');
  exit();
}

$select = mysqli_query($link, "SELECT nom,id FROM enseignant WHERE email = '".$_SESSION['user']."' ");
$result = mysqli_fetch_assoc($select);

$enseignant = $result['nom'];
$enseignant_id = $result['id'];
$titre = $_REQUEST['titre'];
$resume = $_REQUEST['resume'];
$mot_cle = $_REQUEST['mot_cle'];
$specialite = $_REQUEST['spécialité'];

$select = mysqli_prepare($link, "SELECT * FROM sujet WHERE titre = ?");
mysqli_stmt_bind_param($select, "s", $titre);
mysqli_stmt_execute($select);
$result = mysqli_stmt_get_result($select);

if(mysqli_num_rows($result) > 0) {
  $result='<div class="alert alert-danger">ce titre est déjà utilisé </div>';
  header("location:prof_ajouter_sujet.php?result=1");
} else {
  $insert = mysqli_prepare($link, "INSERT INTO sujet (titre,résumé,filiere_id,mot_clé,enseignant_id) VALUES (?,?,?,?,?)");
  mysqli_stmt_bind_param($insert, "ssisi", $titre, $resume, $specialite, $mot_cle, $enseignant_id);

  if(mysqli_stmt_execute($insert)) {
    $result='<div class="alert alert-success">sujet ajouté</div>';
    header("location:prof_sujet.php?result=2");
  } else {
    echo "ERROR: Could not execute query: " . mysqli_error($link);
  }

  mysqli_stmt_close($insert);
}

mysqli_close($link);
?>
