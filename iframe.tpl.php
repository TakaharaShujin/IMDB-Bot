<!DOCTYPE html>
<html lang="tr">
<head>
	<meta charset="UTF-8">
	<title><?=$film->isim?> Bilgileri</title>
	<link rel="stylesheet" href="<?=SITEURL?>/assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?=SITEURL?>/assets/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?=SITEURL?>/assets/css/iframe.css" />
</head>
<body>
	<div class="container">
		<div class="row film-box">
			<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
				<div class="left-block">
					<div class="thumbnail">
						<div class="star"><span class="text"><?=$film->puan?></span></div>
						<img src="<?=$film->resim?>" alt="<?=$film->isim?>">
					</div>
					<a href="<?=$film->url?>" class="btn btn-primary btn-block" target="_blank">IMDb Sayfası</a>
				</div>
			</div>
			<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
				<div class="title">
					<h3><?=$film->isim?></h3>
				</div>
				<table class="table table-striped table-bordered">
					<tbody>
						<tr><th>Ülke</th><td><?=$film->ulke?></td></tr>
						<tr><th>Yönetmen</th><td><?=$film->yonetmenler?></td></tr>
						<tr><th>Senarist</th><td><?=$film->senaristler?></td></tr>
						<tr><th>Yayın Tarihi</th><td><?=$film->yayintarihi?></td></tr>
						<tr><th>Özet</th><td><?=$film->ozet?></td></tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</body>
</html>