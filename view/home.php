<div class="container">

	<div class="row">

		<div class="col-md-3">
			<div>
				<img src="<?= $context->data['profile_image_url'] ?>">
			</div>
			<p class="lead"><?= $context->data['name'] ?> (<a href="Touiteure.php?action=profile&screen_name=<?= $context->data['screen_name'] ?>">@<?= $context->data['screen_name'] ?></a>)</p>
			<p class="small">Tweets: <?= $context->data['statuses_count'] ?> | Abonnements: <?= $context->data['friends_count'] ?> | Followers: <?= $context->data['followers_count'] ?></p>
		</div>

		<div class="col-md-9">

			<div class="well">

			<?php foreach ($context->tweets as $tweet): ?>
				<div class="row">
					<div class="col-md-12">
						<?php if (array_key_exists('retweeted_status', $tweet)): ?>
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

			</div>

		</div>

	</div>

</div>
