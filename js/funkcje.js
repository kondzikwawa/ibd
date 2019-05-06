$(function() {
	$(".aDodajDoKoszyka").click(function() {
		const $a = $(this);
		
		$.post($a.attr('href'), { id_ksiazki: $a.data('id') }, function(resp) {
			if(resp == 'ok') {
				const wKoszyku = parseInt($("#wKoszyku").text()) + 1;
				$("#wKoszyku").text(wKoszyku);
				$a.replaceWith('<i class="fas fa-check"></i>');
			} else {
				alert('Wystąpił błąd: ' + resp);
			}
		});
		
		return false;
	});
});

$(function() {
	$(".aUsunZKoszyka").click(function() {
		const $a = $(this);
		
		$.post($a.attr('href'), { id_koszyka: $a.data('id_koszyka') }, function(resp) {
			if(resp == 'ok') {
				//const wKoszyku = parseInt($("#wKoszyku").text()) + 1;
				//$("#wKoszyku").text(wKoszyku);
				//$a.replaceWith('<i class="fas fa-check"></i>');
			} else {
				alert('Wystąpił błąd: ' + resp);
			}
		});
		
		return false;
	});
}); 





