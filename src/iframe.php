<?php
require "fonksiyon.php";
?>
<?php
$getimdb = $_GET['imdb'];
$genislik = $_GET['g'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<title>IMDb Bot</title>
	<link rel="stylesheet" href="bootstrap-3.3.5-dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="loader.css" />
	<script type="text/javascript" src="jquery-1.9.1.min.js"></script>
	<link rel="stylesheet" href="style.css" />
	
	<style type="text/css">
	body,html,#sonuc,.container-fluid {padding: 0; margin: 0;}
	#sonuc {width: <?php echo $genislik; ?>px}
	<?php if($genislik <= 500) {echo '#sonuc .poster img {width:170px; height:230px} #sonuc .poster {width:170px; height:240px;} #sonuc .sag {font-size:13px;}';} ?>
	</style>
	
</head>
<body>
<?php
$imdb = curlbaglan($getimdb);
include "alanlar.php";
echo '
<div class="container-fluid">
<div id="sonuc">
<div class="bilgiler">
<div class="poster"><img src="'.$filmresim.'" alt="imdb"/><div class="puan">'.$filmpuan.'</div></div>
<div class="sag">
<h3>'.$filmisim.' <small style="float:right"><a href="'.$getimdb.'" target="_blank"><i class="glyphicon glyphicon-new-window" style="font-size:12px"></i> imdb sayfası</a></small></h3>
<label for="ulke">Ülke:</label> <span id="ulke">'.$filmulke.'</span> <br />
';if($filmyonetmen != "") {echo '<label for="senarist">Yönetmen:</label> <span id="senarist">'.$filmyonetmen.'</span> <br />';}echo '
<label for="senarist">Senarist:</label> <span id="senarist">'.$filmsenarist.'</span> <br />
<label for="tarih">Yayın Tarihi:</label> <span id="tarih">'.$yayintarihi.'</span> <br />
<label for="tarih">Özet:</label> <p id="tarih">'.$filmozet.'</p> <br />
</div>
</div>
</div>
</div>
';


?>
</body>
</html>