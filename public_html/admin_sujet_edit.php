<?php

require 'init.php';
$id = $_GET['id'];

if(empty($_SESSION['user']))
{

  header('Location:index.html');
  exit();

}

// get id through query string

$select = mysqli_query($link,"select * from sujet where id='$id'"); // select query

$data = mysqli_fetch_assoc($select);

if(isset($_POST['update'])) // when click on Update button
{
    $titre = mysqli_real_escape_string($link,$_POST['titre']);
    $resume = mysqli_real_escape_string($link,$_POST['résumé']);
    $mot_cle = mysqli_real_escape_string($link,$_POST['mot_clé']);
    $specialite  = mysqli_real_escape_string($link,$_POST['spécialité']);
    $etat  = mysqli_real_escape_string($link,$_POST['etat']);

    
   $edit = mysqli_query($link, "UPDATE sujet SET titre='$titre', résumé='$resume', mot_clé='$mot_cle', etat='$etat', filiere_id='$specialite' WHERE id='$id'");
    
    if($edit)
    {
        mysqli_close($link); // Close connection
        header("Location:admin_panel.php?result=1"); // redirects to all records page
        exit;
    }
    else
    {
        echo mysqli_error($link);
    }        
}


?>
<?php include 'admin_header.php'; ?>
<body class="admin_body">
    
<?php include 'admin_navbar.php'; ?>

<div class="container search">
 <div class="row justify-content-between row align-items-center">




    </div>


    <div class="container admin_form">       

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                <div class="card" style="padding: 15px;">
                    <div class="card-header" >
                        <h4>
                          modifier paramettre sujet
                        </h4>
                      </div> 
                   
                    <div class="card-body">
                      <form method="post" action="">

              <div class="form-group">
            <label for="inputAddress">Titre</label>
              <input type="text" class="form-control" name="titre" value="<?php echo $data['titre'] ?>" placeholder="titre">
            </div>
            <div class="form-group">
              <label for="exampleInputclassement">Résumé</label>
              <textarea class="form-control" name="résumé" rows="7" placeholder="resume"> <?php echo $data['résumé'] ?></textarea>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Spécialité</label>
                       <select  class="form-select" name="spécialité"  >

     
          <?php 
             $sql =" SELECT * from filiere ";
       $exec1 = mysqli_query($link,$sql);
       while($rows=mysqli_fetch_assoc($exec1)){
        if ($data['filiere_id'] == $rows['id']) {
          echo "<option value = $rows[id] selected> $rows[nom]</option>";
        }else{
          echo "<option value = $rows[id] > $rows[nom]</option>";
        }
        
       }
          ?>
          </select>
            </div>

            <div class="form-group">
              <label for="exampleInputspecialite">Mot-Clé</label>
              <input type="text" class="form-control" name="mot_clé" value="<?php echo $data['mot_clé'] ?>" placeholder="mot-cle">
            </div>

            <div class="form-group">
              <label for="exampleInputclassement">etat</label>
              <input type="text" class="form-control" name="etat" value="<?php echo $data['etat'] ?>" placeholder="etat">
            </div>
          
              <div class="d-flex justify-content-end ">
            
             <button type="submit" name="update" value="update" class="btn btn-primary m-4 "> <img src="person-plus.svg" alt="update" width="32" height="25"> modifier </button>
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
