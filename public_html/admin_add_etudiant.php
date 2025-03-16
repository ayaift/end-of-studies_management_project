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
  $nom = isset($_POST['nom']) ? $_POST['nom'] : '';
  $prenom = isset($_POST['prenom']) ? $_POST['prenom'] : '';
  $email = isset($_POST['email']) ? $_POST['email'] : '';
  $password = isset($_POST['password']) ? $_POST['password'] : '';
  $specialite = isset($_POST['spécialité']) ? $_POST['spécialité'] : '';
  $status = "active";

  if (!empty($nom) && !empty($prenom) && !empty($email) && !empty($password) && !empty($specialite)) {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)){
      $select = mysqli_query($link, "SELECT * FROM etudiant WHERE email = '$email'");
      if (mysqli_num_rows($select)){
        $result = '<div class="alert alert-danger">Cette adresse email est déjà utilisée</div>';
        header("Location: admin_add_etudiant.php?result=1");
        exit;
      } else {
        $sql = "INSERT INTO etudiant (nom, prenom, email, password, filiere_id, status) VALUES (?, ?, ?, ?, ?, ?)";
        if ($stmt = mysqli_prepare($link, $sql)){
          mysqli_stmt_bind_param($stmt, "ssssis", $nom, $prenom, $email, $password, $specialite, $status);
          if (mysqli_stmt_execute($stmt)){
            header("Location: admin_etudiant.php");
            exit;
          } else {
            $error = "ERROR: Could not execute query: $sql. " . mysqli_error($link);
          }
        } else {
          $error = "ERROR: Could not prepare query: $sql. " . mysqli_error($link);
        }
      }
    } else {
      $error = "L'adresse email n'est pas valide!";
    }
  } else {
    $error = "Tous les champs doivent être complétés!";
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
                            echo '<div class="alert alert-danger">Ce Etudiant existe déjà</div>';
                        } 
                     
                        ?>
                    </div>
                    <div class="card-header">
                        <h4>Ajouter étudiant</h4>
                    </div> 
                    <div class="card-body">
                       <form action="admin_add_etudiant.php" method="POST">
                            <div class="col-sm-12 col-sm-offset-4">
                                <p>
                                    <?php if (isset($result) && !empty($result)) {
                                      echo $result;
                                    } ?>
                                </p>
                            </div>
          
                            <div class="container">
                                <div class="form-group">
                                    <label for="nom">Nom:</label><br>
                                    <input type="text" id="nom" name="nom" placeholder="Entrez le nom" required>
                                </div>
                                <div class="form-group">
                                    <label for="prenom">Prénom:</label><br>
                                    <input type="text" id="prenom" name="prenom" placeholder="Entrez le prénom" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email:</label><br>
                                    <input type="email" id="email" name="email" placeholder="Entrez l'email" required>
                                </div>
                                <div class="form-group">
                                    <label for="password">Mot de passe:</label><br>
                                    <input type="password" id="password" name="password" placeholder="Entrez le mot de passe" required>
                                </div>
                                <div class="form-group">
                                    <label for="specialite">Spécialité:</label><br>
                                    <select class="form-select" name="spécialité">
                                      <?php 
                                        $sql1 = "SELECT * FROM filiere";
                                        $exec1 = mysqli_query($link, $sql1);
                                        while ($row = mysqli_fetch_assoc($exec1)) {
                                          echo "<option value='$row[id]'>$row[nom]</option>";
                                        }
                                      ?>
                                    </select>
                                </div>
                            </div>
                            <button class="btn btn-primary nvla" type="submit" name="ajouter">Ajouter</button>
                            <div class="d-flex justify-content-between"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    </div>
</body>
</html>
