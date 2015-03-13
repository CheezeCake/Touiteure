<div class="container" id="profile">

	<div class="row">

		<div class="col-md-3">
			<div>
				<img src="<?= $context->data['profile_image_url'] ?>">
			</div>
			<p class="lead" id="<?= $context->data['screen_name'] ?>"><?= $context->data['name'] ?> (<a href="Touiteure.php?action=profile&screen_name=<?= $context->data['screen_name'] ?>">@<?= $context->data['screen_name'] ?></a>)</p>
		</div>

		<div class="col-md-9">

			<div class="thumbnail">
				<img class="img-responsive" src="<?= $context->data['profile_background_image_url'] ?>">
				<div class="caption-full">
				<h4>Tweets: <?= $context->data['statuses_count'] ?> | Abonnements: <?= $context->data['friends_count'] ?> | Followers: <?= $context->data['followers_count'] ?></h4>
				</div>
			</div>

			<div class="well">

				<?php include('view/tweets.php'); ?>

			</div>

			<button class="center-block btn center" id="profileload">Load more</button>

		</div>

	</div>

</div>
