<nav class="navbar navbar-expand-lg navbar-light navbar" style="font-size:17px">
  <div class="container">
  	<img src="img/logo.png" alt="" width="30" height="30">
    <a class="navbar-brand" href="admin_panel.php">DUT Achieve</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="admin_panel.php"> <i class="fas fa-lg fa-book"></i> Les soutenances </a>
        </li>
          <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="admin_soutnance.php"> <i class="fas fa-lg fa fa-calendar"></i> Calendrier </a>
        </li>
          <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="admin_liste_filiere.php"> <i class="fas fa-lg fa fa-list"></i> Filière </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="admin_enseignant.php"> <i class="fas fa-lg fa-chalkboard-teacher"></i> les enseignants</a>

        </li>


					       <li class="dropdown">


							<a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fas fa-lg fa-sort-amount-up-alt"></i> classement</a>

         	<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
    <?php
    $sql = "SELECT * FROM filiere";
    $exec1 = mysqli_query($link, $sql);
    while ($row = mysqli_fetch_assoc($exec1)) {
        echo '<li><a class="dropdown-item" href="classement.php?id=' . $row['id'] . '"><i class="fas fa-lg fa-network-wired"></i> ' . $row['nom'] . '</a></li>';
    }
    ?>
   
</ul>

					      </li>


<!--             <li class="nav-item">
          <a class="nav-link" href="classement.php"> <i class="fas fa-lg fa-sort-amount-up-alt"></i> classement</a>

           </li> -->

       <li class="nav-item">
          <a class="nav-link" href="admin_etudiant.php"><i class="fas fa-lg fa-user-graduate"></i>  les etudiants</a>
        </li>

      </ul>
        <ul class="nav navbar-nav flex-fill justify-content-end">
           <li class="dropdown left">


              <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                   <img src="gear.svg" alt="créer" width="23" height="20">
                   </a>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">

              <li><a class="dropdown-item" href="admin_profil.php"> <i class="fas fa-lg fa-info-circle"></i> information génerales</a></li>
            </ul>
                </li>

                    <li class="nav-item">
                       <a class="nav-link" href="deconnexion.php"> <img src="box-arrow-left.svg" alt="créer" width="25" height="25">  Quitter </a>

                     </li>
                   </ul>
      
    </div>
  </div>



</nav>