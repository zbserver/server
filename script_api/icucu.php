<?php
define('host',['icucu','icucu.icu/','']);
define('version','1.0');
define('cok','cookie.'.host[0]);
define('uag','user_agent');
define('web','https://'.host[1]."/doge/");

Function h(){
    $h[] = "Host: ".host[1];
    $h[] = "user-agent: ".getUserAgent();
    $h[] = "accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9";
	$h[] = "accept-language: id-ID,id;q=0.9,en-US;q=0.8,en;q=0.7";
    return $h;
}
init();
login();
Function login(){
    
    ban();
    
    save("Wallet");
    $Wallet=file_get_contents("Wallet");
    ban();
    get(host[2]);
    $data = "address=$Wallet&test=";
    post(host[2],$data);
    
    $r= get(web);

    $usn=Ambil($r,'<td class="tr-cc" colspan="2">','</',1);
    $Earn = Ambil($r,'dogetoshi (<span class="ttrecC">','</span>',1);
    print p." ".line();
    print p.cek("~")." Login".panah.hm.trim($usn).n;
    print p.cek("~")." Total Earning".panah.o.$Earn." Dogecoin".n;
    print p." ".line();
    
    while(true){
        $r= get(web);
        $claim = Ambil($r,'<a style="color: blue;" href="','"',1);
        $r = get($claim);
        if(preg_match("/Auto Claim URL has Expired/",$r)){goto keluar; }
        $wait= Ambil($r,"Please close all active sessions and wait atleast ","before continue",1);
        if($wait){print k." Please close all active sessions and wait.".n;
            if(strpos($wait,"minutes") !== false){
                  $cektime=explode(' minutes',$wait)[0];
                  if($cektime){
                    tim(($cektime +1) * 60);
                  }
            }
        }
        $time = Ambil($r,'data-timer="','" style',1);
        if($time){tim($time);}
        $reward = Ambil($r,'20px;">','</div>',1);
        $Earn = Ambil($r,'dogetoshi (<span class="ttrecC">','</span>',1);
        if(preg_match("/mbuut The faucet does not have sufficient funds for this transaction./",$reward)){
            print k." The faucet does not have sufficient funds".n;
            print line();
            goto out;
        }
        if($reward){
            if(preg_match("/ was sent to your account in FaucetPay.io/",$reward)){
                $potong= str_replace(" was sent to your account in FaucetPay.io",p." sent to FaucetPay.io",$reward);
                print cpm[1].w3." ".trim($potong).n;
                print cpm[2].p." "."Total Earning".panah.hm.$Earn." Dogecoin".n;
                print line(); goto out;
            }  
        }else{keluar: print cpm[4]."Expired!!! Claim Shortlink to continue!!!".n;die();}
        
        out: 
    }
}
login();
