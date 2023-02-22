<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(!isset($_GET['code'])){
    echo 'Unspecified code';
    exit();
}

$discord_code = $_GET['code'];

$config = json_decode(file_get_contents("../../config.json"), true);

$payload = [
    'code'=>$discord_code,
    'client_id'=>$config["login_info"]["client_id"],
    'client_secret'=>$config["login_info"]["client_secret"],
    'grant_type'=>'authorization_code',
    'redirect_uri'=>$config["login_info"]["redirect_uri"],
    'scope'=>'identify%20guids',
];

$payload_string = http_build_query($payload);
$discord_token_url = "https://discordapp.com/api/oauth2/token";

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $discord_token_url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$result = curl_exec($ch);

if(!$result){
    echo curl_error($ch);
}

$result = json_decode($result,true);
$access_token = $result['access_token'];

$discord_users_url = "https://discordapp.com/api/users/@me";
$header = array("Authorization: Bearer $access_token", "Content-Type: application/x-www-form-urlencoded");

$ch = curl_init();
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
curl_setopt($ch, CURLOPT_URL, $discord_users_url);
curl_setopt($ch, CURLOPT_POST, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$result = curl_exec($ch);

$result = json_decode($result, true);

$allowedUserIds = json_decode(file_get_contents("../../whitelist.json"), true);

if (in_array($result['id'], $allowedUserIds))
{
    session_start();
    
    if (!file_get_contents("../files/" . $result['id']))
    {
        mkdir("../files/" . $result['id']);
    }

    $_SESSION['logged_in'] = true;
    $_SESSION['userData'] = [
        'discord_name'=>$result['username'],
        'discord_id'=>$result['id'],
    ];
    
    header("Location: /list/");
}
else
{
    exit("Access denied.");
}
?>