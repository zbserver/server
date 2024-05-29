<?php
define('host',['leofaucet','leofaucet.com','']);
define('version','1.0');
define('cok','cookie.'.host[0]);
define('uag','user_agent');
define('web','https://'.host[1]);
init();
apikey:
ban();
Print " ".Pesan(0, "Menu apikey").n;
Menu(1,"Xevil");
Menu(2,"Multibot");
$pilih = readline(" ".Pesan(0,"Input ".p).panah.p);
if($pilih == 1){
    $api_url="http://api.sctg.xyz";
    Print w3." Xevil : ".p.n;
    Save("Apikey");
}elseif($pilih == 2){
    $api_url="http://api.multibot.in";
    Print w3." Multibot : ".p.n;
    Save("Apikey");  
}else{print k." Bad Number".n;sleep(3);goto apikey;}

if(!file_exists(Data."Apikey")){
    goto apikey;
}
Awal:
SaveCokUa();
ban();
Function h(){
    $h[] = "Host: ".host[1];
    $h[] = "cookie: ".file_get_contents(Data.cok);
    $h[] = "user-agent: ".file_get_contents(Data.uag);
    $h[] = "accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9";
	$h[] = "accept-language: id-ID,id;q=0.9,en-US;q=0.8,en;q=0.7";
    return $h;
}
Function Firewall($api_url){
    Firewall:
    $apikey=file_get_contents(Data."Apikey");
    $r = get(web."/firewall");
    $tok= Ambil($r,'<input type="hidden" name="_token" value="','">',1);
    $sitekey=Ambil($r,'data-sitekey=','>',1);
    if(!$sitekey){
        print p." Error sitekey!";
        sleep(2);
        print "\r                      \r";
        goto Firewall;   
    }
    $cap = Captcha($r,$api_url,$apikey, $sitekey, web."/firewall",5);
    $data ="_token=$tok&g-recaptcha-response=$cap&h-captcha-response=$cap";
    post(web."/firewall/action",$data);
}
$apikey=file_get_contents(Data."/Apikey");
print load();print r;sleep(2);
$r = get(web."/dashboard");
$lg = Ambil($r,'user-name-text">','</span>',1);
$b = Ambil($r,"<option selected=''>"," coins",1);

if(!$lg){print k." Cookie Experied \r";sleep(2);Del();goto Awal;}
print Pesan(1,"Login").Pesan(0,$lg).n;
print Pesan(1,"Balance").Pesan(0,$b).n;
print Pesan(1,"Apikey").Pesan(0,Api_Bal($api_url)).n." ".p.line();
Faucet:

while(true){
    $pageurl= web."/faucet";
    $r=get($pageurl);
    if(preg_match("/Limit Over/",$r)){print k." Limit Over! Cannot Claim".n;die;}
    if(preg_match("/Firewall/",$r)){Firewall($api_url);goto Faucet;}
    $time= Ambil($r,'<h4 class=" mb-0" id="timer_text">','</h4>',1);
    if($time){
        tim($time);
    }
    $sitekey=Ambil($r,'data-sitekey=','>',1);
    if(!$sitekey){
        print p." Error sitekey!";
        sleep(2);
        print "\r                      \r";
        continue;   
    }
    $token = Ambil($r,'<input type="hidden" name="_token" value="','">',1);
    $reward = Ambil($r,'<h4 class=" mb-0">','<span class="h6">',1);
    $cap = Captcha($r,$api_url,$apikey, $sitekey, $pageurl,5);
    if(!$cap){continue;}
    $data = "_token=$token&g-recaptcha-response=$cap&h-captcha-response=$cap";
    $post = post($pageurl."/verify",$data);
    $coin = Ambil($post,"<option selected=''>"," coins</option>",1);
    $left = Ambil($post,'<h4 class=" mb-0">','</h4>',3);
    if(preg_match("/Claimed Successfully ! Yahoo!/",$post)){
        Print Pesan(1,"Reward").Pesan(0,$reward.k."Coins".p." | ".p."Faucet".panah.p.$left.k." left").n;
        print Pesan(1,"Balance").Pesan(0,$coin.k." Coins".p." | ".p.Api_Bal($api_url).k." Apikey").n;
        print p." ".line();
    }else{print m." Invalid captcha".p;sleep(2);print r;}
}
