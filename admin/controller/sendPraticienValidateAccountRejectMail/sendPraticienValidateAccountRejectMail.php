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
            $mail->SMTPDebug = 0; //SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'adnr.consults.infos@gmail.com';                //SMTP username
            $mail->Password   = 'jhxnuvsyjjtnmpoi';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                   //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('adnr.consults.infos@gmail.com', 'ADNR Consults');
            $mail->addAddress($praticienEmail , 'Nom dutilisateur');     //Add a recipient
            //$mail->addAddress('ellen@example.com');             //Name is optional
            /*
            $mail->addReplyTo('info@example.com', 'Information');
            $mail->addCC('cc@example.com');
            $mail->addBCC('bcc@example.com');
            */
            //Attachments
            //$mail->addAttachment($current_location , $fileName);         //Add attachments
            //$mail->addAttachment($current_location, $fileName,  $encoding = 'base64', $type = 'application/pdf');
            //$mail->addStringAttachment('./view/resultat.php', $pdf);
            //$mail->AddAttachment("./view/resultat.pdf", '', $encoding = 'base64', $type = 'application/pdf');
            //$mail->addAttachment('./view/resultat.php' , 'ordonnance.html');         //Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Rejet de votre compte ADNR Consults';
            $mail->Body    = "Bonjour " . $praticienName . ",<br> <em> !</em><br><em></em><br> <span>Après avoir reetudier votre compte, nous avons pris la decision de refuser votre compte.<br> Si vous n'etes pas d'accord avec cette decision, vous etes prie de prendre contact avec ADNR Consults afin de trouver une solution." . "<br>ADNR Groups vous souhaite une excellente Journée.";

            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            //echo 'Message has been sent';
        } catch (Exception $e) 
        {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

?>