
<?php

require 'init.php';

if(empty($_SESSION['user']))
{

  header('Location:../index.html');
  exit();
}



$select = mysqli_query($link, "SELECT * FROM events order by start_event asc ");


include("head.php");
?>


<body>
<?php 
include("prof_navbar.php");
?>

<div class="container search">
 <div class="row justify-content-between row align-items-center">
 	<div class="col-sm align-center">
 		<h3>Liste des soutnances</h3>
      </div>


	</div>

	</div>



  <div class="container-fluid body">
 
<table class="table table-striped"  style="font-size:14px">
  <caption>Liste soutnance</caption>
  <thead class="thead1">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">TITRE</th>
  
      <th scope="col">date</th>
       
       
    </tr>
  </thead>
 
  <tbody class="tbody1">


        <tr>
        <?php
        while ($result1 = mysqli_fetch_assoc($select)){


          ?>
      <th scope="row"> <?php echo $result1['id'];?></th>
      <td> <b><?php echo $result1['title']; ?></b></td>
      <td> <?php echo $result1['start_event'];?></td>
    
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