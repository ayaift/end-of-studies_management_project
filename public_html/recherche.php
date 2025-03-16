<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<?php
require 'init.php';

if (empty($_SESSION['user'])) {
    header('Location: ../index.html');
    exit();
}

$select4 = mysqli_query($link, "SELECT * FROM filiere");
$result4 = mysqli_fetch_assoc($select4);
$specialite4 = $result4['id'];

$searchTerm = "";
if (isset($_GET['search'])) {
    $searchTerm = $_GET['search'];
}

$select = "SELECT * FROM sujet WHERE   mot_clé LIKE '%$searchTerm%'";

$result = mysqli_query($link, $select);
?>

<?php include 'admin_header.php'; ?>
<body>
	
<?php include 'admin_navbar.php'; ?>

<div class="container search">
    <div class="row justify-content-between row align-items-center">
        <div class="col-sm align-center">
            <h3>Résultats de la recherche</h3>
        </div>
    </div>
</div>

<div class="container-fluid body">
    <table class="table table-striped" style="font-size:14px">
        <caption>Liste des sujets</caption>
        <thead class="thead1">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">TITRE</th>
                <th scope="col" style="width:40%;">RÉSUMÉ</th>
                <th scope="col">SPÉCIALITÉ</th>
                <th scope="col">MOT-CLE</th>
                <th scope="col">ENSEIGNANT</th>
               
                
            </tr>
        </thead>
        <tbody class="tbody1">
            <?php
            while ($result1 = mysqli_fetch_assoc($result)) {
                $select1 = mysqli_query($link, "SELECT id, nom FROM enseignant WHERE id = '" . $result1['enseignant_id'] . "'");
                $result2 = mysqli_fetch_assoc($select1);

                
            $req = mysqli_query($link,"SELECT * from filiere where id='".$result1['filiere_id']."'");
            $rows=mysqli_fetch_assoc($req);
                ?>
                <tr>
                    <th scope="row"><?php echo $result1['id']; ?></th>
                    <td><b><?php echo $result1['titre']; ?></b></td>
                    <td><?php echo $result1['résumé']; ?></td>
                    <td><?php echo $rows['nom']; ?></td>
                    <td><?php echo $result1['mot_clé']; ?></td>
                    <td><?php echo $result2['nom']; ?></td>
                  
                   
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>
</html>