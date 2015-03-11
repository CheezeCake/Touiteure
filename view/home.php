<div class="container">

	<div class="row">

		<div class="col-md-3">
			<div>
				<img src="<?= $context->data['profile_image_url'] ?>">
			</div>
			<p class="lead"><?= $context->data['name'] ?> (@<?= $context->data['screen_name'] ?>)</p>
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
						<?= $tweet['user']['name'] ?> (@<?= $tweet['user']['screen_name'] ?>)
						<span class="pull-right"><?= $tweet['created_at'] ?></span>
						<p><?= $tweet['text'] ?></p>
					</div>
				</div>

				<hr>

			<?php endforeach; ?>

			</div>

		</div>

	</div>

</div>
