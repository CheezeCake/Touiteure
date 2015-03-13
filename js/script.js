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

	$('#homeload').click(function() {
		var smallestIdTweet = $('.well .row:last');
		var smallestId = (smallestIdTweet.length) ? smallestIdTweet.attr('id') : '';

		$.ajax({
			url: 'TouiteureAjaxDispatcher.php?action=load_home_tweets',
			type: 'POST',
			data: 'id=' + smallestId,
			success: function(data) {
				smallestIdTweet.replaceWith(data);
			},
			error: function(data) {
				alert(data);
			}
		});
	});

	$('#profileload').click(function() {
		var screenName = $('.lead').attr('id');
		var smallestIdTweet = $('.well .row:last');
		var smallestId = (smallestIdTweet.length) ? smallestIdTweet.attr('id') : '';

		$.ajax({
			url: 'TouiteureAjaxDispatcher.php?action=load_profile_tweets',
			type: 'POST',
			data: 'screen_name=' + screenName + '&id=' + smallestId,
			success: function(data) {
				smallestIdTweet.replaceWith(data);
			},
			error: function(data) {
				alert(data);
			}
		});
	});
});
