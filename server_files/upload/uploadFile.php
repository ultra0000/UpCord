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
    exit("<h1>Error: tf you doing bro</h1>\n<br><a href=\"/upload/\">Go back to upload page</a>\n<br><a href=\"/list/\">Go back to file list</a>");
  }

  if (file_exists($target_file)) {
    exit("<h1>Error: File already exists</h1>\n<br><a href=\"/upload/\">Go back to upload page</a>\n<br><a href=\"/list/\">Go back to file list</a>");
  }

  if ($fileSize > $config["size_limit"])
  {
    exit("<h1>Error: File too big, limit is " . $config["size_limit"] . " bytes</h1>\n<br><a href=\"/upload/\">Go back to upload page</a>\n<br><a href=\"/list/\">Go back to file list</a>");
  }

  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "<h1>Success</h1>\n<br><a href=\"/upload/\">Go back to upload page</a>\n<br><a href=\"/list/\">Go back to file list</a>";
  } else {
    echo "<h1>Error: Failed to upload because of error #" . $_FILES["fileToUpload"]["error"] . "</h1>\n<br><a href=\"/upload/\">Go back to upload page</a>\n<br><a href=\"/list/\">Go back to file list</a>";
  }
}
?>