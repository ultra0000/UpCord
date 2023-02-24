<?php
session_start();

if(!isset($_SESSION['logged_in'])){
  header('Location: /login/');
  exit();
}

extract($_SESSION['userData']);
?>
<html>
    <head>
        <title>UpCord - Upload File</title>
        <style>
            a:visited { 
                color: blue; 
            }
        </style>
    </head>
    <body>
        <h1>Upload file</h1>
        <form action="uploadFile.php" method="post" enctype="multipart/form-data">
            Select file to upload:
            <input type="file" name="fileToUpload" id="fileToUpload">
            <input type="submit" value="Upload File" name="submit">
        </form>
        <br>
        <a href="/list/">Go back to file list</a>
    </body>
</html>