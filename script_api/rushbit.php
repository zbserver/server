<?php
define('host',['Rushbitcoin','Rushbitcoin.com','']);
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
    $h[] = "accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7";
    $h[] = "cookie: ".file_get_contents(Data.cok);
    $h[] = "user-agent: ".file_get_contents(Data.uag);
    return $h;
}
Function balance(){
    $r    = get(web."?page=shortlinks");
    $log  = Ambil($r,'<font class="text-success">','</font>',1);
    $coin = Ambil($r,'<div class="text-warning"><b>','</b>',1);
    $bal  = Ambil($r,'<div class="text-primary"><b>','</b>',1);
    return ["b"=>$bal,"c"=>$coin,"l"=>$log];
}
Function success($reward,$nub){
    $r=balance(); $b =$r["b"]; $c=$r["c"];
    print " ".w3."[".p.cpm[1].w3."]".p." Lucky Number".panah.p.$nub.k." / ".p.$reward." Bits".n;
    print " ".w3."[".p.cpm[2].w3."]".p." Balance     ".panah.p.$b.k." / ".p.$c.n;
    print " ".line();
}
Function Login(){
    $r = balance(); $b = $r["b"]; $c= $r["c"];$l=$r["l"];
    if(!$l){print " ".w3."[".p.cpm[1].w3."]".k." Cookie Experied   ".n; del();sleep(2);die;}
    print p." Login Success".r;sleep(2);
    print " ".w3."[".p.cpm[1].w3."]".p." Login   ".panah.p.$l.n.
          " ".w3."[".p.cpm[1].w3."]".p." Balance ".panah.p.$b.p." / ".p.$c.n.
          " ".p.line();
    Faucet:
    while(true){
        $r = get(web);
        if(preg_match('/Faucet Locked!/',$r)){print p." Faucet locked. ".p."You must visit 10 more Shortlinks today".n;die();}
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
        $token = Ambil($r,"var token = '","';",1);
        $data  = "a=getFaucet&token=$token&challenge=false&response=false";
        $r = json_decode(post(web.'/system/ajax.php',$data),1);
        if($r['status'] == 200){
            success($r["reward"], $r["number"]);    
        }else{
            echo k.strip_tags($r['message']).r;
        }
    }
}
Login();
