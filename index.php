<?php
//====================@MwMcoders======================//
//Ushbu kod @Defqon tomonidan yozildi va @MwMcoders jamoasi tomonidan tarqatildi o'g'rilar manba bilan o'g'irlang
ob_start();
error_reporting(0);
define('API_KEY','1425688866:AAFDtra5VNqyo2VMzwpw-yM9EXf1GdBvTrw');
$admin = "1232898350";
$Mehdi = "-1001275857320";
//====================@MwMcoders======================//
function bot($method,$datas=[]){
$url = "https://api.telegram.org/bot".API_KEY."/".$method;
$ch = curl_init();curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);$res = curl_exec($ch);
if(curl_error($ch)){var_dump(curl_error($ch));}else{return json_decode($res);}}
function SendMessage($chat_id,$text,$keyboard){bot('SendMessage',[
'chat_id'=>$chat_id,'text'=>$text,'reply_markup'=>$keyboard]);}
function ForwardMessage($chatid,$from_chat,$message_id){bot('ForwardMessage',[
'chat_id'=>$chatid,'from_chat_id'=>$from_chat,'message_id'=>$message_id]);}
function save($filename, $data){
$file = fopen($filename, 'w');
fwrite($file, $data);
fclose($file);}
function edit($chat_id,$meesage_id,$text,$reply_markup){
bot('editMessageText',['chat_id'=>$chat_id,
'message_id'=>$message_id,'text'=>$text,
'reply_markup'=>$reply_markup]);}
//====================@MwMcoders======================//
$update = json_decode(file_get_contents("php://input"));
$message = $update->message;
$text = $update->message->text;
$chat_id = $update->message->chat->id;
$from_id = $update->message->from->id;
$message_id = $update->message->message_id;
$first_name = $update->message->from->first_name;
$first = $update->callback_query->from->first_name;
$last_name = $update->callback_query->from->last_name;
$username = $update->callback_query->from->username;
$username2 = $update->message->from->username;
$data = $update->callback_query->data;
$chatid = $update->callback_query->message->chat->id;
$messageid = $update->callback_query->message->message_id;
$forward_username = $update->message->forward_from_chat->username;
$reply = $message->reply_to_message->forward_from->id;
$reply_username = $message->reply_to_message->forward_from->username;
$ThisTime = file_get_contents("http://mehdiyousefii.lordmizban.ir/postzamandar.php");
date_default_timezone_set('Asia/Dushanbe');
$time = date('H:i');
mkdir("data");
$MwMcoders = file_get_contents("data/YouSefi.txt");
$Timeset = file_get_contents("data/Time.txt");
$Postset = file_get_contents("data/Post.txt");
//====================@MwMcoders======================//
if($text == "/start" && $chat_id == $admin){
bot('sendmessage', ['chat_id' => $chat_id,
'text'=>"Salom admin {$first_name};

Bu botni vazifasi siz vaqtni o'rnatasiz va habar kiritasiz va men uni o'sha kiritgan vaqtingizda kanalingizga joylayman
 

 Ishni boshlash uchun quyidagi tugmalarni ishlating; ",
'parse_mode'=>'html',
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"Vaqtni kiritish",'callback_data'=>"set"],['text'=>"⚜️Project leaders⚜️",'callback_data'=>"Dev"]]],'resize_keyboard'=>true])]);}
elseif($data == "set"){
file_put_contents("data/YouSefi.txt", "timeset");
bot('editMessageText',['chat_id'=>$chatid,
'message_id'=>$messageid,
'text' => "Kanalingizga xabaringizni qachon yubormoqchi ekanligingizni ko'rsating
 Uni robotga yuboring :)

 Hozir soat ($time)",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"⛔️ Bekor qilish",'callback_data'=>"menu"]],],'resize_keyboard'=>true])]);}  
elseif($MwMcoders=="timeset"){
file_put_contents("data/YouSefi.txt", "none");
file_put_contents("data/Time.txt", $text);
bot('sendmessage', ['chat_id' => $chat_id,
 'text' =>"Postni kanalga qachon tashlanishi muvaffaqqiyattli belgilandi

 ▫️ Endi o'z kanalingizga tashlanmiqchi bo'lgan narsangizni menga tashlang 
Media Xabarlarda Biroz xatoliklar bo'lishi mumkin shuning uchun faqat text tashlang ",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"Xabarni sozlash",'callback_data'=>"post"],['text'=>"Bekor qilish",'callback_data'=>"menu"]],],'resize_keyboard'=>true])]);} 
elseif($data == "post"){
file_put_contents("data/YouSefi.txt", "postset");
bot('editMessageText',['chat_id'=>$chatid,
'message_id'=>$messageid,
'text'=>"Iltimos, faqat matn jo`nating  media va fayllarda nosozliklar bo`lishi mumkin ",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"⛔️ Bekor qilish",'callback_data'=>"menu"]],],'resize_keyboard'=>true])]);} 
elseif($MwMcoders=="postset"){
file_put_contents("data/YouSefi.txt", "none");
file_put_contents("data/Post.txt", $text);
bot('sendmessage', ['chat_id' => $chat_id,
'text'=>"Xabar muvaffaqiyatli ravishda $Timeset vaqtiga o'rnatildi

 🔺 Agar siz vaqtni noto'g'ri tanlagan bo'lsangiz yoki sizning xabaringiz media va fayl bo'lsa
 Kanalingizga yuborilmaydi


 Robotni qayta ishga tushirish uchun /start ni bosing",]);}
elseif( $time == $Timeset){
bot('sendmessage',['chat_id'=>$Mehdi,   
'text'=>" $Postset ",]);
unlink("data/YouSefi.txt"); 
unlink("data/Time.txt"); 
unlink("data/Post.txt");
bot('sendmessage', ['chat_id' => $admin,
'text'=>"Postingiz muvaffaqiyatli sizning kanalingizga yuborildi :)",]);}
elseif($data == "menu"){
unlink("data/YouSefi.txt"); 
unlink("data/Time.txt"); 
unlink("data/Post.txt"); 
bot('editMessageText',['chat_id'=>$chatid,
'message_id'=>$messageid,
'text'=>"Amal muvaffaqiyatli bekor qilindi;

 /start buyrug'i orqali Robotni qayta ishga tushirish uchun ishga tushiring; ",]);}
elseif($data == "Dev"){
bot('editMessageText',['chat_id'=>$chatid,
'message_id'=>$messageid,
'text'=>" $ThisTime ",]);}
unlink("error_log");

?>