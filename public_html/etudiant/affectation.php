<?php

require 'init.php';

if(empty($_SESSION['user']))
{

  header('Location: ../index.html');
  exit();
}



$select1 = mysqli_query($link, "SELECT id,nom,sujet_id FROM etudiant WHERE email = '".$_SESSION['user']."'");

$result1 = mysqli_fetch_assoc($select1);

$etudiant_id = $result1['id'];
$sujet_id = $result1['sujet_id'];

$select2 = mysqli_query($link, "SELECT * FROM choix WHERE etudiant_id = '$etudiant_id' and priorité=1  ");




/* $sujet_id = $result2['sujet_id']; */

$select = mysqli_query($link, "SELECT id,titre FROM sujet WHERE id = '$sujet_id' ");






?>
<?php include 'head.php'; ?>
<body>
  
  <?php include 'etudiant_navbar.php'; ?>

<div class="container search">
 <div class="row justify-content-between row align-items-center">
 <div class="col-sm-7 box" style="padding-left: 80px;">
    <h3 style="margin-right: 25px;">votre sujet affecté</h3>
      <!--<a href="pdf.php"><button type="submit" name="pdf_report" id="pdf" value="PDF" style="margin-left: 80px;" class="btn btn-warning btn-md px-3"><img src="pencil-square.svg"  title="editer l'tudiant" width="20" height="20"> IMPRIMER VOTRE FICHE
        </button></a> -->
        <form id="data_pdf" method="GET" action="pdf.php" target="_blank">
        <input class="btn btn-success" type="submit" name="report_pdf" id="pdf" value="Imprimer résultat">
        </form>
      </div>



  </div>

  </div>



  <div class="container-fluid body">
 
<table class="table table-striped"  style="font-size:16px">
  <caption>List of PFE</caption>
  <thead class="result"style="color:green">
    <tr>
      <th scope="col" style="width:7%;">Sujet ID</th>
      <th scope="col">TITRE</th>
     <!-- <th scope="col"style="width:40%;">RÉSUMÉ</th>-->
     <!-- <th scope="col">SPÉCIALITÉ</th>-->
     <!-- <th scope="col">MOT-CLE</th>-->
      
       
   <!--     <th scope="col"style="width:10%;"> MES CHOIX</th> -->
    
       
    </tr>
  </thead>
 
  <tbody class="tbody1">


        <tr>
        <?php





        
        if ($result2 = mysqli_fetch_assoc($select2)){

          $result = mysqli_fetch_assoc($select);


          ?>
      <th scope="row"> <?php echo $result['id'];?></th>
      <td> <?php echo $result['titre']; ?></td>
      
 

    
    
   <!--    <td> // echo $result1['nom']; ?></td> -->
    
   <!--   <td>
      
       //echo $result1['id'];?>
      </td>-->
      
   <!--    <td>
       
      
      </td> -->
     
      
     
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