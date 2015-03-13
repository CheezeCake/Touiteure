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

				<?php include('view/tweets.php'); ?>

			</div>

			<button class="center-block btn center" id="homeload">Load more</button>

		</div>

	</div>

</div>
