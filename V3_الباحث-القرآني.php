<?php
/*
بوت الباحث القرآني
الإصدار الثالث

فضلا اترك حقوق القناة
@api_tele
*/

ob_start();

$API_KEY = "1564859866:AAGvG-QCJjpi-lndUGC2UQbLZGNzTZqriJY"; //your token bot

define("API_KEY",$API_KEY);
function bot($method,$str=[]){
        $http_build_query = http_build_query($str);
        $api = "https://api.telegram.org/bot".API_KEY."/".$method."?$http_build_query";
        $http_build_query = file_get_contents($api);
        return json_decode($http_build_query);
}

$update = json_decode(file_get_contents("php://input"));
$message = $update->message;
$from_id = $message->from->id;
$chat_id = $message->chat->id;
$text = $message->text;
$message_id = $message->message_id;


if($text == "/start"){
bot("sendMessage",[
"chat_id"=>$chat_id,
"text"=>"
حياك الله في خدمة الباحث القرآني

اكتب ما تذكره من الآية القرآنية حتى أقوم بالبحث في القرآن الكريم وجلب جميع النتائج المطابقة

مثال:
الله نور السماوات والأرض 

لتفسير آية يوجد نوعين من التفسير تفسير الميسر والجلالين : 

مثال: 
الميسر الله نور السماوات والأرض
الجلالين الله نور السماوات والأرض


لشرح آية باللغة الإنجليزية
إنجليزي الله نور السماوات والأرض

خدمة الباحث القرآني على الانترنت :
www.api-quran.cf
",
reply_to_message_id=>$message_id,
]);
}

$txt = str_replace("الميسر ","",$text);
$json = json_decode(file_get_contents("https://api-code.ga/quransql/?text=".urlencode($txt)."&type=tafser2"))->result;
$count = count($json);
if(preg_match('/الميسر /',$text)){
if ( $text && $text != "/start" ) {
bot("sendMessage",[
"chat_id"=>$chat_id,
"text"=>"تم العثور على $count من النتائج",
reply_to_message_id=>$message_id,
]);
for( $i=0; $i <= 10; $i++){
bot("sendMessage",[
"chat_id"=>$chat_id,
"text"=>$json[$i],
]);
}
die("");
}
}

$txt = str_replace("الجلالين ","",$text);
$json = json_decode(file_get_contents("https://api-code.ga/quransql/?text=".urlencode($txt)."&type=tafser1"))->result;
$count = count($json);
if(preg_match('/الجلالين /',$text)){
if ( $text && $text != "/start" ) {
bot("sendMessage",[
"chat_id"=>$chat_id,
"text"=>"تم العثور على $count من النتائج",
reply_to_message_id=>$message_id,
]);
for( $i=0; $i <= 10; $i++){
bot("sendMessage",[
"chat_id"=>$chat_id,
"text"=>$json[$i],
]);}
die("");
}
}

$txt = str_replace("انجليزي ","",$text);
$txt = str_replace("إنجليزي","",$txt);
$json = json_decode(file_get_contents("https://api-code.ga/quransql/?text=".urlencode($txt)."&type=english"))->result;
$count = count($json);
if(preg_match('/انجليزي /',$text) or preg_match('/إنجليزي /',$text)){
if ( $text && $text != "/start" ) {
bot("sendMessage",[
"chat_id"=>$chat_id,
"text"=>"تم العثور على $count من النتائج",
reply_to_message_id=>$message_id,
]);
for( $i=0; $i <= 10; $i++){
bot("sendMessage",[
"chat_id"=>$chat_id,
"text"=>$json[$i],
]);}
die("");
}
}



$json = json_decode(file_get_contents("https://api-code.ga/quransql/?text=".urlencode($txt)."&type=search"))->result;
$count = count($json);
if ( $text && $text != "/start" ) {
bot("sendMessage",[
"chat_id"=>$chat_id,
"text"=>"تم العثور على $count من النتائج",
reply_to_message_id=>$message_id,
]);
for( $i=0; $i <= 10; $i++){
bot("sendMessage",[
"chat_id"=>$chat_id,
"text"=>$json[$i],
]);
}
}
?>

/*
بوت الباحث القرآني
الإصدار الثالث

فضلا اترك حقوق القناة
@api_tele
*/