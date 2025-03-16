<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<?php
require 'init.php';
$result = '';

if(empty($_SESSION['user']))
{
  header('Location: index.html');
  exit();
}

if (isset($_POST["ajouter"])) {
  $nom = $_POST['nom'];

$select = mysqli_query($link, "SELECT * FROM filiere WHERE nom = '".$nom."'");
if(mysqli_num_rows($select)) {
        
    header("location:admin_ajouter_filiere.php?result=1");
}else{
	    $sql = "INSERT INTO filiere (nom) VALUES ('$nom')";

    // Exécuter la requête
    if(mysqli_query($link, $sql)) {
        header("location:admin_liste_filiere.php?result=1");
        exit();
    } else {
        $result = '<div class="alert alert-danger">Erreur lors de l\'ajout de la filière</div>';
    }

}
  }
?>

<?php include 'admin_header.php'; ?>

<script>    
    if(typeof window.history.pushState == 'function') {
        window.history.pushState({}, "Hide", '<?php echo $_SERVER['PHP_SELF'];?>');
    }
</script>

<body class="admin_body">
	
    <?php include 'admin_navbar.php'; ?>
    
    <div class="container-fluid body">
        <div class="row justify-content-between row align-items-center"></div>

        <div class="container admin_form"> 
            <div class="d-flex.justify-content-center" style="margin-right:4px;">
                <div class="card cardo" style="padding: 15px;">
                    <div class="col-12 mx-auto">
                        <?php 
                        if (isset($_GET['result']) && $_GET['result'] == 1) {
                            echo '<div class="alert alert-danger">cette filiere est déjà existe</div>';
                        } 
                        ?>
                    </div>
                    <div class="card-header">
                        <h4>Ajouter filière</h4>
                    </div> 
                    <div class="card-body">
                        <form class="was-validated" action="" method="post">
                            <div class="form-group">
                                <label for="inputAddress">Nom</label>
                                <input type="text" class="form-control" name="nom" placeholder="Nom" required>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-success m-4" name="ajouter">
                                    <i class="fas fa-lg fa-plus"></i> Ajouter 
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    </div>
</body>
</html>
