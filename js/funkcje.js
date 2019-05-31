jQuery.fn.center = function () {
	this.css("position", "absolute");
	this.css("top", ($(window).height() - this.height()) / 2 + $(window).scrollTop() + "px");
	this.css("left", ($(window).width() - this.width()) / 2 + $(window).scrollLeft() + "px");
	return this;
};

$(function() {
	// dodawanie książki do koszyka
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


	
	// autorzy
	$("#fDodajAutora").hide();
	$("#aDodajAutora").click(() => {
		$("#fDodajAutora").toggle();
		return false;
	});
	$(".aUsunAutora").click(usunRekord);

	// kategorie
	$("#fDodajKategorie").hide();
	$("#aDodajKategorie").click(() => {
		$("#fDodajKategorie").toggle();
		return false;
	});
	$(".aUsunKategorie").click(usunRekord);
	
	// użytkownicy
	$("#fDodajUzytkownika").hide();
	$("#aDodajUzytkownika").click(() => {
		$("#fDodajUzytkownika").toggle();
		return false;
	});
	$(".aUsunUzytkownika").click(usunRekord);
	
	// pokaż spinner w czasie wykonywania żądań AJAX
	$('#ajaxLoading').hide();
	$(document)
		.ajaxStart(() => {
			$('#ajaxLoading').center();
			$('#ajaxLoading').show();
		})
		.ajaxStop(() => {
			$('#ajaxLoading').hide();
		});
});

/**
 * Usuwa rekord.
 *
 */
function usunRekord()
{
	const $a = $(this);
	const odp = confirm("Czy na pewno chcesz usunąć rekord?");

	if (odp) {
		$.post($a.attr('href'), (response) => {
			if (response == 'ok') {
				$a.parents('tr').find('td').css('textDecoration', 'line-through');
				$a.parent().html("");
			} else {
				alert('Wystąpił błąd przy przetwarzaniu zapytania. Prosimy spróbować ponownie.');
			}
		});
	}
	
	return false;
}


/**});

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
});  */





