<?php

require 'init.php';

if(empty($_SESSION['user']))
{

  header('Location: /index.html');
  exit();
}

$select = mysqli_query($link, "SELECT nom,prenom,id FROM admin WHERE email = '".$_SESSION['user']."' ");
$result = mysqli_fetch_assoc($select) ;       

?>
<?php include 'admin_header.php'; ?>

<body>
<!-- 	<div class="card" style="background-color: #e9ecef;"> -->
	<?php include 'admin_navbar.php'; ?>
<div class="container search">
 <div class="row justify-content-between row align-items-center">
 	<div class="col-sm-4 " style="padding-left: 70px;">
 		<h3> INFORMATIONS </h3>
      </div>

	</div>

	</div>

  <div class="container-fluid body">
<!--    <div class="row"> -->
       

<!-- <div.card class="col-md card"> -->

<!--<table class="table table-light">-->



<div class="row justify-content-center" style="margin-top:40px;">

<div class="col-md-8" >



       <div class="card" style="padding: 15px;" >

                    <div class="card-header">
                        <h4>
                          Informations Générales
                        </h4>
                      </div> 
                  
          

              <div class="card-body" style="padding: 25px;">
             
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-2"><b>NOM</b></h6>
                    </div> 
                    <div><b>DUT Achieve</b>
                    </div>
                  </div>

                  
                  

                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-2"><b>UTILITE DU SITE</h6>
                    </div>
                    <div >Gestion des soutenances 
                    </div>
                  </div>

                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-2"><b>LIEU</b></h6>
                    </div>
                    <div >ESTK-Ecole superieure de technologie
                    </div>
                  </div>
                  

                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-2"><b>CIBLE</b></h6>
                    </div>
                    <div>Etudiants ,enseignants,et administration.
                    </div>
                  </div>
                
              </div>
              
              </div>
                     

  </div>
             
                
</div>




</div>

	</div>
</div>



		<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

</body>
</html>
