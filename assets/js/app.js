function activateClipboard () {
	ZeroClipboard.config( { swfPath: "assets/js/ZeroClipboard.swf" } );
	var client = new ZeroClipboard($("#iframe-copy"));
	client.on( "ready", function( readyEvent ) {
		client.on( "aftercopy", function( event ) {
			ohSnap('Embed kodu kopyalandı!', 'info', 'fa fa-info-circle')
		});
	});
}

$(function(){
	$('.tooltips').tooltip()


	$('body').on('submit', '#imdbform', function(){
		ohSnap('Yükleniyor..', 'info', 'fa fa-spinner fa-spin')
		$formdata = $(this).serialize()
		$url = $(this).attr('action')
		$method = $(this).attr('method')
		$.ajax({
			type: $method,
			dataType: 'json',
			url: $url,
			data: $formdata
		}).success(function($res){
			$('#result').html($res.body)
			$('#iframe').html($res.iframe)
			activateClipboard()
			ohSnap($res.message, 'success', 'fa fa-check')
		}).error(function($err) {
			$err = JSON.parse($err.responseText)
			ohSnap($err.message, 'danger', 'fa fa-exclamation-triangle')
		})
	})
})