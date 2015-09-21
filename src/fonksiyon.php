<?php

$siteadresi = "http://siteadresi.com/bot"; // Site Adresinizi Girin (Sonunda "/" işareti olmamalı.)

/* Fonksiyonlar */
## Ülke İsimlerini Türkçe'ye Çevirir
function ulkelerTurkce($ulkeadi) {
		$ingilizce = array('France','Spain','Iceland','Ireland','Canada','USA','UK','Sweden','Denmark','Turkey','Azerbaijan','Iraq','Italy','Netherlands','Holland','Netherland','Israel','Germany','Switzerland','Poland','India','Saudi Arabia','Russia','Latvian','Austria','Australia','New Zeland','New Zealand','China','Japan','South Korea','North Korea','Afghanistan','Syria');
		$turkce = array('Fransa','İspanya','İzlanda','İrlanda','Kanada','ABD','İngiltere','İsveç','Danimarka','Türkiye','Azerbeycan','Irak','İtalya','Hollanda','Hollanda','Hollanda','İsrail','Almanya','İsviçre','Polonya','Hindistan','Suudi Arabistan','Rusya','Letonya','Avusturya','Avustralya','Yeni Zelanda','Yeni Zelanda','Çin','Japonya','Güney Kore','Kuzey Kore','Afganistan','Suriye');
		$degistir = str_replace($ingilizce,$turkce,$ulkeadi);
		return $degistir;
	}
## Curl Bağlantısı
function curlbaglan($adres) {
	
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $adres);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER["HTTP_USER_AGENT"]);
	curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
	$sonuc = curl_exec($curl);
	curl_close($curl);
	$temizle = str_replace(array("\n","\t","\r"), null, $sonuc);
	return $temizle;
	
}
## Dosya Kaydederken İsimdeki Türkçe Karakterleri, Özel Karakterleri ve Boşlukları Kaldırma
function cevir($s) {
 $tur = array('ş','Ş','ı','I','İ','ğ','Ğ','ü','Ü','ö','Ö','Ç','ç','(',')','/',':',',');
 $ing = array('s','s','i','i','i','g','g','u','u','o','o','c','c','','','-','-','');
 $s = str_replace($tur,$ing,$s);
 $s = strtolower($s);
 $s = preg_replace('/&amp;amp;amp;amp;amp;amp;amp;amp;amp;.+?;/', '', $s);
 $s = preg_replace('/\s+/', '-', $s);
 $s = preg_replace('|-+|', '-', $s);
 $s = preg_replace('/#/', '', $s);
 $s = str_replace('.', '', $s);
 $s = trim($s, '-');
 return $s;
}
/* Fonksiyonlar Son */
?>