<?php

require 'init.php';

if(empty($_SESSION['user']))
{

  header('Location: ../index.html');
  exit();
}


$select4 = mysqli_query($link, "SELECT id,filiere_id FROM etudiant WHERE email = '".$_SESSION['user']."'");
$result4 = mysqli_fetch_assoc($select4) ;
$specialite4 = $result4['filiere_id'];

$select = mysqli_query($link, "SELECT * FROM sujet where filiere_id='$specialite4' and etat='validé'");
$searchTerm = "";
if (isset($_GET['search'])) {
    $searchTerm = $_GET['search'];
    header("Location: recherche.php?search=$searchTerm");
    exit();
}
?>

<?php include 'head.php'; ?>
<body>
  
  <?php include 'etudiant_navbar.php'; ?>

<div class="container search">
 <div class="row justify-content-between row align-items-center">
  <div class="col-sm align-center">
    <h3>Liste des pfe</h3>
      </div>
      <div class="col-sm-3">
      <h4 style="color: #ff6c00; -webkit-text-stroke: 0.1px black;"><?php if (isset($_SESSION['msg']) == (null))  {
          
          echo" ";
          
          
          
  
            }
            else{

              
              echo " vous avez choisi ";
              echo $_SESSION['msg'];
              echo " theme ";
              
              
              //$msg = str_replace('-',' ',$msg);
              
              $_SESSION['msg']=null;
            }
            
              ?></h4>
              
    

      </div>

  <div class="col-sm-4">
  
    <form class="d-flex" method="GET">

        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search">
        <button class="btn btn-outline-success" type="submit">Search</button>
        
      </form>
      </div>
  </div>

  </div>


  <div class="container-fluid body">
 
<table class="table table-striped"  style="font-size:14px">
  <caption>Liste des sujets</caption>
  <thead class="thead1">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">TITRE</th>
      <th scope="col"style="width:40%;">RÉSUMÉ</th>
      <th scope="col">SPÉCIALITÉ</th>
      <th scope="col">MOT-CLE</th>
      
       <th scope="col">ENSEIGNANT</th>
       <th scope="col" style="width:7%;">OPTIONS</th>
       <th scope="col"style="width:10%;"> MES CHOIX</th>
    
       
    </tr>
  </thead>
 
  <tbody class="tbody1">


        <tr>
        <?php
        while ($result1 = mysqli_fetch_assoc($select)){
          $select1 = mysqli_query($link, "SELECT id,nom FROM enseignant WHERE id = '".$result1['enseignant_id']."'");
            $result = mysqli_fetch_assoc($select1) ;

            $req = mysqli_query($link,"SELECT * from filiere where id=$result1[filiere_id]");
            $rows=mysqli_fetch_assoc($req);

          ?>
      <th scope="row"> <?php echo $result1['id'];?></th>
      <td> <b><?php echo $result1['titre']; ?></b></td>
      <td> <?php echo $result1['résumé'];?></td>
       <td> <?php echo $rows['nom'];?> </td>
       <td> <?php echo $result1['mot_clé']; ?></td>
      
 

    
    
       <td> <?php echo $result['nom']; ?></td>
    
      <td>
      
      <div class="row">
      <div class="col-sm-auto " style="padding:2px;">
        
        
          <a href="ajouter_choix.php?id=<?php echo $result1['id']; ?>"><button type="button" class="btn btn-success btn-sm px-2"><i class="fas fa-lg fa-plus" aria-hidden="true"></i> Ajouter</button></a>
        

          <?php 
            $select2 = mysqli_query($link, "SELECT id FROM etudiant WHERE email = '".$_SESSION['user']."'");
            $result2 = mysqli_fetch_assoc($select2) ;


          $select3 = mysqli_query($link, "SELECT sujet_id FROM choix WHERE sujet_id = '".$result1['id']."' and etudiant_id = '".$result2['id']."'");
          $result3 = mysqli_fetch_assoc($select3) ;
        

 
          ?>
        
        
           

       </div>


       </div>
      </td>
      
      <td>
        <?php 

          if($result3){

            $message='existe dans mes choix';
          }
          else{
                  $message='';
                }

          ?>

        <h7 style="color:#FF6F61;"><?php echo $message; ?></h7> 



    <?php

      
       
      ?>
      
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