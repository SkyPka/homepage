<?php
function getIP()
{
    if (isset($_SERVER)){
        if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])){
            $realip = $_SERVER["HTTP_X_FORWARDED_FOR"];
        } else if (isset($_SERVER["HTTP_CLIENT_IP"])) {
            $realip = $_SERVER["HTTP_CLIENT_IP"];
        } else {
            $realip = $_SERVER["REMOTE_ADDR"];
        }
    } else {
        if (getenv("HTTP_X_FORWARDED_FOR")){
            $realip = getenv("HTTP_X_FORWARDED_FOR");
        } else if (getenv("HTTP_CLIENT_IP")) {
            $realip = getenv("HTTP_CLIENT_IP");
        } else {
            $realip = getenv("REMOTE_ADDR");
        }
    }
    return $realip;
}


$user_agent = $_SERVER['HTTP_USER_AGENT'];
$accept = $_SERVER['HTTP_ACCEPT'];
$accept_language = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
date_default_timezone_set('Asia/Shanghai');
$ip = getIP();
$url="http://ip-api.com/json/".$ip."?lang=zh-CN";
$html = file_get_contents($url);

$content = $ip."userAgent:".$user_agent."\n"."accept:".$accept."\n"."acceptLanguage:".$accept_language."\n".$html."time:".date("Y-m-d G:H:s");
echo $content;


$Infofile = fopen("Opener Info.txt", "a") or die("Unable to open file!");
$txt = $content."\n\n\n";
fwrite($Infofile, $txt);
fclose($Infofile);

?>
