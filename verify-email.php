<?php 

ini_set("sendmail_from", "info@demositte.ir");
ini_set("SMTP", "mail.demositte.ir");

$conn = new mysqli("88.135.37.78", "demositt", "mohammad19035039", "demositt_test30");

$a = 0;

if($conn->connect_error){
    die("connection failed: " .$conn->connent_error);
}

if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash']) AND isset($_GET['time']) && !empty($_GET['time'])){
    // Verify data
    $email = $_GET['email']; // Set email variable
    $emailverify =  $_GET['hash']; // Set hash variable
    $u_time = $_GET['time'];
    $cur_time = time();
    $sql = "SELECT Email, Emailverification, Active FROM loginSample2 WHERE Email='".$email."' AND Emailverification='".$emailverify."' AND Active='0'";
    $result = $conn->query($sql);
    $match = $result->num_rows ;
    
    if($match > 0 && $cur_time - $u_time < 120){
        $sql = "UPDATE loginSample2 SET Active='1' WHERE Email='".$email."' AND Emailverification='".$emailverify."' AND Active='0'";
        $conn->query($sql);
        $msg = "Your account has been activated. you can login now";
        setcookie("verify_msg", $msg, time() + 60*15);
    }elseif($match == 0){
        $msg = "The url is either invalid or you already have activated your account.";
        setcookie("verify_msg", $msg, time() + 60*15);
    }elseif($match > 0 && $cur_time - $u_time > 120) {
                $msg = "The url has been expired. new verification is sent to your mail.";
                setcookie("verify_msg", $msg, time() + 60*15);
                $time = time();
                
                $to      = $email; // Send email to our user
                $subject = 'Signup | Verification'; // Give the email a subject 
                $message = '
                 
                this link is sent by website robot. please do not reply to it.
                 
                click on this link to verify your account:
                https://demositte.ir/verify-email.php?email='.$email.'&hash='.$emailverify.'&time='.$time.'
                 
                '; // Our message above including the link
                                     
                $headers = 'From:سایت نمونه<info@demositte.ir>' . "\r\n"; // Set from headers
                
                mail($to, $subject, $message, $headers); // Send our email
    }
}else{
    $msg = "Invalid approach, please use the link that has been send to your email.";
    setcookie("verify_msg", $msg, time() + 60*15);
}

$conn->close();
setCookie("creatAccountSuccess", "");
header("Location: https://demositte.ir");
exit;
?>