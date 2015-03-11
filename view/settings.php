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

				<form type="post">
					<input type="hidden" name="action" value="change_settings">
					<label>Name</label>&nbsp;<input type="text" size="20" name="name" value="<?= $context->data['name'] ?>">
					<input type="submit">
				</form>

			</div>

		</div>

	</div>

</div>

