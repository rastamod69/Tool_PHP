const
title = "ltchunt",
versi = " 1.0",
status = "online",
host = "https://ltchunt.com/",
host1 = "https://dripoffers.com/",
host2 = "https://offerwall.me/",
host3 = "https://offerwhales.com/";

function h($xml = 0, $img = 0){
	$h[]	= "Host: ".parse_url(host)['host'];
	if($xml){
		$h[]	= "X-Requested-With: XMLHttpRequest";
	}
	if($img){
        $h[] = "accept: image/avif,image/webp,image/apng,image/svg+xml,image/*,*/*;q=0.8";
    }
	$h[]	= "cookie: ".Simpan("Cookie");
	$h[]	= "user-agent: ".ua();
	return $h;
}
function h1($xml=0){
	if($xml){
		$h[] = "x-requested-with: XMLHttpRequest";
	}
	$h[] = "cookie: ".Simpan("Cookie_dripoffers.com");
	$h[] = "user-agent: ".ua();
	return $h;
}
function h2($xml=0){
	if($xml){
		$h[] = "x-requested-with: XMLHttpRequest";
	}
	$h[] = "cookie: ".Simpan("Cookie_offerwall.me");
	$h[] = "user-agent: ".ua();
	return $h;
}
function dash(){
	$r = Curls(host.'ptc.html',h())[1];
	$user = explode('</font>',explode('<font class="text-success">',$r)[1])[0];
	$bal = explode('Litoshi</b>',explode('Account Balance <div class="text-primary"><b>',$r)[1])[0];
	$btc = explode('</b></div></div>',explode('<div class="text-success"><b>',$r)[1])[0];
	return ["user"=>$user,"bal"=>$bal,"btc"=>$btc];
}
#Banner
bn(1);
cookie:
$cookie =simpan("Cookie");
$cookie1 =simpan("Cookie_dripoffers.com");
$cookie2 = simpan("Cookie_offerwall.me");
Simpan("Cookie_games.offerwhales");
$uagent =ua();

bn(1);
#Execute
$r = dash();
if(!$r["user"]){
	print m."Cookie expired".n;
	print line();
	hapus("Cookie");
	goto cookie;
}
Cetak("Username",$r["user"]);
Cetak("Balance",$r["balance"].'-'.$r["value"]);
print line();

while(true){
	$r = Curls(host.'ptc.html',h())[1];
	$id = explode('">',explode('<div class="website_block" id="',$r)[1])[0];
	if($id){
		print "\r                            \r";
		print o."Bypass..";
		$key = explode("',",explode("&key=",$r)[1])[0];
		$r = Curls(host.'surf.php?sid='.$id.'&key='.$key,h())[1];
		$token = explode("';",explode("var token = '",$r)[1])[0];
		$tmr = explode(";",explode('var secs = ',$r)[1])[0];
		sleep($tmr);
		
		$a = 0;
		while($a < 20){
			$a++;
			print "\r                            \r";
			print p."Bypass..";
			$data = "cID=0&rT=1&tM=light";
			$arr = ["X-Requested-With: XMLHttpRequest"];
			$r = json_decode(Curls(host.'system/libs/captcha/request.php',array_merge($arr,h()),$data)[1],1);
			
			$data = "cID=0&pC=".($r)[1]."&rT=2";
			Curls(host.'system/libs/captcha/request.php',array_merge($arr,h()),$data)[1];
			
			$data = "a=proccessPTC&data=".$id."&token=".$token."&captcha-idhf=0&captcha-hf=".($r)[1];
			$r = json_decode(Curls(host.'system/ajax.php',h(),$data)[1],1);
			if($r["status"] == 200){
				print "\r                            \r";
				print p."Success  -> ".h.str_replace(" SUCCESS ","",strip_tags($r["message"])).n;
				print p."Balance  -> ".p.dash()["bal"].n;
				print line();
				break;
			}else{
				print "\r                            \r";
				print o."Bypass....";
				sleep(3);
			}
		}
	}else{
		break;
	}
}

