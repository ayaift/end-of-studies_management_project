<?php

require 'init.php';
$result = '';

if(empty($_SESSION['user']))
{

  header('Location: ../index.html');
  exit();
}



$select = mysqli_query($link, "SELECT * FROM sujet ");
$result = mysqli_fetch_assoc($select);
$select2 = mysqli_query($link, "SELECT nom,id FROM etudiant WHERE  email = '".$_SESSION['user']."'");
$result2 = mysqli_fetch_assoc($select2) ;
$select3 = mysqli_query($link, "SELECT sujet_id FROM choix WHERE etudiant_id = '".$result2['id']."'");



?>

<?php include 'head.php'; ?>
<script>    
    if(typeof window.history.pushState == 'function') {
        window.history.pushState({}, "Hide", '<?php echo $_SERVER['PHP_SELF'];?>');
    }
</script>

<body>
	
  <?php include 'etudiant_navbar.php'; ?>

<div class="container search">
 <div class="row justify-content-between row align-items-center">
 	<div class="col-sm align-center">
 		<h3>Liste des pfe</h3>
      </div>

      <script type="text/javascript">

$(document).ready(function () {
 
window.setTimeout(function() {
    $(".alert").fadeTo(700, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 1500);
 
});
</script> 

        <div class="col-6 mx-auto"  >
        <?php if (isset($_GET['result'])!=(null))  {
          $result=$_GET['result'];
          

          echo' <div class="alert alert-success alert-dismissible fade show" role="alert" style="padding-top: 13px;padding-bottom: 13px; margin-top: 15px; background-color: #14bb1e63;
          border-color: #badbcc;">
          <strong>success</strong> priorité affecté . 
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="padding-top: 10px;padding-bottom: 20px;"></button>
        </div>'; 




  
            }  ?>  


      </div>
	<div class="col-sm-4">
 		<form class="d-flex" action="recherche.php">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search">
        <button class="btn btn-outline-success" type="submit">Search</button>
        
      </form>
      </div>
	</div>

	</div>



  <div class="container-fluid body">
 
<form  action="set_priorite.php" method="POST">
<table class="table table-striped"  style="font-size:14px">
  <caption><button type="submit" name="submit" id="submit" value="Submit" class="btn btn-primary m-4 "> ajouter priorites </button></caption>
  
  <thead class="thead1">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">TITRE</th>
      <th scope="col"style="width:40%;">RÉSUMÉ</th>
      <th scope="col">SPÉCIALITÉ</th>
      <th scope="col">MOT-CLE</th>
       <th scope="col">Etudiant</th>
       <th scope="col" style="width:10%;">PRIORITE</th>
       <th scope="col" style="width:10%;">OPTIONS</th>
       
    </tr>
  </thead>
 
  <tbody class="tbody1">


        <tr>
        <?php
       
        while ($result3 = mysqli_fetch_assoc($select3)){
          $select4 = mysqli_query($link, "SELECT * FROM sujet WHERE id = '".$result3['sujet_id']."'");
          $result4 = mysqli_fetch_assoc($select4) ;

            $req = mysqli_query($link,"SELECT * from filiere where id=$result4[filiere_id]");
            $rows=mysqli_fetch_assoc($req);

          $select5 = mysqli_query($link, "SELECT priorité,sujet_id,etudiant_id FROM choix WHERE sujet_id = '".$result4['id']."' and etudiant_id = '".$result2['id']."'");
          

          $result5 = mysqli_fetch_assoc($select5);
          $priorité = $result5['priorité'];
          $sujet_id = $result5['sujet_id'];
          $etudiant_id = $result5['etudiant_id'];

        

          ?>


      <th scope="row"> <?php echo $result4['id'];?></th>
      <td> <b><?php echo $result4['titre']; ?></b></td>
      <td> <?php echo $result4['résumé'];?></td>
       <td> <?php echo $rows['nom'];?> </td>
       <td> <?php echo $result4['mot_clé']; ?></td>

      
    

     
    
       <td> <?php echo $result2['nom']; ?></td>
    
       <td>
      
      <div class="row">
      <div class="col-sm-8 " style="margin-left:0px;">



      <select class="form-select" aria-label="Default select example"  name="priorité[]"  value=<?php echo $priorité; ?> id="priorité" >

      <option selected><?php echo $priorité; ?></option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
      <option value="5">5</option>
      <option value="6">6</option>
      <option value="7">7</option>
      <option value="8">8</option>
      <option value="9">9</option>
      <option value="10">10</option>
      <option value="11">11</option>
      <option value="12">12</option>

      </select>




      <input type="hidden"  class="form-control" name="sujet_id[]" value=<?php echo $sujet_id;?> >
      <input type="hidden"  class="form-control" name="etudiant_id[]" value=<?php echo $etudiant_id;?> >
     
   
       </div>
       </div>
      </td>
      <td>
      
      <a href="etudiant_sujet_delete.php?id=<?php echo $result5['sujet_id']; ?>"><button type="button" class="btn btn-secondary btn-sm px-2"><img src="trash.svg"  title="supprimer" width="20" height="20">retirer</button></a>
          
      </td>
      
    </tr>
    
    <?php
    }
    ?>
  

</table>



  </form>

        
 
  </div>



		<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script type="text/javascript">
$('select').on('change', function() {
  $('option').prop('disabled', false); //reset all the disabled options on every change event
  $('select').each(function() { //loop through all the select elements
    var val = this.value;
    $('select').not(this).find('option').filter(function() { //filter option elements having value as selected option
      return this.value === val;
    }).prop('disabled', true); //disable those option elements
  });
}).change(); //trihgger change handler initially!
</script>



</body>
</html>