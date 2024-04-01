<?php
$login = false;
$showerror = false;

if($_SERVER["REQUEST_METHOD"] == "POST"){
    include "_dbconnect.php";
    $username = $_POST["username"];
    $password = $_POST["password"];
    
    // Query to fetch user with the given username
    $sql = "SELECT * FROM `user` WHERE username = '$username'";
    $result = mysqli_query($con, $sql);
    $num = mysqli_num_rows($result);
    
    if($num == 1){
        // Fetching the user row
        $row = mysqli_fetch_assoc($result);  
        if(password_verify($password, $row['password'])){
            $login = true;
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['user_Id'] = $row['user_Id'];
            $_SESSION['username'] = $username;
           // echo "Login successful. Welcome, $username";
           header("Location: /forum/index.php");
           exit();
        }else{
            $showerror = "password do not match";
        }
           
    }
    header("Location: /forum/index.php?loginsuccess=false");
}

?>
