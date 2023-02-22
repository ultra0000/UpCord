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
    exit("Error: File doesn't exist.");
  }

  unlink($target_file);
  exit("File deleted.");
}
?>