<?php
	require_once 'conf.php';

	$response = array();
	$code = 200;

	if (!array_key_exists('HTTP_REFERER', $_SERVER) || !strstr(@$_SERVER["HTTP_REFERER"], DOMAIN)) {
		$code = 400;
		$response["message"] = "Bu adrese dış bağlantıdan istek gönderemezsiniz!!";
		echo Func::json($response, $code);
	}else{
		switch ($_GET['type']) {
			case 'json':
				$url = @$_GET['url'];
				if (empty($url)) {
					$code = 400;
					$response["message"] = "IMDB Link alanı boş bırakılamaz!";
				} else {
					$response = Func::filmsplitter($url);
				}
				echo Func::json($response, $code);
				break;

			case 'iframe':
				$url = @$_GET['url'];
				if (empty($url)) {
					$code = 400;
					$response["message"] = "IMDB Link alanı boş bırakılamaz!";
				} else {
					if (preg_match('/^http:\/\/www\.imdb\.com\/title\/(t{2})([0-9]{7})$/', $url)) {
						$film = Func::filmsplitter($url);
						include_once 'iframe.tpl.php';
					} else {
						echo "Girilen link işlem yapmaya uygun değil!<br />Örn. http://www.imdb.com/title/tt0111161";
					}
				}
				break;

			case 'html':
				if ($_SERVER['REQUEST_METHOD'] != 'POST') {
					$code = 400;
					$response["message"] = "Yalnızca post istekleri işlenmektedir!";
				} else {
					$url = $_POST['url'];
					if (empty($url)) {
						$code = 400;
						$response["message"] = "IMDB Link alanı boş bırakılamaz!";
					} else {
						if (preg_match('/^http:\/\/www\.imdb\.com\/title\/(t{2})([0-9]{7})$/', $url)) {
							$film = Func::filmsplitter($url);
							$height = $_POST['h'];
							$width = $_POST['w'];
							$body_tpl = '<div class="row film-box">
								<div class="col-lg-4">
									<div class="thumbnail">
										<div class="star"><span class="text">' . $film->puan . '</span></div>
										<img src="' . $film->resim . '" alt="' . $film->isim . '">
									</div>
									<a href="' . $film->url . '" class="btn btn-primary btn-block" target="_blank">IMDb Sayfası</a>
								</div>
								<div class="col-lg-8">
									<div class="title">
										<h3>' . $film->isim . '</h3>
									</div>
									<table class="table table-striped table-bordered">
										<tbody>
											<tr><th>Ülke</th><td>' . $film->ulke . '</td></tr>
											<tr><th>Yönetmen</th><td>' . $film->yonetmenler . '</td></tr>
											<tr><th>Senarist</th><td>' . $film->senaristler . '</td></tr>
											<tr><th>Yayın Tarihi</th><td>' . $film->yayintarihi . '</td></tr>
											<tr><th>Özet</th><td>' . $film->ozet . '</td></tr>
										</tbody>
									</table>
								</div>
							</div>';
							$iframe_tpl = '<div class="input-group">
								<input id="iframe-target" class="form-control" style="width: 100%;" value="&lt;iframe src=&quot;' . SITEURL . '/imdb.php?type=iframe&url=' . $url . '&quot; frameborder=&quot;0&quot; scrolling=&quot;no&quot; height=&quot;' . $height . '&quot; width=&quot;' . $width . '&quot;&gt;&lt;/iframe&gt;" />
								<span class="input-group-btn">
									<button type="button" class="btn btn-default" id="iframe-copy" data-clipboard-target="iframe-target"><i class="fa fa-copy"></i></button>
								</span>
								</div>';

							$response["message"] = 'Bilgiler başarıyla alındı!';
							$response["body"] = $body_tpl;
							$response["iframe"] = $iframe_tpl;
						} else {
							$code = 400;
							$response["message"] = "Girilen link işlem yapmaya uygun değil!<br />Örn. http://www.imdb.com/title/tt0111161";
						}
					}
				}
				echo Func::json($response, $code);
				break;
		}
	}

?>