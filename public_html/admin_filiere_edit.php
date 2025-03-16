<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<?php

require 'init.php';
$id = $_GET['id'];

if(empty($_SESSION['user']))
{

  header('Location: ../index.html');
  exit();

}

// get id through query string

$select = mysqli_query($link,"select * from filiere where id='$id'"); // select query

$data = mysqli_fetch_assoc($select);

if(isset($_POST['update'])) // when click on Update button
{
    $nom = $_POST['nom'];

 

$stmt = $link->prepare("UPDATE filiere SET nom=? WHERE id=?");
$stmt->bind_param("si", $nom,$id);

if ($stmt->execute()) {
    mysqli_close($link);
    header("location:admin_liste_filiere.php?result=2");
    exit;
} else {
    echo $stmt->error;
}

$stmt->close();  	 
}


?>
<?php include 'admin_header.php'; ?>
<body class="admin_body">
	
<?php include 'admin_navbar.php'; ?>
 <div class="container admin_form">      
    

      </div> 
<div class="container search">
 <div class="row justify-content-between row align-items-center">




	</div>


   

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                <div class="card" style="padding: 15px;">
                    <div class="card-header" >
                        <h4>
                          modifier filiere
                        </h4>
                      </div> 
                   
                    <div class="card-body">
                      <form method="post">

              <div class="form-group">
            <label for="inputAddress">Nom</label>
              <input type="text" class="form-control" name="nom" value="<?php echo $data['nom'] ?>" placeholder="nom">
            </div>
           

          
              <div class="d-flex justify-content-end ">
            
             <button type="submit" name="update" value="Update" class="btn btn-primary m-4 "> <i class="fas fa-lg fa-plus"></i>   Editer </button>
           </div>
          </form>

                   

           
                   

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