<?php
define('host',['RoutineFaucet','routinefaucet.net','']);
define('version','1.1');
define('cok','cookie.'.host[0]);
define('uag','user_agent');
define('web','https://'.host[1]);
init();
Function h(){
    $h[] = "Host: ".host[1];
    $h[] = "x-requested-with: XMLHttpRequest";
    $h[] = "content-type: application/x-www-form-urlencoded; charset=UTF-8";
    $h[] = "cookie: ".file_get_contents(Data.cok);
    $h[] = "origin: ".web;
    $h[] = "priority: u=1, i";
    $h[] = "referer: ".web."/roll.html";
    $h[] = "user-agent: ".file_get_contents(Data.uag);
    return $h;
}
Function balance(){
    $r    = get(web."/roll.html");
    $log  = Ambil($r,'class="text-success">','</',1);
    $tokn = Ambil($r,'Faucet Tokens <div class="text-success"><b>','</b>',1);
    $bal  = Ambil($r,'Account Balance <div class="text-primary"><b id="sidebarCoins">','</b>',1);
    $small= Ambil($r,'<small class="text-success">','</small>',1);
    return ["b"=>$bal,"c"=>$tokn,"l"=>$log,"s"=>$small];
}
Function success($reward,$nub){
    $r=balance(); $b =$r["b"]; $c=$r["c"];$s=$r["s"];
    print " ".w3."[".p.cpm[1].w3."]".p." Lucky Number".panah.p.$nub.k." / ".p.$reward." Tokens".n;
    print " ".w3."[".p.cpm[2].w3."]".p." Faucet Token".panah.p.$c.n;
    //print " ".w3."[".p.cpm[2].w3."]".p." Balance     ".panah.p.$b.p." / ".p.$s.n;
}
Awal:
SaveCokUa();
ban();
$r = get(web."/roll.html");
if(preg_match("/logout/",$r)){
    print p." Login Success".r;sleep(2);
}else{
    print " ".w3."[".p.cpm[4].w3."]".k." Cookie Experied! ".n;sleep(2);Del();die;
}
$min = Ambil($r,"You can come back and play every "," to win FREE Faucet Tokens",1);
print " ".w3."[".p.cpm[4].w3."]".p." Info ".k."|".p." Auto roll every ".h.$min.n;
print line;
$r=null;
$r = balance(); $b=$r["b"]; $c=$r["c"]; $l=$r["l"];$s=$r["s"];

print " ".w3."[".p.cpm[1].w3."]".p." User Name   ".panah.p.$l.n.
      " ".w3."[".p.cpm[1].w3."]".p." Faucet Token".panah.p.$c.n.
      " ".w3."[".p.cpm[1].w3."]".p." Balance     ".panah.p.$b.k." / ".p.$s.n.
      " ".p.line();
Faucet:
while(true){
    $r = get(web."/roll.html");
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
        tim($cektime);goto Faucet;
        }
    }
    $token = Ambil($r,"var token = '","';",1);
    $data  = "a=getBonusRoll&token=$token&challenge=false&response=false";
    $r = json_decode(post(web.'/system/ajax.php',$data),1);
    
    if($r['status'] == 200){
        success($r["reward"], $r["number"]); 
        print " ".line();   
    }else{
        echo " ".k.strip_tags($r['message']).r;
    }          
}

