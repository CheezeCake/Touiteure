$(document).ready(function() {
	$('#tweet').click(function() {
		bootbox.prompt('Écrire un nouveau Tweet', function(result) {
			if (result !== null && result.length > 0) {
				data = 'status=' + encodeURI(result);

				$.ajax({
					url: 'Touiteure.php?action=tweet',
					type: 'POST',
					data: data,
					error: function(data) {
						alert(data);
					}
				});
			}
		});
	});
});
