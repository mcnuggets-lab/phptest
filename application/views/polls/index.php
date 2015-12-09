<h2><?php echo $title; ?></h2>

	<ul>
		<?php foreach ($questions as $question_item): ?>

        <li><a href="<?php echo site_url("/polls/".$question_item['id']); ?>" target="_self"><?php echo $question_item['question_text']; ?></a>

		<?php endforeach; ?>

	</ul>