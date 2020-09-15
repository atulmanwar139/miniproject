<?php 
session_start();
$Subjectname = $_SESSION['Subject_Name'];
$Department = $_SESSION['Department'];
$Year = $_SESSION['Year'];
$Sem = $_SESSION['Sem'];
$CAY  = $_SESSION['CAY'];
$topicname = $_SESSION['TopicName'];
$deadlinetime = $_SESSION['Deadline'];
$deadlinetime = date("Y-m-d H:i:00");

$conn = mysqli_connect('localhost', 'root', '', 'ip_project');

if($conn->connect_error){
  die("Error in DB connection: ".$conn->connect_errno." : ".$conn->connect_error);    
}

if(isset($_POST['AddPDF']))
{

    $totalfiles = count($_FILES['PDF']['name']);

    for($i=0;$i<$totalfiles;$i++){
    $filename = $_FILES['PDF']['name'][$i];

    if(move_uploaded_file($_FILES["PDF"]["tmp_name"][$i],'../upload/pdf/'.$filename))
    {
		$insert = "INSERT into pdfmaterials(topicname,file_name,subject_name,department,year,sem,cay,uploaded_on,status) values('$topicname', '$filename','$Subjectname','$Department','$Year','$Sem','$CAY',now(),1)";
            if(mysqli_query($conn, $insert))
            {
		    }
            else
            {
		        echo 'Error: '.mysqli_error($conn);
		    }
    }
    else
        {
		echo 'Error in uploading file - '.$_FILES['PDF']['name'][$i].'<br/>';
	    }
    }
} 

if(isset($_POST['DeletePDF']))
{

    $path="../upload/pdf";
    $totalfiles =  count($_FILES['PDF']['name']);
   
    for($i=0;$i<$totalfiles;$i++)
    {
        $filename = $_FILES['PDF']['name'][$i];
        $delete = "DELETE FROM `pdfmaterials` WHERE `file_name`= '$filename'";
        if(mysqli_query($conn, $delete))
        {
            unlink($path . "/" . $filename);
        }
        else
        {
            echo 'Error: '.mysqli_error($conn);
        }   
    }
} 

if(isset($_POST['AddPPT']))
{

    $totalfiles = count($_FILES['PPT']['name']);
   
    for($i=0;$i<$totalfiles;$i++){
    $filename = $_FILES['PPT']['name'][$i];
    
    if(move_uploaded_file($_FILES["PPT"]["tmp_name"][$i],'../upload/ppt/'.$filename))
    {
           $insert = "INSERT into pptmaterials(topicname,file_name,subject_name,department,year,sem,cay,uploaded_on,status) values('$topicname', '$filename','$Subjectname','$Department','$Year','$Sem','$CAY',now(),1)";
           if(mysqli_query($conn, $insert))
           {
           }
           else
           {
             echo 'Error: '.mysqli_error($conn);
           }
       }
    else
       {
           echo 'Error in uploading file - '.$_FILES['PPT']['name'][$i].'<br/>';
       }
    }
}

if(isset($_POST['DeletePPT']))
{
    $path="../upload/ppt";
    $totalfiles =  count($_FILES['PPT']['name']);
   
    for($i=0;$i<$totalfiles;$i++)
    {
        $filename = $_FILES['PPT']['name'][$i];
        $delete = "DELETE FROM `pptmaterials` WHERE `file_name`= '$filename'";
        if(mysqli_query($conn, $delete))
        {
            unlink($path . "/" . $filename);
        }
        else
        {
            echo 'Error: '.mysqli_error($conn);
        }   
    }
} 

if(isset($_POST['AddAssignment']))
{
    $totalfiles = count($_FILES['DOCS']['name']);
   
    for($i=0;$i<$totalfiles;$i++)
    {
        $filename = $_FILES['DOCS']['name'][$i];
    
        if(move_uploaded_file($_FILES["DOCS"]["tmp_name"][$i],'../upload/assignments/'.$filename))
        {
            $insert = "INSERT into assignment(topicname,file_name,subject_name,department,year,sem,cay,uploaded_on,deadline_on,status) values('$topicname', '$filename','$Subjectname','$Department','$Year','$Sem','$CAY',now(),'$deadlinetime',1)";
            if(mysqli_query($conn, $insert))
            {
            }
            else
            {
                echo 'Error: '.mysqli_error($conn);
            }
            }
        else
            {
                echo 'Error in uploading file - '.$_FILES['DOCS']['name'][$i].'<br/>';
            }
    }
   }

if(isset($_POST['DeleteAssignment']))
{
    $path="../upload/assignments";
    $totalfiles =  count($_FILES['DOCS']['name']);
    for($i=0;$i<$totalfiles;$i++)
    {
        $filename = $_FILES['DOCS']['name'][$i];
        $delete = "DELETE FROM `assignment` WHERE `file_name`= '$filename'";
        if(mysqli_query($conn, $delete))
        {
               unlink($path . "/" . $filename);
        }
        else
        {
               echo 'Error: '.mysqli_error($conn);
        }   
    }
}

