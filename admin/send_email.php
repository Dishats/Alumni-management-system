

<?php
// Include PHPMailer classes manually
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';
require '../PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Create a new instance of PHPMailer
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'dishts25102004@gmail.com';         // Your Gmail address
    $mail->Password = 'zmkq luth tqqu ppkc';           // App password generated earlier
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('dishts25102004@gmail.com', 'PESCE Admin');
    $mail->addAddress('recipient@example.com');           // Add recipient email address

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Your Account has been Verified';
    $mail->Body    = 'Your account has been verified by the college. You can now log in using your credentials. Regards, PESCE';

    // Send email
    $mail->send();
    echo 'Email has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>

