<?php

/**
* Fonksiyon Sınıfı
*/
class Func
{
	public static function entotrcountry($name)
	{
		$en = array('France','Spain','Iceland','Ireland','Canada','USA','UK','Sweden','Denmark','Turkey','Azerbaijan','Iraq','Italy','Netherlands','Holland','Netherland','Israel','Germany','Switzerland','Poland','India','Saudi Arabia','Russia','Latvian','Austria','Australia','New Zeland','New Zealand','China','Japan','South Korea','North Korea','Afghanistan','Syria');
		$tr = array('Fransa','İspanya','İzlanda','İrlanda','Kanada','ABD','İngiltere','İsveç','Danimarka','Türkiye','Azerbeycan','Irak','İtalya','Hollanda','Hollanda','Hollanda','İsrail','Almanya','İsviçre','Polonya','Hindistan','Suudi Arabistan','Rusya','Letonya','Avusturya','Avustralya','Yeni Zelanda','Yeni Zelanda','Çin','Japonya','Güney Kore','Kuzey Kore','Afganistan','Suriye');
		return str_replace($en,$tr,$name);
	}

	public static function curl($adress)
	{
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $adress);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER["HTTP_USER_AGENT"]);
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($curl,CURLOPT_HTTPHEADER,array('Accept-Language: tr-TR,tr;q=0.8,en-US;q=0.5,en;q=0.3'));
		$sonuc = curl_exec($curl);
		curl_close($curl);
		return str_replace(array("\n","\t","\r"), null, $sonuc);
	}

	public static function filmsplitter($url)
	{
		$raw = Func::curl($url);

		$film = new StdClass();
		$film->url = $url;

		/**
		*	Film Adı
		*/
		preg_match('#<span class="itemprop" itemprop="name">(.*?)</span>#', $raw, $isimRaw);
		$film->isim = @$isimRaw[1];

		/**
		*	Film Posteri
		*/
		preg_match('#<div class="image"><a href="(.*?)"> <img height="(.*?)"width="(.*?)"alt="(.*?)"title="(.*?)"src="(.*?)"itemprop="image" /></a>                            </div>#', $raw, $resimRaw);
		if (empty(@$resimRaw[6])) {
			$film->resim = POSTER;
		} else {
			$film->resim = 'data:image/jpeg;base64,' . base64_encode(file_get_contents(@$resimRaw[6]));
		}



		/**
		*	Ülke
		*/
		preg_match('#<div class="txt-block">    <h4 class="inline">Country:</h4>        (.*?)    </div>#',$raw,$ulkealani);
		preg_match_all('#<a(.*?)>(.*?)</a>#', @$ulkealani[1], $ulkelerRaw);
		$ulkelerRaw = @$ulkelerRaw[2];
		for($i = 0; $i < count($ulkelerRaw); $i++)
			$ulkeler[$i] = Func::slug($ulkelerRaw[$i]);
		$film->ulke = count($ulkelerRaw) == 1 ? Func::slug(@$ulkelerRaw[0]) : implode(", ",$ulkeler);

		/**
		*	Yayın Tarihi
		*/
		preg_match('#<meta itemprop="datePublished" content="(.*?)" />#', $raw, $tarihRaw);
		$film->yayintarihi = date("d.m.Y", strtotime(@$tarihRaw[1]));

		/**
		*	Puanı
		*/
		preg_match('#<span itemprop="ratingValue">(.*?)</span>#', $raw, $puan);
		$film->puan=@$puan[1];

		/**
		*	Yönetmenler
		*/
		preg_match('#<div class="txt-block" itemprop="director"(.*?)>(.*?)</div>#', $raw, $yonetmenalani);
		preg_match_all('#<a(.*?)><span(.*?)>(.*?)</span></a>#', @$yonetmenalani[2], $yonetmenRaw);
		$yonetmenRaw = @$yonetmenRaw[3];
		for($i = 0; $i < count($yonetmenRaw); $i++)
			$yonetmenler[$i]= $yonetmenRaw[$i];
		if(count($yonetmenRaw) > 1)
			$film->yonetmenler = implode(", ",$yonetmenler);
		else
			$film->yonetmenler = @$yonetmenler[0];

		/**
		*	Senarist
		*/
		preg_match('#<div class="txt-block" itemprop="creator" itemscope itemtype="(.*?)">(.*?)</div>#',$raw,$senaristalani);
		preg_match_all('#<a href="(.*?)"(.*?)><span class="itemprop" itemprop="(.*?)">(.*?)</span></a>#', @$senaristalani[2],$senaristRaw);
		$senaristRaw = @$senaristRaw[4];
		for($i = 0; $i < count($senaristRaw); $i++)
			$filmsenaristleri[$i]= $senaristRaw[$i];
		if(count($senaristRaw) > 1)
			$film->senaristler = implode(", ",$filmsenaristleri);
		else
			$film->senaristler = @$filmsenaristleri[0];

		/**
		*	Özet
		*/
		preg_match('#<p itemprop="description">(.*?)</p>#', $raw, $ozetRaw);

		$film->ozet = strstr(@$ozetRaw[1], 'Add a Plot') ? 'Özet bulunmamaktadır..' : @$ozetRaw[1];

		return $film;
	}

	public static function slug($str)
	{
		$tr = array('ş','Ş','ı','I','İ','ğ','Ğ','ü','Ü','ö','Ö','Ç','ç','(',')','/',':',',');
		$en = array('s','s','i','i','i','g','g','u','u','o','o','c','c','','','-','-','');
		$str = str_replace($tr,$en,$str);
		$str = preg_replace('/&amp;amp;amp;amp;amp;amp;amp;amp;amp;.+?;/', '', $str);
		$str = preg_replace('/\s+/', '-', $str);
		$str = preg_replace('|-+|', '-', $str);
		$str = preg_replace('/#/', '', $str);
		$str = str_replace('.', '', $str);
		$str = trim($str, '-');
		return $str;
	}

	public static function json($data, $code)
	{
		header('Content-type: application/json; charset: utf8');
		http_response_code($code);
		return json_encode($data);
	}
}