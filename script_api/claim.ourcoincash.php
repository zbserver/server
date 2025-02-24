<?php
define('host',['claim.ourcoincash','claim.ourcoincash.xyz','']);
define('version','1.0.1');
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
apikey:
ban();
Print Pesan(0, "Menu apikey").n;
Menu(1,"Xevil");
Menu(2,"Multibot");
$pilih = readline(Pesan(0,"Input ").panah.p);
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
}else{
    $apikey=file_get_contents(Data."/Apikey");
}
SaveCokUa();
ban();
$r = get(web);
$lg = Ambil($r,'<span>','</span>',2);

if(!$lg){print Pesan(4,1)."  Cookie expried";Del();die;}
print pesan(0,cpm[4])."Apikey".panah.p.Api_Bal($api_url).n;
print " ".line();

while(true){
    faucet:
    $r = get(web);
    $c = explode('/faucet/currency/',$r);
    foreach($c as $a => $coins){
        if($a == 0)continue;
        $coin = explode('"',$coins)[0];
        $r = get(web."/faucet/currency/$coin");
        if(preg_match("/firewall/",$r)){
            $r = get(web."/firewall");
            print pesan(0,cpm[4]).p."Bypass Firewall!";sleep(2);print r;
            $sitekey= Ambil($r,'data-sitekey="','">',1);
            if(!$sitekey){
                print pesan(0,cpm[4]).p."Sitekey Error ";sleep(5);print r;
                continue;
            }
            $cap=Captcha($r,$api_url,$apikey, $sitekey, web."/firewall",5);
            if(!$cap)continue;
            $c_t = Ambil($r,'name="csrf_token_name" value="','">',1);
            $ca  = Ambil($r,'name="captchaType" value="','">',1);
            $data="g-recaptcha-response=$cap&captchaType=$ca&csrf_token_name=$c_t";
            post(web."/firewall/verify",$data);
            print pesan(0,cpm[4]).p."Bypass Firewall! √";sleep(2);print r;goto faucet;
        }
        $r = get(web."/faucet/currency/$coin");
        if($res){if($res[$coin] > 2)continue;}
        if(preg_match('/Daily claim limit/',$r)){
            $res = Riwayat([$coin=>3],$res);
            print pesan(0,cpm[4])."Daily claim limit ".w2.strtoupper($coin).p.n;continue;
        }
        $sitekey= Ambil($r,'data-sitekey="','">',1);
        if(!$sitekey){
            print pesan (0,cpm[4])."Sitekey Error!";sleep(5);print r;
            continue;
        }
        $cap=Captcha($r,$api_url,$apikey, $sitekey, web."/claim.html",5);
        if(!$cap){continue;}
        $c_t = Ambil($r,'name="csrf_token_name" id="token" value="','">',1);
        $tok = Ambil($r,'name="token" value="','">',1);
        $ca  = Ambil($r,'name="captcha"><option value="','">',1);
        $email= Ambil($r,'name="wallet" class="form-control" value="','"',1);
        $data ="csrf_token_name=$c_t&token=$tok&captcha=$ca&g-recaptcha-response=$cap&wallet=".urlencode($email);
        $post = post(web."/faucet/verify/$coin",$data);
        $hasil= Ambil($post,"html: '",strtoupper($coin)." has been sent to your FaucetPay account!'",1);
        if(preg_match("/Success!'/",$post)){
            $lf = Ambil($r,'<p class="lh-1 mb-1 font-weight-bold">','</p>',3);
            print pesan(0,cpm[1]).o.$hasil.p."sent to FP.| ".p."left ".w2.$lf.p."|".w2.strtoupper($coin).p."|".n;   
        }
        if(preg_match("/Failed!'/",$post)){
            $hasil= Ambil($post,"html: '",'',1);
            print pesan(0,cpm[4])."Failed.|".w2.strtoupper($coin).p."|".n;   
        }
        if(preg_match("/Sufficient fund/",$post)){
            print pesan(0,cpm[4])."Sufficient funds. ".p."|".w2.strtoupper($coin).p."|".n;continue;
            $res = Riwayat([$coin=>1],$res);
        }
        en:
        //if(Riwayat($res) > 2)break;
    }
}
    
