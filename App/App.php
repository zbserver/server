<?php
define("a","\033[1;30m");
define("d","\033[0m");
define("m","\033[1;31m");
define("h","\033[01;38;5;35m");
define("hm","\033[1;32m");
define("k","\033[1;33m");
define("b","\033[1;34m");
define("u","\033[1;35m");
define("c","\033[1;36m");
define("p","\033[1;37m");
define("o","\033[01;38;5;214m");
define("mp","\033[101m\033[1;37m");
define("hp","\033[102m\033[1;30m");
define("kp","\033[103m\033[1;37m");
define("bp","\033[104m\033[1;37m");
define("up","\033[105m\033[1;37m");
define("cp","\033[106m\033[1;37m");
define("pm","\033[107m\033[1;31m");
define("ph","\033[107m\033[1;32m");
define("pk","\033[107m\033[1;33m");
define("pb","\033[107m\033[1;34m");
define("pu","\033[107m\033[1;35m");
define("pc","\033[107m\033[1;36m");
define("rr","\r                                         \r");
define("r","\r");
define("n","\n");
define("line",p." ".str_repeat("─",55).n);
define("panah",k." › ");
define("panah1"," [›] ".p);
define("w",o);
define("w2",k);
define("w3",m);
define("cpm",["","√","+","-","!"]);
define("eng","1.0.1");
define("ApiError", Pesan(1,"Apikey").Pesan(0,"Error | 0 ").n);
define("App","App/App.php");
define("Server","https://raw.githubusercontent.com/zbserver/server/main/");
Function TimeZone(){$api = json_decode(file_get_contents("http://ip-api.com/json"),1);if($api){$tz = $api["timezone"];date_default_timezone_set($tz);return $api["country"];}else{date_default_timezone_set("UTC");return "UTC";}}
Function curl($u, $h = 0, $p = 0,$c = 0) {while(true){$ch = curl_init();curl_setopt($ch, CURLOPT_URL, $u);curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);curl_setopt($ch, CURLOPT_COOKIE,TRUE);curl_setopt($ch, CURLOPT_COOKIEFILE,"cookie.txt");curl_setopt($ch, CURLOPT_COOKIEJAR,"cookie.txt");if($p) {curl_setopt($ch, CURLOPT_POST, true);curl_setopt($ch, CURLOPT_POSTFIELDS, $p);}if($h) {curl_setopt($ch, CURLOPT_HTTPHEADER, $h);}curl_setopt($ch, CURLOPT_HEADER, true);$r = curl_exec($ch);$c = curl_getinfo($ch);if(!$c) return "Curl Error : ".curl_error($ch); else{$hd = substr($r, 0, curl_getinfo($ch, CURLINFO_HEADER_SIZE));$bd = substr($r, curl_getinfo($ch, CURLINFO_HEADER_SIZE));curl_close($ch);if(!$bd){print w3." Check Your Connection!";sleep(2);print "\r                             \r";continue;}return array($hd,$bd)[1];}}}
Function gas($url, $post = 0, $httpheader = 0, $proxy = 0){$ch = curl_init();curl_setopt($ch, CURLOPT_URL, $url);curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);curl_setopt($ch, CURLOPT_TIMEOUT, 60);curl_setopt($ch, CURLOPT_COOKIE,TRUE);if($post){curl_setopt($ch, CURLOPT_POST, true);curl_setopt($ch, CURLOPT_POSTFIELDS, $post);}if($httpheader){curl_setopt($ch, CURLOPT_HTTPHEADER, $httpheader);}if($proxy){curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, true);curl_setopt($ch, CURLOPT_PROXY, $proxy);}curl_setopt($ch, CURLOPT_HEADER, true);$response = curl_exec($ch);$httpcode = curl_getinfo($ch);if(!$httpcode) return "Curl Error : ".curl_error($ch); else{$header = substr($response, 0, curl_getinfo($ch, CURLINFO_HEADER_SIZE));$body = substr($response, curl_getinfo($ch, CURLINFO_HEADER_SIZE));curl_close($ch);return array($header, $body);}}
Function Efek($str,$usleep){$arr = str_split($str);foreach ($arr as $az){print $az;usleep($usleep);}}
Function Ambil($res,$depan,$belakang,$nomor){$data=explode($belakang,explode($depan,$res)[$nomor])[0];return $data;} 
Function Ambil_1($res,$pemisah){$data=explode($pemisah,$res)[0];return $data;}
Function AntiBot($res,$Nomor){$AntiBot = Ambil($res,'rel=\"','\"',$Nomor);return $AntiBot;}
Function Save($file){if(file_exists($file)) {$data = file_get_contents($file);}else{$data = readline(" ".k."Input ".p.$file." : ".n);print n;file_put_contents($file,$data);}return $data;}
Function multi($wallet){$tambah = readline(" ".w3."Input ".$wallet." :".p);$save = fopen($wallet, "a");fwrite($save, $tambah.n);fclose($save);sleep(1);print p." Success add ".w3.$wallet.n.p;sleep(1);}
Function get($url){return curl($url,h());}
Function post($url,$data){return curl($url,h(),$data);}
Function postt($url,$data, $ua){return curl($url, $data, $ua)[1]; }
Function line(){return p.str_repeat('─',55).n;}
Function FirCF($r){(preg_match('/Cloudflare/',$r) || preg_match('/Just a moment.../',$r))? $data['cf']=true:$data['cf']=false;return $data;}
Function getUserAgent(){
	$userAgentArray[] = "Mozilla/5.0 (Linux; Android 11; Pixel C Build/RQ1A.210205.004) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/89.0.4389.90 Safari/537.36 GNews/2021022310";
    $userAgentArray[] = "Mozilla/5.0 (Linux; Android 10; SM-G960F) AppleWebKit/537.36 (KHTML, like Gecko) Brave Chrome/89.0.4389.86 Mobile Safari/537.36";
    $userAgentArray[] = "Mozilla/5.0 (Linux; Android 9; SM-N976N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.40 Mobile Safari/537.36";
    $userAgentArray[] = "Mozilla/5.0 (Linux; Android 10; ZTE A2020G Pro) AppleWebKit/537.36 (KHTML, like Gecko) Brave Chrome/89.0.4389.86 Mobile Safari/537.36";
    $userAgentArray[] = "Mozilla/5.0 (Linux; Android 12; RMX3627 Build/SP1A.210812.016; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/116.0.0.0 Mobile Safari/537.36 [FB_IAB/FB4A;FBAV/430.0.0.23.113;]";
    $userAgentArray[] = "Mozilla/5.0 (Linux; Android 12; RMX3624 Build/SP1A.210812.016; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/99.0.4844.88 Mobile Safari/537.36 [FB_IAB/FB4A;FBAV/387.0.0.24.102;]";
	$getArrayKey = array_rand($userAgentArray);
	return $userAgentArray[$getArrayKey];
}
Function load(){
    print rr;
    $wait =[" Wait."," Wait.."," Wait..."," Wait...."," Wait....."," Wait......"];
    for($i=1; $i<3; $i++){
        foreach($wait as $waitt){
            usleep(400000);
            print $waitt.p.r;
        }
    }
    print rr;
}
Function bps_cap(){
    print rr;
    $delay =2;
    print w2." Bypass Captcha √";
    sleep($delay);
    print rr;}
