<?php
require 'init.php';
require("db.php");


//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';


$email = mysqli_real_escape_string($link, $_REQUEST['email']);
$message = mysqli_real_escape_string($link, $_REQUEST['message']);
$result = "";

if(!empty($_REQUEST['email']) AND !empty($_REQUEST['message'])){
    if(filter_var($email, FILTER_VALIDATE_EMAIL)) {

             $mail = new PHPMailer;

            $mail->SMTPDebug = 3;                               // Enable verbose debug output

            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = "toughzawissal@gmail.com";                            // SMTP username
            $mail->Password = 'ohlycbdwkssamzkz';                           // SMTP password
            $mail->SMTPSecure = 'Tls';                            // Enable TLS encryption, `Tls` also accepted
            $mail->Port = 587;
            $mail->SMTPOptions = [
                'Tls' => [
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true,
                ]
            ];                                    // TCP port to connect to

            $mail->setFrom($email);
            $mail->addAddress("toughzawissal@gmail.com");     // Add a recipient
            //$mail->addAddress('ellen@example.com');               // Name is optional
            //$mail->addReplyTo('info@example.com', 'Information');
            //$mail->addCC('cc@example.com');
            //$mail->addBCC('bcc@example.com');

            //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
            $mail->isHTML(true);
            
            

                                      // Set email format to HTML

            $mail->Subject = 'message d\'apres visiteur';
            $mail->Body    = $message;
           // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            if(!$mail->send()) {
                $result='<div class="alert alert-danger">une erreur s\'est produit email n\'a pas été envoyé </div>';
                header("location: /univ-mosta.tech/public_html/contact.php?result=".urlencode($result));
            } else {

                $result='<div class="alert alert-success"> merci de votre message  </div>';
                header("location:/univ-mosta.tech/public_html/contact.php?result=".urlencode($result));
            }








    }else{
        
        $result='<div class="alert alert-danger">Votre adresse mail n\'est pas valide !</div>';
        header("location: /univ-mosta.tech/public_html/contact.php?result=".urlencode($result));
    //echo "adresse mail incorrect !";



    }
      
}else{
                $result='<div class="alert alert-danger">il faut remplir tous les champs !</div>';
                header("location: /univ-mosta.tech/public_html/contact.php?result=".urlencode($result));
                //echo"il faut remplir tous les champs !";
            }

mysqli_close($link);
?>