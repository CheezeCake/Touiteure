$(document).ready(function() {
	$('#tweet').click(function() {
		bootbox.prompt('Écrire un nouveau Tweet', function(result) {
			if (result !== null && result.length > 0) {
				data = 'status=' + encodeURI(result);

				$.ajax({
					url: 'Touiteure.php?action=tweet',
					type: 'POST',
					data: data,
					success: function(data) {
						noty({
							layout: 'topRight',
							text: 'Tweet publié avec succès !',
							type: 'success',
							theme: 'relax',
							timeout: 3000,
							animation: {
								open: 'animated fadeIn',
								close: 'animated flipOutX'
							}
						});
					},
					error: function(data) {
						noty({
							layout: 'topRight',
							text: 'Erreur lors de la publication du tweet',
							type: 'error',
							theme: 'relax',
							timeout: 3000,
							animation: {
								open: 'animated fadeIn',
								close: 'animated flipOutX'
							}
						});
					}
				});
			}
		});
	});
});
