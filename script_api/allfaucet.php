<?php
define('host',['Allfaucet','allfaucet.xyz','']);
define('version','1.0');
define('cok','cookie.'.host[0]);
define('uag','user_agent');
define('web','https://'.host[1]);
Init();
Function h(){
    $h[] = "Host: ".host[1];
    $h[] = "cookie: ".file_get_contents(Data.cok);
    $h[] = "accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7";
    $h[] = "user-agent: ".file_get_contents(Data.uag);
    return $h;
}
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
$apikey=file_get_contents(Data."/Apikey");
ban();
SaveCokUa();
ban();
$r  = get(web."/dashboard");
$lg = Ambil($r,'<h2>','</h2>',1);
if(!$lg){print Pesan(4,1)."  Cookie expried";Del();die;}
print " ".w3."[".p.cpm[4].w3."]".p." Apikey ".panah.p.Api_Bal($api_url).n;
print " ".line();

while(true){
    $r =get(web."/dashboard");
    $c = explode('/faucet/currency/',$r);
    foreach($c as $a => $coins){
        if($a == 0)continue;
        $coin = explode('"',$coins)[0];
        if(preg_match("/firewall/",$r)){
            print Pesan(4,1).p."  Firewall! Open browser".n;
        }
        $r   = get(web."/faucet/currency/$coin");
        if($res){if($res[$coin] > 2)continue;}
        if(preg_match('/Daily claim limit/',$r)){
            $res = Riwayat([$coin=>3],$res);
            print " ".w3."[".p.cpm[1].w3."] ".p."  Daily claim limit ".k.strtoupper($coin).p.n;continue;
        }
        $atb = anti_bot($r,$api_url,$apikey,8);
        if(!$atb)continue;
        $c_t = Ambil($r,'name="csrf_token_name" id="token" value="','">',1);
        $tok = Ambil($r,'name="token" value="','">',1);
        $data ="antibotlinks=$atb&csrf_token_name=$c_t&token=$tok";
        
        $post = post(web."/faucet/verify/$coin",$data);
        $hasil= Ambil($post,"html: '",strtoupper($coin)." has been sent to your FaucetPay account!'",1);
        if(preg_match("/Success!'/",$post)){
            $left=Ambil($r,'<p class="lh-1 mb-1 fw-bold">','</p>',5);
            print " ".w3."[".p.cpm[1].w3."] ".o.$hasil.p."sent to FP".p." | left ".o.$left.p."|".k.strtoupper($coin).p."|".n;
            tim(10);  
        }
        if(preg_match("/Failed!'/",$post)){
            $hasil= Ambil($post,"html: '",'',1);
            print " ".w3."[".p.cpm[4].w3."] ".p."Failed".k.strtoupper($coin).n;continue;  
        }
        if(preg_match("/Sufficient fund/",$post)){
            $res = Riwayat([$coin=>3],$res);
            print " ".w3."[".p.cpm[4].w3."] ".p."Sufficient fund".n;continue;
            $res = Riwayat([$coin=>1],$res);
        }
        en:
        //if(Riwayat($r) > 2)break;
    }
}
