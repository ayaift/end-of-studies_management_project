<?php

require 'init.php';
$result = '';

if(empty($_SESSION['user']))
{

  header('Location: ../index.html');
  exit();
}

?>
<?php include 'head.php'; ?>
<script>    
    if(typeof window.history.pushState == 'function') {
        window.history.pushState({}, "Hide", '<?php echo $_SERVER['PHP_SELF'];?>');
    }
</script>

<body class="admin_body">
	
	<?php include 'prof_navbar.php'; ?>
    
    <div class="container-fluid body">


    


    

 <div class="row justify-content-between row align-items-center">

	</div>





    <div class="container admin_form"> 




<div class="d-flex.justify-content-center" style="margin-right:4px;">

<div class="card cardo" style="padding: 15px;">


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
          echo  '<div class="alert alert-danger">ce titre est déjà utilisé </div>';
          }
        if ($result==2) {
           
           echo '<div class="alert alert-success">sujet ajouter </div>';
          }


  
            }  ?>  


      </div>
                    <div class="card-header">
                        <h4>
                          ajouter sujet
                        </h4>
                      </div> 
                   
                    <div class="card-body">

          <form class="was-validated" action="prof_add_sujet.php" method="post">
              <div class="form-group">
  <label for="inputAddress">Titre</label>
    <input type="text" class="form-control" name="titre" placeholder="titre" required>
  </div>
    <div class="form-group">
  <label for="inputAdress">Résumé</label>
   <textarea class="form-control" id="validationTextarea" name="resume" placeholder="resume" required ></textarea>
  </div>
   <div class="form-group">
  <label for="inputAddress">Mot-clé</label>
    <input type="text" class="form-control" name="mot_cle" placeholder="mot-cle" required>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Spécialité</label>
          <select  class="form-select" name="spécialité"  >

                      <?php 
          $sql =" SELECT * from filiere ";
       $exec1 = mysqli_query($link,$sql);
       while($row=mysqli_fetch_assoc($exec1)){
        
        echo "<option value = $row[id] > $row[nom]</option>";
       }
          ?>
          </select>
  </div>


    <div class="d-flex justify-content-end ">

   <button type="submit" class="btn btn-success m-4 "> <i class="fas fa-lg fa-plus"></i> Ajouter </button>
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