<?php

if (!file_exists("Data")) {
	system("mkdir Data");
}
if (file_exists("User_Agent")) {
	$nama_file = "User_Agent";
	if(PHP_OS_FAMILY == "Windows"){
		system("move $nama_file Data");
	} else {
		system("mv $nama_file Data");
	}
}
Ban();

if(@rst::_CheckDataApi("Multibot_Apikey")) {
	Menu($a+=1,"Hapus APi Multibot");
	$tam[$a] = "multi";
}
if(@rst::_CheckDataApi("Xevil_Apikey")) {
	Menu($a+=1,"Hapus APi Xevil");
	$tam[$a] = "xevil";
}
if(@rst::_CheckDataApi("Shortlink_Apikey")) {
	Menu($a+=1,"Hapus APi Shortlink");
	$tam[$a] = "sl";
}
if($a > 0){
	Menu($a+=1,"Skip");
	$tam[$a] = "skip";
}
if($tam){
	$pil = readline(Isi("Nomor"));
	print d;
	if($pil == '' || $pil >= Count($tam)+1)exit(Error("Tolol"));
	if($tam[$pil] == "update"){
		system("git reset --hard");
		system("git pull");
		print Line();
		exit(Sukses("re run script if return succes"));
	}elseif($tam[$pil] == "multi"){
		unlink("Data/Apikey/Multibot_Apikey");
		print Sukses("Berhasil Menghapus Apikey Multibot");
		sleep(3);
	}elseif($tam[$pil] == "xevil"){
		unlink("Data/Apikey/Xevil_Apikey");
		print Sukses("Berhasil Menghapus Apikey Xevil");
		sleep(3);
	}elseif($tam[$pil] == "sl"){
		unlink("Data/Apikey/Shortlink_Apikey");
		print Sukses("Berhasil Menghapus Apikey Shortlink");
		sleep(3);
	}else{
	}
	Ban();
}
/************( MENU BOT )************/
menu_pertama:
print Len();
print /*mp.*/bl."┃".p.str_pad(strtoupper("menu"),40, " ", STR_PAD_BOTH).bl."┃".d.n;
print Len2();
$r = scandir("App/Bot");$a = 0;
foreach($r as $act){
	if($act == '.' || $act == '..') continue;
	$menu[$a] =  $act;
	Menu($a, $act);
	$a++;
}
$pil = readline(Isi("Nomor"));
print n;
if($pil == '' || $pil >= Count($menu))exit(Error("Tolol"));

menu_kedua:
print Len();
print bl."┃".p.str_pad(strtoupper("menu -> ".$menu[$pil]),40, " ", STR_PAD_BOTH).bl."┃".d.n;
print Len2();
$r = scandir("App/Bot/".$menu[$pil]);$a = 0;
foreach($r as $act){
	if($act == '.' || $act == '..') continue;
	$menu2[$a] =  $act;
	Menu($a, Clean($act));
	$a++;
}
Menu($a, m.'<< Back');
$pil2 = readline(Isi("Nomor"));
print n;
if($pil2 == '' || $pil2 > Count($menu2))exit(Error("Tolol"));
if($pil2 == Count($menu2))goto menu_pertama;
if(explode('-',$menu2[$pil2])[1])exit(Error("Tolol"));
$is_file = is_file("App/Bot/".$menu[$pil]."/".$menu2[$pil2]);
if($is_file){
	define("nama_file",clean($menu2[$pil2]));
	Ban(1);
	require "App/Bot/".$menu[$pil]."/".$menu2[$pil2];
	exit;
}
print Len();
print bl."┃".p.str_pad(strtoupper('menu -> '.$menu[$pil].' -> '.$menu2[$pil2]),40, " ", STR_PAD_BOTH).bl."┃".d.n;
print Len2();
$r = scandir("App/Bot/".$menu[$pil]."/".$menu2[$pil2]);$a=0;
foreach($r as $act){
	if($act == '.' || $act == '..') continue;
	$menu3[$a] =  $act;
	Menu($a, Clean($act));
	$a++;
}
Menu($a, m.'<< Back');
$pil3 = readline(Isi("Nomor"));
print n;
if($pil3 == '' || $pil3 > Count($menu3))exit(Error("Tolol"));
if($pil3 == Count($menu3))goto menu_kedua;
if(explode('-',$menu3[$pil3])[1])exit(Error("Tolol"));

define("nama_file",clean($menu3[$pil3]));
Ban(1);
require "App/Bot/".$menu[$pil]."/".$menu2[$pil2]."/".$menu3[$pil3];
