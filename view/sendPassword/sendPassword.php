<?php
        //Import PHPMailer classes into the global namespace
        //These must be at the top of your script, not inside a function
        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\SMTP;
        use PHPMailer\PHPMailer\Exception;

        //Load Composer's autoloader
        require 'vendor/autoload.php';

        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = 0; // SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'adnr.consults.infos@gmail.com';                     //SMTP username
            $mail->Password   = 'jhxnuvsyjjtnmpoi';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('adnr.consults.infos@gmail.com', 'ADNR Consults');
            $mail->addAddress(base64_decode($emailFromDb), 'Nom dutilisateur');     //Add a recipient
            //$mail->addAddress('ellen@example.com');               //Name is optional
            /*
            $mail->addReplyTo('info@example.com', 'Information');
            $mail->addCC('cc@example.com');
            $mail->addBCC('bcc@example.com');

            //Attachments
            $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
            */
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Reinitialisez votre mot de passe maintenant';
            $mail->Body    = '<div><b>Bonjour ' . base64_decode($usernameFromDb) . ',<br></b><p>Vous venez juste de effectuer une demande de reinitialisation du mot de passe. Si cest le cas, merci dutiliser ce code pour reinitialiser votre mot de passe.</p></div><h2>Votre code de reinitialisation est : <b>'.$code.'</b><br></h2>';
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            //echo 'Message has been sent';
        } catch (Exception $e) {
            //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

?>