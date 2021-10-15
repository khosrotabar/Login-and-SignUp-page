<?php 

$conn = new mysqli("88.135.37.78", "demositt", "mohammad19035039", "demositt_test30");

if($conn->connect_error){
    die("connection failed: " .$conn->connent_error);
}

$email = $_COOKIE["Email"];
$a = 0;
    
    if(isset($_POST['First-Name']) AND !empty($_POST['First-Name'])) {
        $firstname = $_POST['First-Name'];
        $sql = "UPDATE loginSample2 SET FirstName='".$firstname."'  WHERE Email='".$email."'";
        $conn->query($sql);
        $a++;
    }

    if(isset($_POST['Last-Name']) AND !empty($_POST['Last-Name'])) {
        $lastname = $_POST['Last-Name'];
        $sql = "UPDATE loginSample2 SET LastName='".$lastname."'  WHERE Email='".$email."'";
        $conn->query($sql);
        $a++;
    }

    if(isset($_POST['Password']) AND !empty($_POST['Password'])) {
        $password = $_POST['Password'];
        $sql = "UPDATE loginSample2 SET Password='".$password."'  WHERE Email='".$email."'";
        $conn->query($sql);
        $a++;
    }
    if(isset($_POST['National-Code']) AND !empty($_POST['National-Code'])) {
        $nationalcode = $_POST['National-Code'];
        $sql = "UPDATE loginSample2 SET NationalCode='".$nationalcode."'  WHERE Email='".$email."'";
        $conn->query($sql);
        $a++;
    }

    if(isset($_POST['Mobile-Number']) AND !empty($_POST['Mobile-Number'])) {
        $mobilenumber = $_POST['Mobile-Number'];
        $sql = "UPDATE loginSample2 SET MobileNumber='".$mobilenumber."'  WHERE Email='".$email."'";
        $conn->query($sql);
        $a++;
    }

    if(isset($_POST['Job']) AND !empty($_POST['Job'])) {
        $job = $_POST['Job'];
        $sql = "UPDATE loginSample2 SET Job='".$job."'  WHERE Email='".$email."'";
        $conn->query($sql);
        $a++;
    }

    if(isset($_POST['Address']) AND !empty($_POST['Address'])) {
        $address = $_POST['Address'];
        $sql = "UPDATE loginSample2 SET Address='".$address."'  WHERE Email='".$email."'";
        $conn->query($sql);
        $a++;
    }

    if(isset($_POST['Birthday']) AND !empty($_POST['Birthday'])) {
        $birthday = $_POST['Birthday'];
        $sql = "UPDATE loginSample2 SET Birthdate='".$birthday."'  WHERE Email='".$email."'";
        $conn->query($sql);
        $a++;
    }

    $sql = "SELECT * FROM loginSample2";
    $result = $conn->query($sql);
    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            setcookie("FirstName", $row["FirstName"], time() + 60*15);
            setcookie("LastName", $row["LastName"], time() + 60*15);
            setcookie("NationalCode", $row["NationalCode"], time() + 60*15);
            setcookie("MobileNumber", $row["MobileNumber"], time() + 60*15);
            setcookie("Address", $row["Address"], time() + 60*15);
            setcookie("Password", $row["Password"], time() + 60*15);
            setcookie("Job", $row["Job"], time() + 60*15);
            setcookie("Birthdate", $row["Birthdate"], time() + 60*15);
        }
    }

    if($a == 0) {
        $msg = "Error accured!";
        setcookie("fail_msg",$msg);
    }else {
        $msg = "your information saved!";
        setcookie("success_msg", $msg);
    }

$conn->close();
header("Location: https://demositte.ir/profile");
exit;


















?>