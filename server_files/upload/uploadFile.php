<?php
session_start();

if(!isset($_SESSION['logged_in'])){
  header('Location: /login/');
  exit();
}

$config = json_decode(file_get_contents("../../config.json"), true);

extract($_SESSION['userData']);

$target_file = "../files/" . $discord_id . "/" . basename($_FILES["fileToUpload"]["name"]);
$fileSize = $_FILES['fileToUpload']['size'];

if (isset($_POST["submit"])) {
  if (basename($_FILES["fileToUpload"]["name"]) == ".htaccess")
  {
    exit("Error: tf you doing bro");
  }

  if (file_exists($target_file)) {
    exit("Error: File already exists");
  }

  if ($fileSize > $config["size_limit"])
  {
    exit("Error: File too big, limit is " . $config["size_limit"] . " bytes");
  }

  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "Success";
  } else {
    echo "Error: Failed to upload because of error #" . $_FILES["fileToUpload"]["error"];
  }
}
?>