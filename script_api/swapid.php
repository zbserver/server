<?php
init();
Print " ".p."Website Bangkrut".n.
      " ".p."Nantikan script selanjutnya".n.
      " ".p."Thank You".n;
/*define('host',['SwapID','swapid.pro','']);
define('version','1.0');
define('cok','cookie.'.host[0]);
define('uag','user_agent');
define('web','https://'.host[1]);
init();
ban();
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
    $log  = Ambil($r,'class="font-medium">','</div>',1);
    $bal  = Ambil($r,'class="text-3xl font-medium leading-8 mt-6">','</div>',1);
    $ene  = Ambil($r, 'class="text-3xl font-medium leading-8 mt-6">','</div>',3);
    return ["b"=>$bal,"l"=>$log,"e"=>$ene];
}
Function Game($game,$id){
    while(true){
        $li = get(web."/games/play/".$game);
        $csrf = Ambil($li,"var csrf_hash = '","'",1);
        $data ="score=5004&csrf=$csrf";
        $r = post(web."/games/verify?id=$id",$data);
        $oke = Ambil($r,'earned ','"',1);
        if($oke){
            $pt = str_replace("you have ","",$oke);
            $pt = str_replace("remaining","",$pt);
            print " ".w3."[".p.cpm[1].w3."]".p.$game.panah.p.$pt.n; sleep(5);
        }
        if (preg_match("/Limit/", $r)){
            print " ".w3."[".p.cpm[4].w3."]".p." Limit ! playing again tomorrow! "."[".k.$game.p."]".n;
            break;
        }
    }
}
Function Auto(){
    Auto:
    $r =  balance(); $e=$r["e"];
    if($e<= null){
        print " ".w3."[".p.cpm[4].w3."]".p." Energy not found !!!".n;
        die;
    }
    $r = get(web."/auto");
    $tim = Ambil($r,'let timer = ',',',1);
    tim($tim);
    $tok = Ambil($r,'name="token" value="','">',1);
    $data = "token=$tok";
    $r = post(web."/auto/verify",$data);
    $oke  = Ambil($r,'html: `','has been added to your balance`',1);
    if($oke){
        $r = balance(); $b=$r["b"];$e=$r["e"];
        print " ".w3."[".p.cpm[2].w3."]".p." Balance ".panah.p.$b.n.
              " ".w3."[".p.cpm[3].w3."]".p." Energy  ".panah.p.$e.n.
              " ".line(); goto Auto;
    }
    
}

$r = balance(); $b=$r["b"];$l=$r["l"];$e=$r["e"];
$r = get(web."/dashboard");
$check = FirCF($r);
if($check['cf']){
    print (k." Cloudflare Detect".n);
    Del();die;
    return 'cf'; 
}
if(preg_match("/dashboard/",$r)){
    print p." Login Success".r;sleep(2);
}else{
    print p." Error ".p."|".k." Cookie Experied! ".n;sleep(2);Del();die;
}
print " ".w3."[".p.cpm[1].w3."]".p." Login   ".panah.p.$l.n.
      " ".w3."[".p.cpm[1].w3."]".p." Balance ".panah.p.$b.n.
      " ".w3."[".p.cpm[1].w3."]".p." Energy  ".panah.p.$e.n.
      " ".p.line();

Game("2048-lite","1");
Game("pacman-lite","2");
Game("hextris-lite","3");
Game("taptaptap","4");
Auto();
*/
