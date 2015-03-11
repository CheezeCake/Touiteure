<div class="container">

	<div class="row">

		<div class="col-md-3">
			<div>
				<img src="<?= $context->data['profile_image_url'] ?>">
			</div>
			<p class="lead"><?= $context->data['name'] ?> (@<?= $context->data['screen_name'] ?>)</p>
		</div>

		<div class="col-md-9">

			<div class="thumbnail">
				<img class="img-responsive" src="<?= $context->data['profile_background_image_url'] ?>">
				<div class="caption-full">
				<h4>Tweets: <?= $context->data['statuses_count'] ?> | Abonnements: <?= $context->data['friends_count'] ?> | Followers: <?= $context->data['followers_count'] ?></h4>
				</div>
			</div>

			<div class="well">

			<?php foreach ($context->tweets as $tweet): ?>
				<div class="row">
					<div class="col-md-12">
						<?php if ($tweet['retweeted'] == 'true'): ?>
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
