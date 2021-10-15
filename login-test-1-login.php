<?php 

ini_set("sendmail_from", "info@demositte.ir");
ini_set("SMTP", "mail.demositte.ir");

$conn = new mysqli("88.135.37.78", "demositt", "mohammad19035039", "demositt_test30");

if($conn->connect_error){
    die("connection failed: " .$conn->connent_error);
}

if(isset($_POST['User-Name']) && !empty($_POST['User-Name']) AND isset($_POST['Password']) && !empty($_POST['Password'])){
    $email = $_POST['User-Name'];
    $password = $_POST['Password'];

    $sql = "SELECT * FROM loginSample2";
    $result = $conn->query($sql);

    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            if($email == $row["Email"] && $password == $row["Password"] && $row["Active"] == 1) {
                setcookie("FirstName", $row["FirstName"], time() + 60*15);
                setcookie("LastName", $row["LastName"], time() + 60*15);
                setcookie("NationalCode", $row["NationalCode"], time() + 60*15);
                setcookie("MobileNumber", $row["MobileNumber"], time() + 60*15);
                setcookie("Address", $row["Address"], time() + 60*15);
                setcookie("Email", $row["Email"], time() + 60*15);
                setcookie("Password", $row["Password"], time() + 60*15);
                setcookie("Job", $row["Job"], time() + 60*15);
                setcookie("Birthdate", $row["Birthdate"], time() + 60*15);
                setcookie("Login_Error2", "", time() + 60*15);
                $conn->close();
                header("Location: https://demositte.ir/profile");
                exit;
            }elseif ($email == $row["Email"] && $password == $row["Password"] && $row["Active"] == 0) {
                setcookie("Login_Error2", "your account not yet activated!", time() + 60*15);
            }elseif($email != $row["Email"] || $password != $row["Password"]) {
                setcookie("Login_Error2", "your password or email is wrong!", time() + 60*15);
            }
        }
    }else {
            setcookie("Login_Error2", "Oops! there is a error in database.", time() + 60*15);
            $conn->close();
            header("Location: https://demositte.ir");
            exit;
    }
 }

 $conn->close();
 header("Location: https://demositte.ir");
 exit;
?>