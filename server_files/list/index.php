<?php
session_start();

if(!isset($_SESSION['logged_in'])){
  header('Location: /login/');
  exit();
}

extract($_SESSION['userData']);

$uploadedFiles = array();

$dir = new DirectoryIterator("../files/" . $discord_id);
?>
<html>
    <head>
        <title>UpCord - File list</title>    
        <style>
            a:visited { 
                color: blue; 
            }
        </style>
    </head>
    <body>
        <h1>File List</h1>
        <?php 
            foreach ($dir as $fileinfo) {
                if (!$fileinfo->isDot()) {
                   echo "<a href=\"/files/$discord_id/" . $fileinfo->getFilename() . "\">" . $fileinfo->getFilename() . "</a><br><br>\n";
                }
            }
        ?>
        -------------------------------------------<br>
        <a href="/upload/">Want to upload a file?</a><br><br>
        <a href="/delete/">Want to delete a file?</a><br><br>
        <a href="/logout/">Log out</a>
    </body>
</html>