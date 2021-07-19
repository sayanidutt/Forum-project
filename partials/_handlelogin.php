<?php

if(isset($_POST['submit'])){
    include 'dbconnect.php';
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = "select * from usersforum where user_email='$email'";
    $result = mysqli_query($conn,$sql);
    $numrows = mysqli_num_rows($result);

    if($numrows==1){
        $row = mysqli_fetch_assoc($result);
        if(password_verify($password,$row['user_pass'])){
            session_start();
            $_SESSION['loggedin']= true;
            $_SESSION['useremail'] = $email;
            $_SESSION['sno'] = $row['sno'];
            //echo "logged in: ".$email;
            header("Location: /forum/index.php");
        }
    }
    header("Location: /forum/index.php");
}

?>