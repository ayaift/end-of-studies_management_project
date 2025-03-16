<?php

require 'init.php';

if(empty($_SESSION['user']))
{

  header('Location:index.html');
  exit();
}



$select = mysqli_query($link, "SELECT * FROM filiere ");



?>

<?php include 'admin_header.php'; ?>
<body>
	
  <?php include 'admin_navbar.php'; ?>

<div class="container search">
 <div class="row justify-content-between row align-items-center">
 	<div class="col-sm align-center">
 		<h3>Liste des filieres</h3>

<a href="admin_ajouter_filiere.php"><button type="button" class="btn btn-success btn-md px-3" style="background-color: blue;">ajouter filiere
        </button></a>
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
               
               echo '<div class="alert alert-success">filiere ajouter </div>';
              }
               if ($result==2) {
               
               echo '<div class="alert alert-success">filiere modifier </div>';
              }

                }  ?>  
              </div>


  <div class="container-fluid body">
 
<table class="table table-striped"  style="font-size:14px; width: 1000px; " >
  <caption>Liste des filieres</caption>
  <thead class="thead1">
    <tr>
      <th scope="col">ID</th>
      <th scope="col" style="width: 500px;">NOM</th>
       <th scope="col" style="width:15%;">OPTIONS</th>
       
    </tr>
  </thead>
 
  <tbody class="tbody1">


        <tr>
        <?php
        while ($result1 = mysqli_fetch_assoc($select)){

          ?>
      <th scope="row"> <?php echo $result1['id'];?></th>
      <td> <b><?php echo $result1['nom']; ?></b></td>


    
      <td>
      
      <div class="row">
     
        <div class="col-sm-auto " style="padding:4px;">
      <button type="button" class="btn btn-danger btn-sm px-2 button" style="margin-left: 15px;">
      <a href="admin_filiere_edit.php?id=<?php echo $result1['id']; ?>"><i class="far fa-lg fa-edit" style="color:black;"></i></a>
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