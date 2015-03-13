<?php foreach ($context->tweets as $tweet): ?>
	<div class="row" id="<?= $tweet['id'] ?>">
		<div class="col-md-12">
			<?php if ($tweet['retweeted'] == 'true' || array_key_exists('retweeted_status', $tweet)): ?>
				<strong>Retweeté</strong>
			<?php endif; ?>
			<?php if ($tweet['favorited'] == 'true'): ?>
				<strong>, mis en favori</strong>
			<?php endif; ?>
			<?= $tweet['user']['name'] ?> (<a href="Touiteure.php?action=profile&screen_name=<?= $tweet['user']['screen_name'] ?>">@<?= $tweet['user']['screen_name'] ?></a>)
			<span class="pull-right"><?= date('D, d M Y H:i:s', strtotime($tweet['created_at'])) ?></span>
			<p><?= $tweet['text'] ?></p>
		</div>
	</div>

	<hr>
<?php endforeach; ?>

