<?php
require "fonksiyon.php";
?>
<?php
$postimdb = $_POST['imdb'];
$imdb = curlbaglan($postimdb);
$sonuc = array();
include "alanlar.php";
if($filmyonetmen == "") {
$sonuc["basarili"] = '

<div id="sonuc">
<div class="bilgiler">
<div class="poster"><img src="'.$filmresim.'" alt="imdb"/><div class="puan">'.$filmpuan.'</div></div>
<div class="sag">
<h3>'.$filmisim.' <small style="float:right"><a href="'.$postimdb.'" target="_blank"><i class="glyphicon glyphicon-new-window" style="font-size:12px"></i> imdb sayfası</a></small></h3>
<label for="ulke">Ülke:</label> <span id="ulke">'.$filmulke.'</span> <br />
<label for="senarist">Senarist:</label> <span id="senarist">'.$filmsenarist.'</span> <br />
<label for="tarih">Yayın Tarihi:</label> <span id="tarih">'.$yayintarihi.'</span> <br />
<label for="tarih">Özet:</label> <p id="tarih">'.$filmozet.'</p> <br />
</div>
</div>
</div>
<br />
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">iFrame Kodu</h3>
  </div>
  <div class="panel-body">
<label for="genislik">iFrame Genişliği:</label>&nbsp;<input class="giris" id="genislik" value="600" type="number" />px<br /><br />
&lt;iframe src=&quot;'.$siteadresi.'/iframe.php?imdb='.$postimdb.'&g=<div class="sonuc" id="genislik">600</div>&quot; frameborder=&quot;0&quot; style=&quot;padding: 0; margin: 0&quot; scrolling=&quot;no&quot; height=&350;auto&quot; width=&quot;<div class="sonuc" id="genislik">600</div>&quot;&gt;&lt;/iframe&gt;
  </div>
</div>
<script type="text/javascript">
$("input.giris").bind("keyup change", function(e) {
	genislik = $("input#genislik").val();
    $("div#genislik").html(genislik);
})
</script>
';
}
else {
$sonuc["basarili"] = '
<div id="sonuc">
<div class="bilgiler">
<div class="poster"><img src="'.$filmresim.'" alt="imdb"/><div class="puan">'.$filmpuan.'</div></div>
<div class="sag">
<h3>'.$filmisim.' <small style="float:right"><a href="'.$postimdb.'" target="_blank"><i class="glyphicon glyphicon-new-window" style="font-size:12px"></i> imdb sayfası</a></small></h3>
<label for="ulke">Ülke:</label> <span id="ulke">'.$filmulke.'</span> <br />
<label for="senarist">Yönetmen:</label> <span id="senarist">'.$filmyonetmen.'</span> <br />
<label for="senarist">Senarist:</label> <span id="senarist">'.$filmsenarist.'</span> <br />
<label for="tarih">Yayın Tarihi:</label> <span id="tarih">'.$yayintarihi.'</span> <br />
<label for="tarih">Özet:</label> <p id="tarih">'.$filmozet.'</p> <br />
</div>
</div>
</div>
<br />
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">iFrame Kodu</h3>
  </div>
  <div class="panel-body">
<label for="genislik">iFrame Genişliği:</label>&nbsp;<input class="giris" id="genislik" value="600" type="number" />px<br /><br />
&lt;iframe src=&quot;'.$siteadresi.'/iframe.php?imdb='.$postimdb.'&g=<div class="sonuc" id="genislik">600</div>&quot; frameborder=&quot;0&quot; style=&quot;padding: 0; margin: 0&quot; scrolling=&quot;no&quot; height=&quot;350&quot; width=&quot;<div class="sonuc" id="genislik">600</div>&quot;&gt;&lt;/iframe&gt;
  </div>
</div>
<script type="text/javascript">
$("input.giris").bind("keyup change", function(e) {
	genislik = $("input#genislik").val();
    $("div#genislik").html(genislik);
})
</script>
';	
}
echo json_encode($sonuc);
?>