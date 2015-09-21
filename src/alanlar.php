<?php

preg_match('#<span class="itemprop" itemprop="name">(.*?)</span>#', $imdb, $isim);
$filmisim = $isim[1];
preg_match('#<div class="image"><a href="(.*?)"> <img height="(.*?)"width="(.*?)"alt="(.*?)"title="(.*?)"src="(.*?)"itemprop="image" /></a>                            </div>#', $imdb, $resim);
$filmresim = $resim[6];
/* Film Ülke */
				preg_match('#<div class="txt-block">    <h4 class="inline">Country:</h4>        (.*?)    </div>#',$imdb,$ulkealani);
				preg_match_all('#<a(.*?)>(.*?)</a>#',$ulkealani[1],$ulkeler);
				$ulkead = $ulkeler[2];
				for($i = 0; $i < count($ulkead); $i++) {
				$filmulkeller[$i]= ''.ulkelerTurkce($ulkead[$i]).'';
				}
				$ulkesayisi = count($ulkead);
				if($ulkesayisi == 1) {
					$filmulke= ulkelerTurkce($ulkead[0]);
				}
				else {
					$filmulke=implode(", ",$filmulkeller);
				}
/* Film Ülke Son */
preg_match('#<meta itemprop="datePublished" content="(.*?)" />#', $imdb, $tarih);
$yayintarihi1 = $tarih[1];
$yayintarihi2 = strtotime($yayintarihi1);$yayintarihi = date("d.m.Y", $yayintarihi2);
preg_match('#<span itemprop="ratingValue">(.*?)</span>#', $imdb, $puan);
$filmpuan=$puan[1];
/* Yönetmen */
preg_match('#<div class="txt-block" itemprop="director"(.*?)>(.*?)</div>#', $imdb, $yonetmenalani);
preg_match_all('#<a(.*?)><span(.*?)>(.*?)</span></a>#', $yonetmenalani[2], $yonetmenler);
$yonetmenadi = $yonetmenler[3];
for($i = 0; $i < count($yonetmenadi); $i++) {
	$filmyonetmenleri[$i]= $yonetmenadi[$i];
}
if(count($yonetmenadi) > 1) {$filmyonetmen = implode(", ",$filmyonetmenleri);} else {$filmyonetmen = $filmyonetmenleri[0];}
/* Yönetmen Son */
/* Senarist */
preg_match('#<div class="txt-block" itemprop="creator" itemscope itemtype="(.*?)">(.*?)</div>#',$imdb,$senaristalani);
preg_match_all('#<a href="(.*?)"(.*?)><span class="itemprop" itemprop="(.*?)">(.*?)</span></a>#',$senaristalani[2],$senaristler);
$senaristadi = $senaristler[4];
for($i = 0; $i < count($senaristadi); $i++) {
$filmsenaristleri[$i]= $senaristadi[$i];
}
if(count($senaristadi) > 1) {$filmsenarist = implode(", ",$filmsenaristleri);} else {$filmsenarist = $filmsenaristleri[0];}
/* Senarist Son */
preg_match('#<p itemprop="description">(.*?)</p>#', $imdb, $ozet);
$filmozet = $ozet[1];

?>