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
	.sonuc {display: -webkit-inline-box;}
	</style>
</head>
<body>
<div id="yukleniyor"><span class="loading style-1"></span></div>
<div class="container">
<h1>IMDb Bot</h1>
<p class="help-block">IMDb.com üzerinden film/dizi verileri çeker.</p>
<form action="" method="" onsubmit="return false" id="imdbgetir">
  <div class="form-group">
    <label for="imdb">IMDb Adresi</label>
    <input type="text" class="form-control" id="imdb" maxlength="37" placeholder="http://imdb.com/title/tt3042408/">
  </div>
  <button type="submit" class="btn btn-default">Getir</button>
</form> <br />
<div class="alert alert-dismissible" role="alert">
</div>
<div id="gelen">

</div>

<script type="text/javascript">
	$(function(){
		
		$("button").click(function() {
			var imdbadres = $("input#imdb").val();
			if( imdbadres == "" ) {
				alert("IMDb adresini giriniz.");
			}
			else {
				$("#yukleniyor").show();
			$.ajax({
				type:'POST',
				url:'post.php',
				data:{imdb: imdbadres},
				dataType: 'json',
				success: function(cevap) {
					if(cevap.hata) {
						$("#yukleniyor").hide();
						$(".alert").addClass("alert-warning");
						$(".alert").html(cevap.hata);
						$(".alert").show();
					}
					else {
						$("#yukleniyor").hide();
						$("#gelen").show();
						$("#gelen").html(cevap.basarili);
					}
				},
				error: function() {$("#yukleniyor").hide();alert("Hata oluştu!");}
			});
			}
		});
		
	});
</script>
</div>	
</body>
</html>