if(isset($_POST['AddQuiz']))
{
    $QuizURL = $_POST['Quiz'];
    $insert = "INSERT into quiz(topicname,URL,subject_name,department,year,sem,cay,uploaded_on,deadline_no,status) values('$topicname','$QuizURL','$Subjectname','$Department','$Year','$Sem','$CAY',now(),'$deadlinetime',1)";
    if(mysqli_query($conn, $insert))
    {
    }
    else
    {
        echo 'Error: '.mysqli_error($conn);
    }
}

if(isset($_POST['DeleteQuiz']))
{
    $QuizURL = $_POST['Quiz'];

    $delete = "DELETE FROM `quiz` WHERE `URL` = '$QuizURL'";
    if(mysqli_query($conn, $delete))
    {
    }
    else
    {
        echo 'Error: '.mysqli_error($conn);
    }
}

if(isset($_POST['AddVideo']))
{
    $VideoURL = $_POST['Video'];
    $insert = "INSERT into video(topicname,URL,subject_name,department,year,sem,cay,uploaded_on,status) values('$topicname','$VideoURL','$Subjectname','$Department','$Year','$Sem','$CAY',now(),1)";
    if(mysqli_query($conn, $insert))
    {
    }
    else
    {
        echo 'Error: '.mysqli_error($conn);
    }
}

if(isset($_POST['DeleteVideo']))
{
    $VideoURL = $_POST['Video'];
    $delete = "DELETE FROM `video` WHERE `URL` = '$VideoURL'";
    if(mysqli_query($conn, $delete))
    {
    }
    else
    {
        echo 'Error: '.mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <title>Staff Management Form</title>
        <link rel="stylesheet" href="../css/add.css">
        <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    </head>
    <body>
        <div class='title'> Material Submission Form</div>
        <div class="container">
            <form id="material" class="material" action="" method="POST" enctype="multipart/form-data">

                <div class="row">
                    <div class="col-25">
                        <label for="PDF_Materials">PDF Materials:</label>
                    </div>
                        <div class="col-75">
                            <input type="file" name="PDF[]" accept=".pdf" id="PDF_Materials" multiple>
                            <button class="Add_Button" name="AddPDF">Add</button>
                            <button name="DeletePDF" class="Delete_Button">Delete</button>
                        </div>
                </div>

                <div class="row">
                    <div class="col-25">
                        <label for="PPT_Materials">PPT Materials:</label>
                    </div>
                        <div class="col-75">
                            <input type="file" name="PPT[]" accept=".pptx" id="PPT_Materials" multiple>
                            <button name="AddPPT" class="Add_Button">Add</button>
                            <button name="DeletePPT" class="Delete_Button">Delete</button>
                        </div>
                </div>

                <div class="row">
                    <div class="col-25">
                        <label for="Assignments">Assignments (Docs):</label>
                    </div>
                        <div class="col-75">
                            <input type="file" name="DOCS[]" accept=".docx" id="Assignments" multiple>
                            <button name="AddAssignment" class="Add_Button" style="left: 52.65%;">Add</button>
                            <button name="DeleteAssignment" class="Delete_Button" style="left: 52.7%;">Delete</button>
                        </div>
                </div>

                <div class="row">
                    <div class="col-25">
                        <label for="Quiz">Quiz (URL):</label>
                    </div>
                        <div class="col-75">
                            <input type="text" size="30" id="Quiz" placeholder="Enter the Quiz URL">
                            <button name="AddQuiz" class="Add_Quiz">Add</button>
                            <button name="DeleteQuiz" class="Delete_Quiz">Delete</button>
                        </div>
                </div>

                <div class="row">
                    <div class="col-25">
                        <label for="Video">Video URL:</label>
                    </div>
                        <div class="col-75">
                            <input type="text" size="30" id="Video" placeholder="Enter the Video URL">
                            <button name="AddVideo" class="Add_Video">Add</button>
                            <button name="DeleteVideo" class="Delete_Video">Delete</button>
                        </div>
                </div>

                <div class="row">
                    <div class="col-25">
                        <label for="Publish_Date">Published Date:</label>
                    </div>
                        <div class="col-75">
                            <input name="publish" type="datetime-local" value="<?php echo $_POST['publish'] ?? ''; ?>" id="Publish_Date" required>
                        </div>
                </div>

                <div class="row">
                    <div class="col-25">
                       <span><input  type="button" id="Add_More_Materials" value="Add More Materials"></span> 
                    </div>
                    
                    <div class="col-75">
                        <a href="../html/admin.html"><input type="button" id="Back" value="Back"></a>
                    </div>
                </div>

            </form>
        </div>
    </body>
</html>