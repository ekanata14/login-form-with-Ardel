<?php
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Database connection
    $con = new mysqli("localhost","root","","login_user");
    if($con->connect_error)
    {
        die("Failded to connect : ".$con->connect_error);
    }
    else 
    {
        $stmt = $con->prepare("select * from user_data where username = ?");
        $stmt->bind_param("s",$email);
        $stmt->execute();
        $stmt_result = $stmt->get_result();
        if($stmt_result->num_rows > 0)
        {
            $data = $stmt_result->fetch_assoc();
            if($data['password'] === $password)
            {
                echo file_get_contents("success.html");
            }
            else 
            {
                echo file_get_contents("invalid.html");
            }
        }
        else 
        {
            echo file_get_contents("invalid.html");
        }
    }
?>