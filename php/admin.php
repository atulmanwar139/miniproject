<?php
    session_destroy();
    session_start();
    if(isset($_REQUEST['Submit']))
    {
        $Name = $_POST ['Name']; 
        $_SESSION['Name'] = $Name;
        $Department = $_POST['Staff_Department']; 
        $_SESSION['Department'] = $Department;
        $Year = $_POST['Year']; 
        $_SESSION['Year'] = $Year;
        $Sem= $_POST ['Sem'];
        $_SESSION['Sem'] = $Sem;
        $SubjectName = $_POST['Subject_Name']; 
        $_SESSION['Subject_Name'] = $SubjectName;
        $CAY = $_POST['Academic_Year']; 
        $_SESSION['CAY'] = $CAY;
        $TopicName = $_POST['TopicName'];
        $_SESSION['TopicName'] = $TopicName;
        $Deadline = $_POST['deadline'];
        $_SESSION['Deadline'] = $Deadline;

        $conn = mysqli_connect("localhost", "root", "");
        $db = mysqli_select_db($conn, "ip_project");
        $query = "INSERT INTO staff (Name,Department,Year,Sem,Subject_Name,CAY)
        VALUES ('$Name','$Department','$Year','$Sem','$SubjectName','$CAY');";

        if(!mysqli_query($conn, $query))
        {
                echo "Not Inserted";
        }
        else 
        {
            echo "Inserted";
        }


    }

    mysqli_close($conn);

    header("Location: ../php/material.php");
?> 