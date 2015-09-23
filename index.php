<?php require_once 'conf.php'; ?>
<!DOCTYPE html>
<html lang="tr">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<title>IMDb Bot</title>
	<link rel="stylesheet" href="<?=SITEURL?>/assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?=SITEURL?>/assets/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?=SITEURL?>/assets/css/style.css" />
</head>
<body>
	<div class="container">
		<div class="header">
			<div class="row">
				<div class="col-lg-8">
					<a class="brand" href="<?=SITEURL?>">
						<h1>IMDb Bot</h1>
						<h4>IMDb.com üzerinden film/dizi verileri çeker.</h4>
					</a>
				</div>
				<div class="col-lg-4">
					<ul class="nav nav-pills menu">
						<li><a href="http://imdbtest.com/imdb.php?type=html" class="tooltips" title="Dökümantasyon" data-placement="bottom"><i class="fa fa-book"></i></a></li>
						<li><a href="#" class="tooltips" title="İndir" data-placement="bottom"><i class="fa fa-download"></i></a></li>
						<li><a href="#" class="tooltips" title="Github" data-placement="bottom"><i class="fa fa-github-alt"></i></a></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="well panel-app">
			<div class="row">
				<div class="col-lg-4">
					<div id="ohsnap"></div>
					<form id="imdbform" class="tools" onsubmit="return false" action="<?=SITEURL?>/imdb.php?type=html" method="post">
						<div class="form-group">
							<label>IMDb Linki</label>
							<input type="text" class="form-control" name="url" maxlength="37" placeholder="http://imdb.com/title/tt3042408">
						</div>
						<div class="form-group">
							<label>İframe Genişliği</label>
							<input type="text" class="form-control" id="is-w" name="w" value="100%">
						</div>
						<div class="form-group">
							<label>İframe Yüksekliği</label>
							<input type="text" class="form-control" id="is-h" name="h" value="300">
						</div>
						<button type="submit" class="btn btn-app btn-block">Getir!</button>
					</form>
				</div>
				<div class="col-lg-8">
					<div class="panel panel-film">
						<div class="panel-heading">
							<h3 class="panel-title"><i class="fa fa-search"></i> Sonuç</h3>
						</div>
						<div class="panel-body" id="result">
						</div>
						<div class="panel-footer" id="iframe">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="<?=SITEURL?>/assets/js/jquery-1.9.1.min.js"></script>
	<script type="text/javascript" src="<?=SITEURL?>/assets/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?=SITEURL?>/assets/js/ZeroClipboard.min.js"></script>
	<script type="text/javascript" src="<?=SITEURL?>/assets/js/ohsnap.js"></script>
	<script type="text/javascript" src="<?=SITEURL?>/assets/js/app.js"></script>
</body>
</html>