Function bps_anbot(){
    print rr;
    $delay =2; 
    print w2." Bypass Antibot √";
    sleep($delay);
    print rr;
}
Function cl(){
    //error_reporting(0);
    system("clear");
    unlink("alom.tmp-15d94603.tmp.");
    unlink("tmp");
    unlink("cookie.txt");
}
Function Del(){
    $co=["cookie.txt",cok];
    unlink($co[0]);
    unlink($co[1]);
}
Function EngCek(){
    print hm."                    Checking Update ...";sleep(2);print r;
    system("clear");
    if(!is_dir("App")){
        system("mkdir App");
    }
    $x = file_get_contents(App);
    $r = file_get_contents(Server.App);
    $update = Ambil($r,'eng","','");',1);
    $old  = Ambil($x,'eng","','");',1);
    if($update > $old){
        unlink(App);
        file_put_contents(App,$r);
        Print hm."                    Engine Update v.$update".n.n;
        Print p."             Please re run [".k."php bot.php".p."]".n;die;
    }
    print p."                   Latest Version :".$x;sleep(2);print r;
}
Function Api_Bal($api_url){
    $apikey = file_get_contents("Data/Apikey");
	$r = json_decode(file_get_contents($api_url."/res.php?action=userinfo&key=".$apikey),1);
    if(!$r["balance"]){
        print ApiError;
    }
    return $r["balance"];
}
Function ban(){
    cl();
    echo p." ┌───────────┐┌────────────────────────────────────────┐".n;
    echo p." │".m."  ┌─┐┌┐┌┬┐ ".p."││ Bot Engine".panah.p.eng.n;
    echo p." │".m."  ┌─┘├┴┐│  ".p."││ Script    ".panah.m.host[0].n;
    echo p." │".m."  └─┘└─┘┴  ".p."││ Version   ".panah.p.version.n;
    echo p." │".p."  Zerobot  ".p."││ Status    ".panah.p."Free Not For Sale".n;
    echo p." └───────────┘└────────────────────────────────────────┘".n;
    echo line;
}
Function init(){
    cl();
    $r = file_get_contents(Server.App);
    if(!$r){
        file_put_contents(App);
        $x=file_get_contents(App);
        $d = Ambil($x,'eng","','");',1);
        print k." Downloaded Engine v".$d.n;
        Print p." Please re run [ ".k."php bot.php".p." ]".n;die;
    }
    $panah = array(w."●".p."●●●●",p."●".w."●".p."●●●",p."●●".w."●".p."●●",p."●●●".w."●".p."●",p."●●●●".w."●");
    print n.n.n.n.n.n.n.n;
    print "                      Initializing".n;
    for($i=1; $i<10; $i++){
        foreach($panah as $pan){
            usleep(200000);
            print "                        [".$pan."]".p.r;
        }
    }
    cl();
    EngCek();
}
Function tim($tmr){
    date_default_timezone_set("UTC");
    $panah = array(w."●".p."●●●●",p."●".w."●".p."●●●",p."●●".w."●".p."●●",p."●●●".w."●".p."●",p."●●●●".w."●");
    $rand = rand(1,5);
    $timr = (time()+$tmr)+$rand;
    while(true):
        foreach($panah as $pan){
            print r;$res=$timr-time();
            if($res < 1){break;}
            print p." ".date('H',$res).":".p.date('i',$res).":".p.date('s',$res)." | $pan"."\r";usleep(200000);
        }if($res < 1){break;}
    endwhile;  
}
Function RecaptchaV3($anchor){
    while(true){
        $r = curl($anchor,array());
        $token = Ambil($r,'<input type="hidden" id="recaptcha-token" value="','">',1);
        $sitekey = explode("&",$anchor)[1];
        $co = explode("&",$anchor)[2];
        $v = explode("&",$anchor)[4];
        $r = curl("https://www.google.com/recaptcha/api2/reload?".$sitekey,array(),"$v&reason=q&c=$token&$v&$co");
        $res = explode('"',explode('["rresp","',$r)[1])[0];
        if($res){return $res;}
    }
}
Function Captcha($source,$api_url,$apikey, $sitekey, $pageurl,$delay){
    if(preg_match("/h-captcha/",$source)){$r =  json_decode(file_get_contents($api_url."/in.php?key=".$apikey."&method=hcaptcha&sitekey=".$sitekey."&pageurl=".$pageurl."&json=1"),1);}
    if(preg_match("/g-recaptcha/",$source)){$r =  json_decode(file_get_contents($api_url."/in.php?key=".$apikey."&method=userrecaptcha&googlekey=".$sitekey."&pageurl=".$pageurl."&json=1"),1);}
    if(preg_match("/cf-turnstile/",$source)){$r =  json_decode(file_get_contents($api_url."/in.php?key=".$apikey."&method=turnstile&sitekey=".$sitekey."&pageurl=".$pageurl."&json=1"),1);}
    $status = $r["status"];
        if($status == 0){ApiError;return 0;}
        $id = $r["request"];
        while(true){
            load();
            $r = json_decode(file_get_contents($api_url."/res.php?key=".$apikey."&action=get&id=".$id."&json=1"),1);
            $status = $r["status"];
            if($r["request"] == "CAPCHA_NOT_READY"){print rr;load();sleep($delay);print rr;continue;}
            if($status == 1){print rr;print bps_cap();return $r["request"];}
            return 0;
        }
}
Function anti_bot($source,$api_url,$apikey,$delay){
	$main = explode('"',explode('<img src="',explode('Bot links',$source)[1])[1])[0];
	$antiBot["main"] = $main;
	$src = explode('rel=\"',$source);
	foreach($src as $x => $sour){
		if($x == 0)continue;
		$no = explode('\"',$sour)[0];
		$img = Ambil($sour,'<img src=\"','\"',1);
		$antiBot[$no] = $img;
	}
	$ua = "Content-type: application/x-www-form-urlencoded";
	$data = ["key"=>$apikey,"method"=>"antibot","json"=>1] + $antiBot;
	$opts = ['http' =>['method'  => 'POST','header' => $ua,'content' => http_build_query($data)]];
	$r = json_decode(file_get_contents($api_url.'/in.php', false, stream_context_create($opts)),1);
	$id = $r["request"];
	while(true){
		load();
		$r = json_decode(file_get_contents($api_url."/res.php?key=".$apikey."&action=get&id=".$id."&json=1"),1);
		$status = $r["status"];
		if($r["request"] == "CAPCHA_NOT_READY"){print rr;load();sleep($delay);print rr;continue;}
		if($status == 1){print rr;print bps_anbot();$r["request"];return "+".str_replace(",","+",$r["request"]);}
		return 0;
	}
}
Function Pesan($data=null,$isi){
    $len = 9;$lenstr = $len-strlen($isi);
    if($data == 1 ){
        return w3." [".p.$isi.str_repeat(" ",$lenstr).w3."]".panah.p;
    }elseif($data == 0){
        return w3."[".p.$isi.w3."]".p;
    }
}
Function Menu($no, $menu){
    return print w3." [".p.$no.w3."] ".p.$menu.n;
}
Function Select($str){
    return print w3." [".p."Input ".$str.w3."] ".n." ".p;
}
Function Riwayat($newdata,$data=0){
    if(!$data){$data = [];}
    return array_merge($data,$newdata);
}
Function SaveCokUa(){
    cl();
    ban();
    if(!file_exists(cok)){
        Print p." cookie :".n;
        Save(cok);
    }
    if(!file_exists(uag)){
        Print p." useragent :".n;
        Save(uag);
    }
}
