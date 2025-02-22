<?php
define('host',['Ourcoincash','ourcoincash.xyz','']);
define('version','1.0');
define('cok','cookie.'.host[0]);
define('uag','user_agent');
define('web','https://'.host[1]);
init();
Function h(){
    $h[] = "Host: ".host[1];
    $h[] = "cookie: ".file_get_contents(Data.cok);
    $h[] = "accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7";
    $h[] = "user-agent: ".file_get_contents(Data.uag);
    return $h;
}
Function balance(){
    $r = get(web."/dashboard");
    $b = Ambil($r,'<p class="acc-amount"><i class="fas fa-coins"></i> ','</p>',1);
    $e = Ambil($r,'<p class="text-warning"><i class="fas fa-bolt"></i> ','</p>',1);
    return ["b"=>$b.h.' Coins',"e"=>$e];
}
apikey:
ban();
Print Pesan(0, "Menu apikey").n;
Menu(1,"Xevil");
Menu(2,"Multibot");
$pilih = readline(Pesan(0,"Input ".p).panah.p);
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
$apikey=file_get_contents(Data."/Apikey");
SaveCokUa();
ban();

$r = get(web."/dashboard");

$lg = Ambil($r,'<span>','</span>',2);
if(!$lg){print pesan(0,cpm[4]).p."Cookie Experied.".n;Del();die;}
else{print " ".p."Login success.";sleep(2);print r;}
$r = balance(); $b=$r["b"];$e=$r["e"];
print pesan(0,cpm[2]).p."Balance".panah.p.$b.n;
print pesan(0,cpm[2]).p."Energy ".panah.p.$e.n;
print pesan(0,cpm[2]).p."Apikey ".panah.p.Api_Bal($api_url).n;
print " ".line();

Faucet:
while(true){
    $r = get(web."/faucet");
    $atb = anti_bot($r,$api_url,$apikey,8);
    if(!$atb)continue;
    $c_t = Ambil($r,'name="csrf_token_name" id="token" value="','">',1);
    $tok = Ambil($r,'name="token" value="','">',1);
    $data ="antibotlinks=$atb&csrf_token_name=$c_t&token=$tok";
    $post = post(web."/faucet/verify",$data);
    if($post){
        if(preg_match("/title: 'Good job!'/",$post)){
            $r = balance(); $b=$r["b"];$e=$r["e"];
            $hasil = Ambil($post,"text: '","has been added to your balance",1);
            print pesan(0,cpm[1]).p."Reward ".panah.p.$hasil.n;
            print pesan(0,cpm[2]).p."Balance".panah.p.$b.n;
            //print " ".w3."[".p.cpm[3].w3."] ".p."Left   ".panah.p.$lf.n;
            print pesan(0,cpm[3]).p."Apikey ".panah.p.Api_Bal($api_url).n;
            print " ".p.line();
            tim(10);
        }
    }
}
