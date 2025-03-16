<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<?php

$result = '';

require 'init.php';

if (empty($_SESSION['user'])) {
  header('Location:index.html');
  exit();
}

?>
<?php include 'admin_header.php'; ?>
<script>    
    if (typeof window.history.pushState == 'function') {
        window.history.pushState({}, "Hide", '<?php echo $_SERVER['PHP_SELF']; ?>');
    }
</script>

<body>
<?php include 'admin_navbar.php'; ?>
<div class="container search">
    <div class="row justify-content-between row align-items-center">
        <div class="col-sm-9 box" style="padding-left: 70px;">
            <h3 style="margin-right: 25px;">classement</h3>
            <script type="text/javascript">
                $(document).ready(function () {
                    window.setTimeout(function () {
                        $(".alert").fadeTo(1000, 0).slideUp(1000, function () {
                            $(this).remove();
                        });
                    }, 1500);
                });
            </script>
            <div class="col-6 mx-auto">
            <?php if (isset($_GET['result']) && $_GET['result'] != null) {
                $result = $_GET['result'];
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert" style="padding-top: 10px;padding-bottom: 10px; margin-top: 16px; background-color: #14bb1e63; border-color: #badbcc;">';
                echo '<strong>Success</strong> données affectées';
                echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="padding-top: 10px;padding-bottom: 20px;"></button>';
                echo '</div>';
            }
            ?>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid body">
    <div class="row-justify-content-center">
        <div class="col-sm-10">
        <?php if (isset($_GET['id'])) {
            $id1 = $_GET['id'];
            ?>
            <form action="ajouter_classement.php?id=<?php echo $id1; ?>" method="POST" style="padding-left: 190px;">
                <table id="myTable" class="table table-striped" data-toggle="table" data-mobile-responsive="true" data-pagination="true" data-height="460" style="font-size: 15px;">
                    <caption>
                        <button type="submit" name="update" id="update" value="Update" class="btn btn-primary m-4">Valider tous les classements</button>
                    </caption>
                    <thead class="thead1">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">NOM</th>
                            <th scope="col">PRENOM</th>
                            <th scope="col" style="width:10%;">EMAIL</th>
                            <th scope="col" style="width:10%;">CLASSMENT</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $select = mysqli_query($link, "SELECT * FROM etudiant WHERE filiere_id = $id1");
                    while ($result1 = mysqli_fetch_assoc($select)) {
                        $classement = $result1['classement'];
                        $id = $result1['id'];
                        ?>
                        <tr>
                            <th scope="row"><?php echo $result1['id']; ?></th>
                            <td><?php echo $result1['nom']; ?></td>
                            <td><?php echo $result1['prenom']; ?></td>
                            <td><?php echo $result1['email']; ?></td>
                            <td>
                                <input class="form-control" name="classement[]" value="<?php echo $classement; ?>">
                                <input type="hidden" class="form-control" name="id[]" value="<?php echo $id; ?>">
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
            </form>
            <?php
        }
        ?>
        </div>
    </div>
</div>

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>
</html>
