<h2><?php echo $title; ?></h2>

	<ul>
	<?php if (!(empty($questions))) {
		foreach ($questions as $questions_item): ?>

        <li><a href="<?php echo site_url("/polls/".$questions_item['id']) ?>"><?php echo $questions_item['question_text']; ?></a></h3>

		<?php endforeach; ?>
	<?php }
	else echo "No questions available.";
	?>
	</ul>