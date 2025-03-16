
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

  header('Location:index.html');
  exit();

}

// get id through query string

$select = mysqli_query($link,"select * from events where id='$id'"); // select query

$data = mysqli_fetch_assoc($select);

if(isset($_POST['update'])) // when click on Update button
{
    $title = $_POST['title'];
    $date = $_POST['date'];


	
    $edit = mysqli_query($link,"update events set title='$title', start_event='$date'where id='$id'");
	
    if($edit)
    {
        mysqli_close($link); // Close connection
        // redirects to all records page
           header("location: /univ-mosta.tech/public_html/soutnance/liste.php");
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
 	<div class="col-sm-4 " style="padding-left: 70px;">
 		<h3>profil </h3>
      </div>


	</div>

	</div>


    <div class="container admin_form">       

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                <div class="card" style="padding: 15px;">
                    <div class="card-header" >
                        <h4>
                          modifier 
                        </h4>
                      </div> 
                   
                    <div class="card-body">
                      <form method="post">

              <div class="form-group">
            <label for="inputAddress">titre</label>
              <input type="text" class="form-control" name="title" value="<?php echo $data['title'] ?>" placeholder="titre">
            </div>
            <div class="form-group">
              <label for="exampleInputclassement">date</label>
              <input type="datetime" class="form-control" name="date" value="<?php echo $data['start_event'] ?>" placeholder="date">
            </div>
          

              <div class="d-flex justify-content-end ">
            
             <button type="submit" name="update" value="Update" class="btn btn-primary m-4 "> <img src="person-plus.svg" alt="créer" width="32" height="25"> modifier </button>
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