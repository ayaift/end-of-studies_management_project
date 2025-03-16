<?php
require 'init.php';

$email = mysqli_real_escape_string($link, $_REQUEST['email']);
$password = mysqli_real_escape_string($link, md5($_REQUEST['password']));

if(!empty($_REQUEST['email']) AND !empty($_REQUEST['password'])){

    $select = mysqli_query($link, "SELECT * FROM etudiant WHERE email = '".$email."' AND status='ACTIVE'");
    $result = mysqli_fetch_assoc($select) ;
    if(mysqli_num_rows($select)) {

        $select = mysqli_query($link, "SELECT * FROM etudiant WHERE password = '".$password."'");
             if(mysqli_num_rows($select)) {
                
                $_SESSION['user'] = $email;
                $_SESSION['id'] = $result['id'];

                
                
                header("Location: etudiant_sujet.php");                                                                                                        
               

                 }else{
                    $result='<div class="alert alert-danger">mot de passe incorrect !</div>';
/*                     header("Refresh: 1; URL=http://localhost/etudiant/connect.php?result=".urlencode($result)); */
                    header("location: /univ-mosta.tech/public_html/etudiant/connect.php?result=".urlencode($result));
                   // echo "password incorrect !";
                    
                }
    }else{
                $result='<div class="alert alert-danger">adresse mail incorrect !</div>';
                header("location: /univ-mosta.tech/public_html/etudiant/connect.php?result=".urlencode($result));
            //echo "adresse mail incorrect !";
         }
        }
else{
    $result='<div class="alert alert-danger">il faut remplir tous les champs !</div>';
    header("location:/univ-mosta.tech/public_html /etudiant/connect.php?result=".urlencode($result));
    //echo"il faut remplir tous les champs !";
}


?>


