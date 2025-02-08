<?php
define('host',['Nevcoins','nevcoins.club','']);
define('version','1.0');
define('cok','cookie.'.host[0]);
define('uag','user_agent');
define('web','https://'.host[1]);
include("app.php");
//init();
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
    $r = get(web."?page=shortlinks");
    $coin = Ambil($r,'<div class="text-warning"><b>','</b>',1);
    $bal = Ambil($r,'<div class="text-primary"><b>','</b>',1);
    return ["b"=>$bal,"c"=>$coin];
}
Function success($reward,$nub){
    $r=balance(); $b =$r["b"]; $c=$r["c"];
    print " ".w3."[".p.cpm[1].w3."]".p." Lucky Number".panah.p.$nub.k." / ".p.$reward." Bits".n;
    print " ".w3."[".p.cpm[2].w3."]".p." Balance     ".panah.p.$b.k." / ".p.$c.n;
    print " ".line();

}

$apikey=file_get_contents(Data."/Apikey");
$r = get(web);
$lg = Ambil($r,'<font class="text-success">','</font>',1);
$coin = Ambil($r,'Current Bits Value <div class="text-warning"><b>','</b>',1);
$b = Ambil($r,'Account Balance <div class="text-primary"><b>','</b>',1);
$logout= Ambil($r,'<i class="fa fa-power-off"></i> ','</a>',1);
if(!$logout){print k." Cookie Experied \r";sleep(2);Del(); goto Awal;}
print p." Login Success".r;sleep(2);
print " ".w3."[".p.cpm[1].w3."]".p." Login   ".panah.p.$lg.n.
      " ".w3."[".p.cpm[1].w3."]".p." Balance ".panah.p.$b.p." / ".p.$coin.n.
      " ".w3."[".p.cpm[1].w3."]".p." Apikey  ".panah.p.Api_Bal($api_url).n.
      " ".p.line();
Faucet:
while(true){
    $r=get(web."/claim.html");
    if(preg_match("/You already claimed your bonus today. Come back in/",$r)){goto Faucet;}
    $token = Ambil($r,"var token = '","'",1);

    $data="a=getDailyBonus&token=$token";
    $r = post(web.'/system/ajax.php',$data);
    $r = json_decode($r,1);
    $sukses = $r["message"];
    $status = $r["status"];
    
    if($status == 200){
        $r = get(web."/claim.html");
        $b = Ambil($r,'Account Balance <div class="text-primary"><b>','</b>',1);
        $coin= Ambil($r,'Coins Value <div class="text-success"><b>','</b>',1);
        $nub= Ambil($sukses,' Congratulations, your lucky number was ',' and you won ',1);
        $reward= Ambil($sukses,'and you won ','!',1);
        print cek("√").p."Daily Bonus ".panah.p.$nub.w3." | ".p.$reward.n;
        print cek("+").p."Balance     ".panah.p.$b.w3." | ".hm.$coin." USD".n.
        print " ".line();
    }
    
    $locked=Ambil($r,'You must visit ',' to be able to Roll',1);
    if(preg_match('/Faucet Locked!/',$r)){print hm." Faucet Locked! ".p."You must visit ".p.$locked.n;die();}
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
    $r=get(web."/claim.html");
    $token = Ambil($r,"var token = '","'",1);
    $sitekey= Ambil($r,'data-sitekey="','">',1);
    $pageurl = web."/claim.html";
    $apiKey=file_get_contents("Apikey");
    $sitekey= Ambil($r,'data-sitekey="','">',1);
    if(!$sitekey){
        print " Error sitekey!";
        sleep(5);
        print "\r                      \r";
        continue;
    }
    $apiKey=file_get_contents("Apikey");
    $cap=Captcha($r,$api_url,$apikey, $sitekey, $pageurl,8);
    if(!$rv2)continue;
    $data  = "a=getFaucet&token=$token&captcha=1&challenge=false&response=$cap";
    $r = json_decode(post(web.'/system/ajax.php',$data),1);
    if($r['status'] == 200){
        success($r["reward"], $r["number"]);    
    }else{
        echo m.strip_tags($r['message']).r;
    }
}

login();
