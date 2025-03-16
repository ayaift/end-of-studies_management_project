<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<?php

require("db.php");


//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$nom = mysqli_real_escape_string($link, $_REQUEST['nom']);
$prenom = mysqli_real_escape_string($link, $_REQUEST['prenom']);
$email1 = mysqli_real_escape_string($link, $_REQUEST['email1']);
$email2 = mysqli_real_escape_string($link, $_REQUEST['email2']);
$password1 = mysqli_real_escape_string($link, md5($_REQUEST['password1']));
$password2 = mysqli_real_escape_string($link, md5($_REQUEST['password2']));


$token=md5(rand('10000','99999'));
$status="Inactive";
$register = "INSERT";

if(!empty($_REQUEST['nom']) AND !empty($_REQUEST['prenom']) AND !empty($_REQUEST['email1']) AND !empty($_REQUEST['email2']) AND !empty($_REQUEST['password1']) AND !empty($_REQUEST['password2'])){

if($email1==$email2){
    if(filter_var($email1, FILTER_VALIDATE_EMAIL)) {
   
$select = mysqli_query($link, "SELECT * FROM admin WHERE email = '".$_REQUEST['email1']."'");
if(mysqli_num_rows($select)) {
    $result='<div class="alert alert-danger">Cette adresse email est déjà utilisé</div>';
/*     header("Refresh: 1; URL=http://localhost/inscription.php?result=".urlencode($result)); */
    header("location:/univ-mosta.tech/public_html/inscription.php?result=".urlencode($result));
   // exit('Cette adresse email est déjà utilisé');
}else{

if($password1==$password2){
  
// Prepare an insert statement
$sql = "INSERT INTO admin (nom,prenom,password,email,status,token) VALUES (?,?,?,?,?,?)";

if($stmt = mysqli_prepare($link, $sql)){
    // Bind variables to the prepared statement as parameters
    mysqli_stmt_bind_param($stmt, "ssssss", $nom, $prenom,$password1,$email1,$status,$token);

    // Set parameters

            
   

    // Attempt to execute the prepared statement
    if(mysqli_stmt_execute($stmt)){
        $last_id = mysqli_insert_id($link);
        $url = 'http://'.$_SERVER['SERVER_NAME'].'/univ-mosta.tech/public_html/verify.php?id='.$last_id.'&token='.$token;
    
        $output = '<div> Merci de votre inscription. svp cliquer sur ce lien pour terminer cette inscription
        <br>'.$url.'</div>';$last_id = mysqli_insert_id($link);

             $mail = new PHPMailer;

            //$mail->SMTPDebug = 3;                               // Enable verbose debug output

            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = "toughzawissal@gmail.com";                            // SMTP username
            $mail->Password = 'ohlycbdwkssamzkz';                           // SMTP password
            $mail->SMTPSecure = 'Tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;
            $mail->SMTPOptions = [
                'Tls' => [
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true,
                ]
            ];                                    // TCP port to connect to

            $mail->setFrom("toughzawissal@gmail.com", 'localhost');
            $mail->addAddress($email1, $prenom);     // Add a recipient
            //$mail->addAddress('ellen@example.com');               // Name is optional
            //$mail->addReplyTo('info@example.com', 'Information');
            //$mail->addCC('cc@example.com');
            //$mail->addBCC('bcc@example.com');

            //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
            $mail->isHTML(true);
            
            

                                      // Set email format to HTML

            $mail->Subject = 'Confirmation d\'inscription';
            $mail->Body    = $output;
           // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            if(!$mail->send()) {
                $result='<div class="alert alert-danger">une erreur s\'est produit email n\'a pas été envoyé </div>';
               /*  header("Refresh: 1; URL=http://localhost/inscription.php?result=".urlencode($result)); */
                header("location: /univ-mosta.tech/public_html/inscription.php?result=".urlencode($result));

            } else {

                $result='<div class="alert alert-success">Felisitation , vous pouvez verifier votre mail pour terminer votre inscription </div>';
/*                 header("Refresh: 1; URL=http://localhost/connect.php?result=".urlencode($result)); */
                header("location: /univ-mosta.tech/public_html/connect.php?result=".urlencode($result));
            }



        //$result='<div class="alert alert-success">Un message de confirmation a été envoyé a votre adresse mail </div>';
       // header("Refresh: 1; URL=http://localhost/connect.php?result=".urlencode($result));
        //echo "Records inserted successfully.";


    } else{
        echo "ERROR: Could not execute query: $sql. " . mysqli_error($link);
    }
} else{
    echo "ERROR: Could not prepare query: $sql. " . mysqli_error($link);
}

mysqli_stmt_close($stmt);

}else{
    $result='<div class="alert alert-danger">Vos mots de passes ne correspondent pas !</div>';
/*     header("Refresh: 1; URL=http://localhost/inscription.php?result=".urlencode($result)); */
    header("location: /univ-mosta.tech/public_html/inscription.php?result=".urlencode($result));
    //echo " Vos mots de passes ne correspondent pas !";
        }
    
    }
}else{
    $result='<div class="alert alert-danger">Votre adresse mail n\'est pas valide !</div>';
/*     header("Refresh: 1; URL=http://localhost/inscription.php?result=".urlencode($result)); */
    header("location: /univ-mosta.tech/public_html/inscription.php?result=".urlencode($result));
       // echo "Votre adresse mail n'est pas valide !";
    }
}else{
    $result='<div class="alert alert-danger">Vos mails ne correspondent pas !</div>';
/*     header("Refresh: 1; URL=http://localhost/inscription.php?result=".urlencode($result)); */
    header("location: /univ-mosta.tech/public_html/inscription.php?result=".urlencode($result));
   // echo " Vos mails ne correspondent pas !";
}

}else{
    $result='<div class="alert alert-danger">Tous les champs doivent être complétés !</div>';
/*     header("Refresh: 1; URL=http://localhost/inscription.php?result=".urlencode($result)); */
    header("location: /univ-mosta.tech/public_html/inscription.php?result=".urlencode($result));
   // echo "Tous les champs doivent être complétés !";
}

// Close connection
mysqli_close($link);

?>