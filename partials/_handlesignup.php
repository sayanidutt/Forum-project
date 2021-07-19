<?php

$showerror = false;
if(isset($_POST['submit'])){

    include 'dbconnect.php';

    $user_name = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $existssql = "select * from usersforum where user_email='$user_name'";
    $result = mysqli_query($conn,$existssql);
    $numRows = mysqli_num_rows($result);
    if($numRows>0){
        echo "User already exists";
    }
    else{
        if($password == $cpassword){
            $hash = password_hash($password,PASSWORD_DEFAULT);
            $sql = "INSERT INTO `usersforum` (`user_email`, `user_pass`, `timestamp`) 
            VALUES ('$user_name', '$hash', current_timestamp())";
            $result = mysqli_query($conn,$sql);

            if($result){
                $showalert = true;
                header("Location: /forum/index.php?signupsuccess=true");
                exit();
            }
        }
        else{
            $showerror = "Passwords do not match";
            //echo $showerror;
        }
    }
    header("Location: /forum/index.php?signupsuccess=false&error=$showError");

}

?>