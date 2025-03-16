<?php

require 'init.php';

if(empty($_SESSION['user']))
{

  header('Location: ../index.html');
  exit();
}

?>
<?php include 'head.php'; ?>

<body class="admin_body">
	
	<?php include 'etudiant_navbar.php'; ?>
    
    <div class="container-fluid body">

    

 <div class="row justify-content-between row align-items-center">

	</div>


    <div class="container admin_form"> 

<div class="d-flex.justify-content-center" style="margin-right:4px;">

<div class="card cardo" style="padding: 15px;">
                    <div class="card-header">
                        <h4>
                          ajouter sujet
                        </h4>
                      </div> 
                   
                    <div class="card-body">

          <form action="prof_add_sujet.php" method="post">
              <div class="form-group">
  <label for="inputAddress">Titre</label>
    <input type="text" class="form-control" name="titre" placeholder="titre" required>
  </div>
    <div class="form-group">
  <label for="inputAddress">Résumé</label>
   <textarea class="form-control" name="resume" placeholder="resume" required ></textarea>
  </div>
   <div class="form-group">
  <label for="inputAddress">Mot-clé</label>
    <input type="text" class="form-control" name="mot_cle" placeholder="mot-cle" required>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Spécialité</label>
    <input type="text" class="form-control" name="specialite" placeholder="specialite" required>
  </div>


    <div class="d-flex justify-content-end ">

   <button type="submit" class="btn btn-primary m-4 "> <img src="person-plus.svg" alt="créer" width="32" height="25"> créer </button>
 </div>
</form>
</div>
</div>
        </div>
      
      
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</div>
</div>
</div>

</body>
</html>