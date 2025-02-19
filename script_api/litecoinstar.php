<?php
define('host',['LitecoinStar','litecoinstar.eu','']);
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
    $h[] = "x-requested-with: XMLHttpRequest";
    $h[] = "cookie: ".file_get_contents(Data.cok);
    $h[] = "user-agent: ".file_get_contents(Data.uag);
    return $h;
}
Function balance(){
    $r    = get(web."/dashboard");
    $user = Ambil($r,'<span class="fw-bold text-primary">','</span>',1);
    $bal  = Ambil($r,'<p class="fs-4 fw-bold text-success">','</p>',1);
    $ene  = Ambil($r,'<p class="fs-4 fw-bold text-warning">',' <i class',1);
    return ["b"=>$bal,"e"=>$ene,"u"=>$user];
}
$apikey=file_get_contents(Data."/Apikey");
$r = get(web);
if(preg_match("/logout/",$r)){
    print p." Login Success".r;sleep(2);
}else{
    print " ".w3."[".p.cpm[4].w3."]".k." Cookie Experied! ".n;sleep(2);Del();die;
}
$r=null;
$r = balance(); $b=$r["b"]; $e=$r["e"]; $u=$r["u"];
print " ".w3."[".p.cpm[1].w3."]".p." Login   ".panah.p.$u.n.
      " ".w3."[".p.cpm[1].w3."]".p." Balance ".panah.p.$b." USD".n.
      " ".w3."[".p.cpm[1].w3."]".p." Apikey  ".panah.p.Api_Bal($api_url).n.
      " ".p.line();
Faucet:
while(true){
    $r=get(web."/faucet");
    $locked=Ambil($r,'You must visit ',' to be able to Roll',1);
    if(preg_match('/Faucet Locked!/',$r)){print hm." Faucet Locked! ".p."You must visit ".p.$locked.n;die();}
    $time= Ambil($r,'<span id="countdown">','</span>',1);
    if($time){tim($time);}
    $sitekey= Ambil($r,'data-sitekey="','">',1);
    if(!$sitekey){
        print " ".w3."[".p.cpm[4].w3."]".p." Sitekey Error ";sleep(5);print r;
        continue;
    }
    $cap=Captcha($r,$api_url,$apikey, $sitekey, web."/faucet",5);
    if(!$cap)continue;
    $token = Ambil($r,'name="csrf_token_name" value="','" />',1);
    $data  = "g-recaptcha-response=$cap&h-captcha-response=$cap&csrf_token_name=$token";
    $r = post(web."/faucet",$data);
    $suk = Ambil($r,'<div class="alert alert-success">','</div>',1);
    if($suk){
        $r = balance(); $b=$r["b"];
        print " ".w3."[".p.cpm[1].w3."]".p." Reward   ".panah.p.trim($suk).n;
        print " ".w3."[".p.cpm[2].w3."]".p." Balance  ".panah.p.$b." USD".n;
        print " ".w3."[".p.cpm[3].w3."]".p." Apikey   ".panah.p.Api_Bal($api_url).n;
        print " ".line();
    }
}
