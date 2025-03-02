<?php
const
app_required = "1.0.6";
define('host',['Ourcoincash','ourcoincash.xyz','']);
define('version','1.0.1');
define('cok','cookie.'.host[0]);
define('uag','user_agent');
define('web','https://'.host[1]);
Engcek();
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
Menu_Api();
Awal:
SaveCokUa();
ban();
$r = get(web."/dashboard");
$lg = Ambil($r,'<span>','</span>',2);
if(!$lg){print Error("Cookie Experied").n;Del();die;}
else{print " ".p."Login success.";sleep(2);print r;}
$r = balance();
print pesan(0,cpm[2]).p."Balance".panah.p.$r["b"].n;
print pesan(0,cpm[2]).p."Energy ".panah.p.$r["e"].n;
print pesan(0,cpm[2]).p."Apikey ".panah.p.Api_Bal().n;
print " ".line();
Faucet:
while(true){
    $r = get(web."/faucet");
    if(preg_match("/firewall/",$r)){
        $s = get(web."/firewall");
        $sitekey= Ambil($r,'data-sitekey="','">',1);
        if(!$sitekey){
            print Error("Sitekey Error");sleep(5);print r;
            continue;
        }
        $cap=Captcha($r, web."/firewall");
        if(!$cap)continue;
        $c_t = Ambil($r,'name="csrf_token_name" id="token" value="','">',1);
        $data="g-recaptcha-response=$cap&captchaType=hcaptcha&csrf_token_name=$c_t";
        post(web."/firewall/verify",$data);
    }
    $atb = anti_bot($r);
    if(!$atb)continue;
    $c_t = Ambil($r,'name="csrf_token_name" id="token" value="','">',1);
    $tok = Ambil($r,'name="token" value="','">',1);
    $data ="antibotlinks=$atb&csrf_token_name=$c_t&token=$tok";
    $post = post(web."/faucet/verify",$data);
    if($post){
        if(preg_match("/title: 'Good job!'/",$post)){
            $r = balance(); 
            $hasil = Ambil($post,"text: '","has been added to your balance",1);
            Efek(success($hasil).n.bal($r["b"]).n.cekapi().n,5000);
            print " ".p.line();
            tim(5);
        }
    }
}
