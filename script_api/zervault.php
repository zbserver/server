<?php
define('host',['zervault','zervault.com','']);
define('version','1.0');
define('cok','cookie.'.host[0]);
define('uag','user_agent');
define('web','https://'.host[1]);
init();

Awal:
SaveCokUa();
ban();
Function h(){
    $h[] = "Host: ".host[1];
    $h[] = "cookie: ".file_get_contents(Data.cok);
    $h[] = "accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9";
	$h[] = "accept-language: id-ID,id;q=0.9,en-US;q=0.8,en;q=0.7";
    $h[] = "user-agent: ".file_get_contents(Data.uag);
    
    return $h;
}
while(true){
    $r = get(web."/auto/");
    $b = Ambil($r,'<span style="font-weight: bold; color: white;">','</span>',1);
    $token = Ambil($r,'type="hidden" name="token" value="','">',1);
    $timer = Ambil($r,'let timer = ',',',1);
    print Pesan(4,2).p." Update Balance " .w2.$b.p.n;
    if(preg_match('/Cloudflare/',$r) || preg_match('/Just a moment.../',$r)){
        Pesan(4,1).p." Firewall ".n;Del();sleep(5);goto Awal;
    }
    tim($timer);
    post(web."/auto/verify/","token=$token").n;
}
