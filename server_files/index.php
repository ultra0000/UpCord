<?php
session_start();

if(!isset($_SESSION['logged_in'])) {
    $message = "Click here to sign in.";
    $messageLink = "/login/";
}
else
{
    $message = "You're already signed in. Click here to view your files.";
    $messageLink = "/list/";
    
    extract($_SESSION['userData']);
}
?>
<html>
    <head>
        <title>UpCord - Home</title>
        <style>
            a:visited { 
                color: blue; 
            }
        </style>
    </head>
    <body>
        <h1>Welcome.</h1>
        <h3>Welcome to an instance of UpCord. UpCord allows you to sign in with your Discord account and, if you're on the whitelist, upload files.</h3>
        <a href="<?php echo $messageLink ?>"><?php echo $message ?></a><br>
        <?php
            $config = json_decode(file_get_contents("../config.json"), true);
            if ($config["owner"] != "unspecified")
            {
                echo "<p>This instance is hosted by " . $config["owner"] . "</p>\n";
            }
            echo "<p>File size limit is of " . $config["size_limit"] . " bytes</p>";
        ?>
    </body>
</html>