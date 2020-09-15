<?php
    session_start();
    $error="";
    if(isset($_POST['Submit']))
    {
        if(empty($_POST['Username']) || empty($_POST['Password']))
        {
            $error = "Username or Password is Empty";
            echo $error;
        }
        else
        {
            $user=$_POST['Username'];
            $pass=$_POST['Password'];
            $conn = mysqli_connect("localhost", "root", "");
            $db = mysqli_select_db($conn, "ip_project");
            $query = mysqli_query($conn, "SELECT * FROM logindetails WHERE password='$pass' AND login='$user'");

            $rows = mysqli_num_rows($query);
            if($rows == 1)
            {
                header("Location: ../html/admin.html"); 
            }
            else
            {
                echo $error = "Invalid Credentials";

            }
            mysqli_close($conn);
        }
        }
?> 