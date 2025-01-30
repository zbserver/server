<?php
define('host',['claim.ourcoincash','claim.ourcoincash.xyz','']);
define('version','1.0');
define('cok','cookie.'.host[0]);
define('uag','user_agent');
define('web','https://'.host[1]);
Init();
Function h(){
    $h[] = "Host: ".host[1];
    $h[] = "cookie: ".file_get_contents(Data.cok);
    $h[] = "user-agent: ".file_get_contents(Data.uag);
    return $h;
}
ban();
SaveCokUa();
ban();
save("Email");
$Wallet=file_get_contents(Data."Email");
cl();
$r = get(web);
$lg = Ambil($r,'<span>','</span>',2);
if(!$lg){print Inpoku(1)."Cookie expried";Del();die;}
 
Function CC($coin){
    
    $r   = get(web."/faucet/currency/$coin");
    $c_t = Ambil($r,'name="csrf_token_name" id="token" value="','">',1);
    $tok = Ambil($r,'name="token" value="','">',1);
    $data ="csrf_token_name=$c_t&token=$tok&wallet=$Wallet";
    $post = post(web."/faucet/verify/$coin",$data);
    $hasil= Ambil($post,"html: '0.",strtoupper($coin)." has been sent to your FaucetPay account!'",1);
    if(preg_match("/Success!'/",$post)){
        print Inpoku(2).$hasil.p."sent to faucetpay.io"." ".k.strtoupper($coin).n;   
    }
    if(preg_match('/The faucet does not have sufficient funds for this transaction./',$post)){print Inpoku(1).p."Faucet does not have sufficient".n;goto en;}
    en:
}
while(true){
    $r = get(web);
    $c = explode('/faucet/currency/',$r);
    foreach($c as $a => $coins){
        if($a == 0)continue;
        $coin = explode('"',$coins)[0];
        $r   = get(web."/faucet/currency/$coin");
        if($res){if($res[$coin] > 2)continue;}
        if(preg_match('/Daily claim limit/',$r)){
            $res = Riwayat([$coin=>3],$res);
            print pesan(4,1).p."Daily claim limit ".w2.strtoupper($coin).p.n;continue;
        }
        $c_t = Ambil($r,'name="csrf_token_name" id="token" value="','">',1);
        $tok = Ambil($r,'name="token" value="','">',1);
        $data ="csrf_token_name=$c_t&token=$tok&wallet=sambeljeruk%40gmail.com";
        $post = post(web."/faucet/verify/$coin",$data);
        $hasil= Ambil($post,"html: '",strtoupper($coin)." has been sent to your FaucetPay account!'",1);
        if(preg_match("/Success!'/",$post)){
            print pesan(4,2).pesan(5,$hasil).p."sent to faucetpay.io"." ".k.strtoupper($coin).n;   
        }
        if(preg_match("/Sufficient fund/",$post)){
            $res = Riwayat([$coin=>3],$res);
            print pesan(4,1).p."Sufficient funds ".w2.strtoupper($coin).p.n;continue;
            $res = Riwayat([$coin=>1],$res);
        }
        en:
        //if(Riwayat($res) > 2)break;
    }
}
