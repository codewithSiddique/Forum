<?php
    include '_dbconnect.php';
    $showAlert = false;
    $showError = false;
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];
        $exist = false;
        $existSql = "SELECT * FROM `user` WHERE username = '$username'";
        $result = mysqli_query($con,$existSql);
        $numRows = mysqli_num_rows($result);
        if($numRows > 0){
            $showError = "username already Exist";
        }
        else{
            if($password == $cpassword && $exist == false){
                $hash = password_hash($password,PASSWORD_DEFAULT);
                $sql = "INSERT INTO `user` (`username`, `password`, `DateTime`) VALUES ('$username', '$hash', current_timestamp())";
                $result = mysqli_query($con,$sql);
                if($result){
                    $showAlert = true;
                    header("Location: /forum/?signupsuccess=true");
                }
                else{
                    $showError = "Insert to datbase has been failed" . mysqli_error($con);
                }
            }else{
                $showError = "password do not match";
                header("Location: /forum/?signupsuccess=false");
            }
        }
    }


?>