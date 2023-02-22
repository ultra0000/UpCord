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
        <title>UpCord - Delete File</title>
        <style>
            a:visited { 
                color: blue; 
            }
        </style>
    </head>
    <body>
        <h1>Delete file</h1>
        <h2>Type the file's name here. Please note that this action cannot be undone.</h2>
        <form action="delete.php" method="post" enctype="multipart/form-data">
            <label for="filename">Filename: </label>
            <input type="text" id="filename" name="filename"><br><br>
            <input type="submit" value="Delete" name="submit">
        </form>
    </body>
</html>