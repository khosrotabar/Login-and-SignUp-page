<?php 

ini_set("sendmail_from", "info@demositte.ir");
ini_set("SMTP", "mail.demositte.ir");

$conn = new mysqli("88.135.37.78", "demositt", "mohammad19035039", "demositt_test30");

if($conn->connect_error){
    die("connection failed: " .$conn->connent_error);
}

$a = 0;

if(isset($_POST['email-for-change-password']) && !empty($_POST['email-for-change-password'])) {
    $recovery = $_POST['email-for-change-password'];
}

$sql = "SELECT Email, Password FROM loginSample2";
$result = $conn->query($sql);
if($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        if($recovery == $row["Email"]) {
            $password = $row["Password"];

            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= 'From:سایت نمونه<info@demositte.ir>' . "\r\n"; // Set from headers
            $to      = $recovery; // Send email to our user
            $subject = 'Signup | Verification'; // Give the email a subject 
            $message = "
            <html>
               <head>
               <title>HTML email</title>
               </head>
               <body dir='ltr'>
                  <p style='font-size:16px; color:black'>you can change your password from user panel.<br>if you are not send this request please change your password.</p>
                  <br><br>
                  -----------------
                  <p>Username: $recovery</p>
                  <p>Password: $password</p>
                  -----------------
                  <br><br>
                  <a href='https://demositte.ir' style='color: blue; cursor: pointer; font-size: 16px;text-decoration: none'>you can login now</a>
                  <h3 style='color:black;font-weight:bold'>thank you for choosing us<h3>
               </body>
              </html>
            "; // Our message above including the link
            
            mail($to, $subject, $message, $headers); // Send our email

            $msg = "your password has been sent to your email.";
            setcookie("resend_password_msg", $msg, time() + 60*15);
            setcookie("resend_password_msg_fail","");
            $a = 1;
        }
    }
}

if($a == 0) {
    $msg = "this email has not register yet!";
    setcookie("resend_password_msg_fail", $msg, time() + 60*15);
    setcookie("resend_password_msg","");
}

$conn->close();
header("Location: https://demositte.ir");
exit;

?>