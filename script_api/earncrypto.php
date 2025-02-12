<?php
define('host',['Earncrypto','earn-crypto.co','']);
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
    $r    = get(web);
    $log  = Ambil($r,'class="notification"></a>','<br />',1);
    $coin = Ambil($r,'<div class="text-warning"><b>','</b>',1);
    $bal  = Ambil($r,'<div class="text-warning"><b>','</b>',2);
    return ["b"=>$bal,"c"=>$coin,"l"=>$log];
}
Function success($reward,$nub){
    $r=balance(); $b =$r["b"]; $c=$r["c"];
    print " ".w3."[".p.cpm[1].w3."]".p." Lucky Number".panah.p.$nub.k." / ".p.$reward." Bits".n;
    print " ".w3."[".p.cpm[2].w3."]".p." Balance     ".panah.p.$b.k." / ".p.$c.n;
}
ban();
$r = get(web);
if(preg_match("/logout/",$r)){
    print p." Login Success".r;sleep(2);
}else{
    print p." Error ".p."|".k." Cookie Experied! ".n;sleep(2);Del();die;
}
$r=null;
$r = balance(); $b=$r["b"]; $c=$r["c"]; $l=$r["l"];

print " ".w3."[".p.cpm[1].w3."]".p." Login   ".panah.p.$l.n.
      " ".w3."[".p.cpm[1].w3."]".p." Balance ".panah.p.$b.p." / ".p.$c.n.
      " ".w3."[".p.cpm[1].w3."]".p." Apikey  ".panah.p.Api_Bal($api_url).n.
      " ".p.line();
Faucet:
while(true){
    $pageurl = web;
    $r = get($pageurl);
    if(preg_match('/Faucet Locked!/',$r)){print p." Faucet locked. ".p."You must visit 10 more Shortlinks today".n;die();}
    $time= Ambil($r,'id="claimTime">','</span>',1);
    if($time){
        if(strpos($time,"hour") !== false){
            $cektime=explode(' hour',$time)[0];
            tim(($cektime) * (3600+1800));goto Faucet;}
        if(strpos($time,"minutes") !== false){
            $cektime=explode(' minutes',$time)[0];
            tim(($cektime +1) * 60);goto Faucet;
        }else{
        $cektime=explode(' seconds',$time)[0];
        tim($cektime);
        }
    }
    $sitekey=Ambil($r,'data-sitekey="','"',1);
    if(!$sitekey){
        print " ".w3."[".p.cpm[4].w3."]".w2." Error sitekey!";
        sleep(2);
        print "\r                      \r";
        continue;   
    }
    $cap = Captcha($r,$api_url,$apikey, $sitekey, $pageurl,8);
    if(!$cap){continue;}
    $token = Ambil($r,"var token = '","';",1);
    $data  = "a=getFaucet&token=$token&captcha=1&challenge=false&response=$cap";
    $r = json_decode(post(web.'/system/ajax.php',$data),1);
    
    if($r['status'] == 200){
        success($r["reward"], $r["number"]); 
        print " ".w3."[".p.cpm[3].w3."]".p." Apikey      ".panah.p.Api_Bal($api_url).n;
        print " ".line();   
    }else{
        echo " ".k.strip_tags($r['message']).r;
    }          
}
