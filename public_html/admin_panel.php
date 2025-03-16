<?php

require 'init.php';

if(empty($_SESSION['user']))
{

  header('Location:index.html');
  exit();
}



$select = mysqli_query($link, "SELECT * FROM sujet ");

if (isset($_GET['search'])) {
    $searchTerm = $_GET['search'];
    header("Location: recherche.php?search=$searchTerm");
    exit();
}

?>

<?php include 'admin_header.php'; ?>
<head>
  <link rel="shortcut icon" type="image/png" href="img/logo.png"/>
</head>
<body>
	
  <?php include 'admin_navbar.php'; ?>

<div class="container search">
 <div class="row justify-content-between row align-items-center">
 	<div class="col-sm align-center">
 		<h3>Liste des soutenances</h3>
      </div>


  <div class="col-sm-4">
  
    <form class="d-flex" method="GET">

        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search">
        <button class="btn btn-outline-success" type="submit">Search</button>
        
      </form>
      </div>
	</div>

	</div>
    <script type="text/javascript">

    $(document).ready(function () {
     
    window.setTimeout(function() {
        $(".alert").fadeTo(1000, 0).slideUp(1000, function(){
            $(this).remove(); 
        });
    }, 1500);
     
    });
    </script> 
       <div class="col-12 mx-auto"  >
            <?php if (isset($_GET['result'])!=(null))  {
              $result=$_GET['result'];
            if ($result==1) {
               
               echo '<div class="alert alert-success">sujet modifier </div>';
              }
      
                }  ?>  
              </div>


  <div class="container-fluid body">
 
<table class="table table-striped"  style="font-size:14px">
  <caption>Liste des users</caption>
  <thead class="thead1">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">TITRE</th>
      <th scope="col"style="width:40%;">RÉSUMÉ</th>
      <th scope="col">SPÉCIALITÉ</th>
      <th scope="col">MOT-CLE</th>
      <th scope="col"style="width:8%;">ETAT</th>
       <th scope="col">PROF</th>
       <th scope="col" style="width:10%;">OPTIONS</th>
       
    </tr>
  </thead>
 
  <tbody class="tbody1">


        <tr>
        <?php
        while ($result1 = mysqli_fetch_assoc($select)){
          $select1 = mysqli_query($link, "SELECT id,nom FROM enseignant WHERE id = '".$result1['enseignant_id']."'");

            $result = mysqli_fetch_assoc($select1) ;
               $req = mysqli_query($link,"SELECT * from filiere where id='".$result1['filiere_id']."'");
            $rows=mysqli_fetch_assoc($req);

          ?>
      <th scope="row"> <?php echo $result1['id'];?></th>
      <td> <b><?php echo $result1['titre']; ?></b></td>
      <td> <?php echo $result1['résumé'];?></td>
       <td> <?php echo $rows['nom'];?> </td>
       <td> <?php echo $result1['mot_clé']; ?></td>
       <td> <p style="color:blue"><?php echo $result1['etat'];?> </p></td>
    
       <td> <?php echo $result['nom']; ?></td>
    
      <td>
      
      <div class="row">
      <div class="col-sm-auto " style="padding:4px;">
        
        <button type="button" class="btn btn-danger btn-sm px-2 button">
          <a href="admin_sujet_valider.php?id=<?php echo $result1['id']; ?>"><img src="tick-mark.svg" title="valider le sujet" width="20" height="20"></a>
        </button>
       </div>
        <div class="col-sm-auto " style="padding:4px;">
      <button type="button" class="btn btn-danger btn-sm px-2 button">
      <a href="admin_sujet_edit.php?id=<?php echo $result1['id']; ?>"><i class="far fa-lg fa-edit" style="color:black;"></i></a>
        </button>
        </div>
        <div class="col-sm-auto " style="padding:4px;">
        
        <button type="button" class="btn btn-danger btn-sm px-2">
          <a href="admin_sujet_delete.php?id=<?php echo $result1['id']; ?>"><i class="far fa-lg fa-trash-alt" style="color:black;"></i></a></a>
        </button>
       </div>
       </div>
      </td>
    </tr>

<?php
    }
    ?>


</table>

 
  </div>






		<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
						
</body>
</html>