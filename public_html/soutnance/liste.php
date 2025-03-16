
<?php

require '../init.php';

if(empty($_SESSION['user']))
{

  header('Location:../index.html');
  exit();
}



$select = mysqli_query($link, "SELECT * FROM events order by start_event asc");



?>

<!DOCTYPE html>
<html>
 <head>
  <title>Soutnance</title>
    <link rel="stylesheet" type="text/css" href="../style.css">
    <link rel="stylesheet" type="text/css" href="../admin.css">
    <link rel="stylesheet" type="text/css" href="../css1/bootstrap.min.css">

  <script src="../js/bootstrap.min.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-growl/1.0.0/jquery.bootstrap-growl.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="https://kit.fontawesome.com/0c03620f7c.js" crossorigin="anonymous"></script>

 </head>
<body>

<div class="container search">
 <div class="row justify-content-between row align-items-center">
 	<div class="col-sm align-center">
 		<h3>Liste des soutnances</h3>
      </div>

	<div class="col-sm-4">

    <button type="button"><a href="../admin_soutnance.php" style="text-decoration: none;">retour</a></button>
      </div>
	</div>

	</div>



  <div class="container-fluid body">
 
<table class="table table-striped"  style="font-size:14px">
  <caption>Liste soutnance</caption>
  <thead class="thead1">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">TITRE</th>
  
      <th scope="col">date</th>
       <th scope="col" style="width:10%;">OPTIONS</th>
       
    </tr>
  </thead>
 
  <tbody class="tbody1">


        <tr>
        <?php
        while ($result1 = mysqli_fetch_assoc($select)){


          ?>
      <th scope="row"> <?php echo $result1['id'];?></th>
      <td> <b><?php echo $result1['title']; ?></b></td>
      <td> <?php echo $result1['start_event'];?></td>
    
      <td>
      
      <div class="row">
        <div class="col-sm-auto " style="padding:2px;">
      <button type="button" class="btn btn-secondary btn-sm px-2">
      <a href="../admin_soutnance_edit.php?id=<?php echo $result1['id']; ?>"><img src="../pencil-square.svg"  title="editer le sujet" width="20" height="20"></a>
        </button>
        </div>
        <div class="col-sm-auto " style="padding:2px;">
        
        <button type="button" class="btn btn-danger btn-sm px-2">
          <a href="../admin_soutnance_delete.php?id=<?php echo $result1['id']; ?>"><img src="../trash.svg" title="supprimer le sujet" width="20" height="20"></a>
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