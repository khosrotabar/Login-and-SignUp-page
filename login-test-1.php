<?php 

ini_set("sendmail_from", "info@demositte.ir");
ini_set("SMTP", "mail.demositte.ir");

$conn = new mysqli("88.135.37.78", "demositt", "mohammad19035039", "demositt_test30");

$a = 0;

if($conn->connect_error){
    die("connection failed: " .$conn->connent_error);
}

if(isset($_POST['First-Name']) && !empty($_POST['First-Name']) AND isset($_POST['Last-Name']) && !empty($_POST['Last-Name']) AND isset($_POST['Mobile-Number']) && !empty($_POST['Mobile-Number']) AND isset($_POST['Email']) && !empty($_POST['Email']) AND isset($_POST['Password']) && !empty($_POST['Password'])){
    $firstname = $_POST['First-Name'];
    $lastname = $_POST['Last-Name'];
    $mobilenumber = $_POST['Mobile-Number'];
    $email = $_POST['Email'];
    $password = $_POST['Password'];
    $emailverify = md5( rand(0,1000) );
    $mobileverify = mt_rand(100000, 999999);

    $sql = "SELECT Email FROM loginSample2";
    $result = $conn->query($sql);

    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            if($email == $row["Email"]) {
                setcookie("emailError2", "This email address has been set before! try another one.", time() + 60*15);
                setcookie("creatAccountSuccess", "");
                setcookie("creatAccountFail", "");
                $a = 1;
            }
        }
    }

    if($a == 0){
        $sql = "INSERT INTO loginSample2 (Password, Email, FirstName, LastName, MobileNumber, Emailverification, Mobileverification)
        VALUES ( '$password', '$email', '$firstname' , '$lastname', '$mobilenumber', '$emailverify', '$mobileverify')";
        $conn->query($sql);
    }

    if($a == 0){
        $time = time();
        $to      = $email; // Send email to our user
        $subject = 'Signup | Verification'; // Give the email a subject 
        $message = '
         
        Thanks for signing up!
        Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
        link will be expire after 15 min.
         
        ------------------------
        Username: '.$email.'
        Password: '.$password.'
        ------------------------
         
        Please click this link to activate your account:
        https://demositte.ir/verify-email.php?email='.$email.'&hash='.$emailverify.'&time='.$time.'
         
        '; // Our message above including the link
                             
        $headers = 'From:سایت نمونه<info@demositte.ir>' . "\r\n"; // Set from headers
        
        $msg = "thanks for your submistion. please check your email address to activate your panel.";
        
        setcookie("creatAccountSuccess", $msg, time() + 30);
        setcookie("emailError2", "");
        setcookie("creatAccountFail", "");
        
        mail($to, $subject, $message, $headers); // Send our email
        }   
       }else {
           setcookie("creatAccountFail", "Oops! we are sorry there is a problem in our server. please try later or contact admin. thanks", time() + 60);
           setcookie("creatAccountSuccess", "");
           setcookie("emailError2", "");
       }
    $conn->close();
    header("Location: https://demositte.ir");
    exit;
?>