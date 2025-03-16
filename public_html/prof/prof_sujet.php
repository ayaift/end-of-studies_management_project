<?php

require 'init.php';

if(empty($_SESSION['user']))
{

  header('Location:../index.html');
  exit();
}

$select = mysqli_query($link, "SELECT id,nom FROM enseignant WHERE email = '".$_SESSION['user']."' ");

$result = mysqli_fetch_assoc($select) ;

$select = mysqli_query($link, "SELECT * FROM sujet WHERE enseignant_id = '".$_SESSION['id']."'");


if (isset($_GET['search'])) {
    $searchTerm = $_GET['search'];
    header("Location: recherche.php?search=$searchTerm");
    exit();
}
?>
<?php include 'head.php'; ?>

<body>
<!-- 	<div class="card" style="background-color: #e9ecef;"> -->
	<?php include 'prof_navbar.php'; ?>
<div class="container search">
 <div class="row justify-content-between row align-items-center">
 	<div class="col-sm-4 " style="padding-left: 70px;">
 		<h3>Liste des sujets </h3>
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
        if ($result==2) {
           
           echo '<div class="alert alert-success">sujet ajouter </div>';
          }

  
            }  ?>  
          </div>

  <div class="container-fluid body">
<!--    <div class="row"> -->
       

<!-- <div.card class="col-md card"> -->

<!--<table class="table table-light">-->
   

   <table id="myTable"   class="table table-striped"
  data-toggle="table"
  data-mobile-responsive="true"
  data-pagination="true"
  style="font-size:14px"
     data-height="460"
  >
  <caption>Liste des sujets </caption>
  <thead class="thead1">
    <tr>
      <th scope="col"style="width:3%;">ID</th>
      <th scope="col"style="width:15%;">Titre</th>
      <th scope="col" style="width:35%;">Résumé</th>
      <th scope="col"style="width:5%;">Spécialité</th>
      <th scope="col" style="width:10%;">Mot-clé</th>
  
       <th scope="col" style="width:5%;">OPTIONS</th>

    </tr>
  </thead>
  <tbody class="tbody1">


        <tr>
        <?php
        while ($result1 = mysqli_fetch_assoc($select)){
       $req = mysqli_query($link,"SELECT * from filiere where id='$result1[filiere_id]'");

            $rows=mysqli_fetch_assoc($req);
          ?>
      <th scope="row"> <?php echo $result1['id'];?></th>
      <td><strong> <?php echo $result1['titre']; ?></strong></td>
      <td> <?php echo $result1['résumé'];?> </td>
       <td> <?php 

       echo $rows['nom'];?> </td>
       <td> <?php echo $result1['mot_clé']; ?></td>

    
      <td>
      
      <div class="row">

        <div class="col-sm-auto " style="padding:2px;">
      <button type="button" class="btn btn-warning btn-sm px-2 button">
      <a href="prof_sujet_edit.php?id=<?php echo $result1['id']; ?>"><i class="far fa-lg fa-edit" style="color:white;"></i></a>
        </button>
        </div>
        <div class="col-sm-auto " style="padding:2px;">
        
        <button type="button" class="btn btn-danger btn-sm px-2 button">
          <a href="prof_delete_sujet.php?id=<?php echo $result1['id']; ?>"><i class="far fa-lg fa-trash-alt" style="color:white;"></i></a>
        </button>
       </div>
       </div>
      </td>
    </tr>

<?php
    }
    ?>

  </tbody>

</table>





</div>

	</div>
</div>



		<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

</body>
</html>
