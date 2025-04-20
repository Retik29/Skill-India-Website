<?php
require_once '../auth.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$userdata = getCurrentUser();
$username = htmlspecialchars($userdata['name'] ?? ''); // Fallback to an empty string if null
$useremail = $userdata['email'] ?? ''; // Fallback to an empty string if null
$useremail = filter_var($useremail, FILTER_VALIDATE_EMAIL); // Validate email format


//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require './src/Exception.php';
require './src/PHPMailer.php';
require './src/SMTP.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'example@gmail.com';      //SMTP username
    $mail->Password   = 'password';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('example@gmail.com', 'Skill-india');
    $mail->addAddress("{$useremail}", "{$username}");     //Add a recipient
    // $mail->addAddress('ellen@example.com');               //Name is optional
    $mail->addReplyTo('example@gmail.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content

    $message = "Hello {$username},\n\nYou have successfully loggedIn/Signup to your Skill India account.\n\nIf this wasn't you, please contact support immediately.\n\nBest regards,\nSkill India Team";

    $mail->isHTML(true);          //Set email format to HTML
    $mail->Subject = 'Login/signup - Skill India app'; //
    
    $mail->Body = nl2br($message);
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    // Convert newlines to <br> tags for HTML email
    $mail->send();
    echo 'Message has been sent';
    header("Location: ../index.php");
    exit();
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    header("Location: ../index.php");
    exit();
}
