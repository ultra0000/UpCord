<?php
session_start();

if(!isset($_SESSION['logged_in'])){
  header('Location: /login/');
  exit();
}

extract($_SESSION['userData']);

$target_file = "../files/" . $discord_id . "/" . $_POST['filename'];

if (isset($_POST["submit"])) {
  if (!file_exists($target_file)) {
    exit("<h1>Error: File doesn't exist.</h1>\n<br><a href=\"/delete/\">Go back to delete page</a>\n<br><a href=\"/list/\">Go back to file list</a>");
  }

  unlink($target_file);
  exit("<h1>File deleted.</h1>\n<br><a href=\"/delete/\">Go back to delete page</a>\n<br><a href=\"/list/\">Go back to file list</a>");
}
?>