wal:
	$r = Curls(host.'offers/dripoffers.html',h())[1];
	$id = explode('"',explode('<iframe src="https://dripoffers.com/offerwall/',$r)[1])[0];
		$r = Curls(host1.'offerwall/'.$id,h1())[1];
		$token = explode("';",explode("var token = '",$r)[1])[0];
		$data = "type=ptc&token=".$token."&action=switch_cat";
		$r = Curls(host1.'offerwall/'.$id,h1(),$data)[1];
		$ok = explode('<\/b><\/div>"}',explode('role=\"alert\"><b>',$r)[1])[0];
		if($ok){
		    print line();
		    print m."Offerwall1 Finished".n;
		    print line();
		    goto wal2;
		    }
		print m."Visit Ptc";
		print "\r                                       \r";
		$has = explode('\"',explode('data-hash=\"',$r)[1])[0];
		$iid = explode('\"',explode('data-sid=\"',$r)[1])[0];
		$key = explode('\"',explode('data-key=\"',$r)[1])[0];
		$data = "hash=".$has."&sid=".$iid."&key=".$key."&type=ptc&token=".$token."&action=init_transaction";
		$r = Curls(host1.'offerwall/'.$id,h1(),$data)[1];
		$cod = explode('"}',explode('/1941\/',$r)[1])[0];
		$hash = explode('\/',explode('https:\/\/dripoffers.com\/lead\/',$r)[1])[0];
		$r = Curls(host1.'lead/'.$hash.'/yq2q8pig8gtrc76tbpitr09djig9sg/1941/'.$cod,h1())[1];
		$tmr = explode(';',explode('var duration = ',$r)[1])[0];
		$tok = explode("';",explode("var token = '",$r)[1])[0];
		tmr($tmr);
		while(true){
			print m."Trying Bypass";
			
			$data	= "cID=0&rT=1&tM=light";
			$arr = ["X-Requested-With: XMLHttpRequest"];
			$r = json_decode(Curls(host1.'system/libraries/captcha/request.php',array_merge($arr,h1()),$data)[1],1);
			$capt	= "cID=0&pC=".($r)[2]."&rT=2";
			Curls(host1.'system/libraries/captcha/request.php',array_merge($arr,h1()),$capt)[1];
			$data = "hash=".$hash."&sub_id=".$iid."&key=".$key."&token=".$tok."&captcha-idhf=0&captcha-hf=".($r)[2]."&action=proccessLead";
			$r = json_decode(Curls(host1."/system/ajax.php",h1(),$data)[1])->message;
			$msg = explode('</b>',explode('<div class="alert alert-success" role="alert"><i class="fa fa-check-circle fa-fw"></i> <b>',$r)[1])[0];
			$err = explode(' please try again!</div>',explode('<div class="alert alert-danger" role="alert"><i class="fa fa-exclamation-triangle fa-fw"></i> ',$r)[1])[0];
			print "\r                                   \r";
			if($msg == "SUCCESS!"){
				$ss =	trim(explode('</div>',explode('class="fa fa-check-circle fa-fw"></i> <b>SUCCESS!</b> ',$r)[1])[0]);
				print h.$ss.n;
				goto wal;
			}else{
				print m.$err;
				sleep(2);
				print "\r                   \r";
				$num	=	$num+1;
				if($num	==	20){
					print m.'Refresh Time';
					sleep(10);
					print "\r                   \r";
					$num = 1;
					goto wal;
				}
			}
		}

wal2:
		$r = Curls(host.'offers/offers4crypto.html',h())[1];
	  $id = explode('/1941"',explode('<iframe src="https://offers4crypto.xyz/offerwall/',$r)[1])[0];
		$r = Curls(host2.'offerwall/'.$id.'/1941?key='.$id.'&sub_id=1941',h2())[1];
		$token = explode("';",explode("var token = '",$r)[1])[0];
		$data = "type=ptc&token=".$token."&action=switch_cat";
		$r = Curls(host2.'offerwall/'.$id.'/1941?key='.$id.'&sub_id=1941',h2(),$data)[1];
		$ok = explode('<\/b><\/div>"}',explode('role=\"alert\"><b>',$r)[1])[0];
		if($ok){
		    print line(); 
		    print m."Offerwall2 Finished".n;
		    print line();
		    exit;
		    }
		print m."Visit Ptc";
		print "\r                                       \r";
		$has = explode('\"',explode('data-hash=\"',$r)[1])[0];
		$iid = explode('\"',explode('data-sid=\"',$r)[1])[0];
		$key = explode('\"',explode('data-key=\"',$r)[1])[0];
		$data = "hash=".$has."&sid=".$iid."&key=".$key."&type=ptc&token=".$token."&action=init_transaction";
		$r = Curls(host2.'offerwall/'.$id.'/1941?key='.$id.'&sub_id=1941',h2(),$data)[1];
		$cod = explode('"}',explode('/1941\/',$r)[1])[0];
		$hash = explode('\/',explode('https:\/\/offerwall.me\/lead\/',$r)[1])[0];
		$r = Curls(host2.'lead/'.$hash.'/'.$id.'/'.$iid.'/'.$cod,h2())[1];
		$tmr = explode(';',explode('var duration = ',$r)[1])[0];
		$tok = explode("';",explode("var token = '",$r)[1])[0];
		tmr($tmr);
		while(true){
			print m."Trying Bypass";
			
			$data	= "cID=0&rT=1&tM=light";
			$arr = ["X-Requested-With: XMLHttpRequest"];
			$r = json_decode(Curls(host2.'system/libraries/captcha/request.php',array_merge($arr,h2()),$data)[1],1);
			$capt	= "cID=0&pC=".($r)[2]."&rT=2";
			Curls(host2.'system/libraries/captcha/request.php',array_merge($arr,h2()),$capt)[1];
			$data = "hash=".$hash."&sub_id=".$iid."&key=".$key."&token=".$tok."&captcha-idhf=0&captcha-hf=".($r)[2]."&action=proccessLead";
			$r = json_decode(Curls(host2."/system/ajax.php",h2(),$data)[1])->message;
			
			$msg = explode('</b>',explode('<div class="alert alert-success" role="alert"><i class="fa fa-check-circle fa-fw"></i> <b>',$r)[1])[0];
			$err = explode(' please try again!</div>',explode('<div class="alert alert-danger" role="alert"><i class="fa fa-exclamation-triangle fa-fw"></i> ',$r)[1])[0];
			print "\r                                   \r";
			if($msg == "SUCCESS!"){
				$ss =	trim(explode('</div>',explode('class="fa fa-check-circle fa-fw"></i> <b>SUCCESS!</b> ',$r)[1])[0]);
				print h.$ss.n;
				goto wal2;
			}else{
				print m.$err;
				sleep(2);
				print "\r             \r";
				$num	=	$num+1;
				if($num	==	20){
					print m.'Refresh Time';
					sleep(10);
					print "\r              \r";
					$num = 1;
					goto wal2;
				}
			}
}
