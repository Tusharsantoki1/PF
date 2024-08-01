<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$captcha = $_POST['g-recaptcha-response'];
if(isset($captcha))
{
    $secretKey = getenv('YOUR_RECAPTCHA_SECRET_KEY');
    $ip = $_SERVER['REMOTE_ADDR']; 
    $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$captcha&remote=$ip";
    $fire = file_get_contents($url);
    $data = json_decode($fire);
    //echo "<script>console.log('$fire');</script>";    
    if($data->success==true)
    {
        if(isset($_POST["send"])) 
        {
            $gmail = getenv('YOUR_GMAIL_USERNAME');
            $appPassword = getenv('YOUR_GMAIL_APP_PASSWORD');
            $oname = getenv('YOUR_NAME');
            
            $fname = isset($_POST['fname']) ? htmlspecialchars(trim($_POST['fname'])) : '';
            $lname = isset($_POST['lname']) ? htmlspecialchars(trim($_POST['lname'])) : '';
            $email = isset($_POST['email']) ? filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL) : '';
            $subject = isset($_POST['subject']) ? htmlspecialchars(trim($_POST['subject'])) : '';
            $message = isset($_POST['message']) ? htmlspecialchars(trim($_POST['message'])) : '';

            if(!filter_var($email, FILTER_VALIDATE_EMAIL)) 
            {
                echo "<script>alert('Invalid Email');</script>";
                echo "<script>window.history.back();</script>";
            }

            $messageBody = "Sender's Email: $email<br>";
            $messageBody .= "Message:<br>$message<br>";

            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = $gmail;
            $mail->Password = $appPassword;
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            $mail->setFrom($email, "$fname $lname");
            $mail->addAddress($gmail);
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $messageBody;

            try {
                $mail->send();
            } catch (Exception $e) {
                echo "<script>alert('Failed to send the email. Please try again later.');</script>";
                echo "<script>window.history.back();</script>";
            }

            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = $gmail;
            $mail->Password = $appPassword;
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            $mail->setFrom($gmail, $oname);
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = "Acknowledgement of Your Message";
            $mail->Body = "Thank you for reaching out. 
            Your message has been received, and I will make every effort to respond promptly. 
            I appreciate your patience and look forward to connecting with you shortly.";

            try {
                $mail->send();
                echo "<script>alert('Sent Successfully');</script>";
                echo "<script>window.history.back();</script>";
            } catch (Exception $e) {
                echo "<script>alert('Failed to send the email. Please try again later.');</script>";
                echo "<script>window.history.back();</script>";
            }
        }
        else
        {
            echo "<script>alert('Form submission failed!');</script>";
            echo "<script>window.history.back();</script>";
        }
    }
    else
    {
        echo "<script>alert('Please verify that you are not a robot.');</script>";
        echo "<script>window.history.back();</script>";
    }
}

else
{
    echo "<script>alert('Recaptcha Error');</script>";
    echo "<script>window.history.back();</script>";
}
?>
