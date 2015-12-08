<h2><?php echo $title; ?></h2>

<?php /*echo validation_errors();*/ ?>

<?php echo form_open('polls/results'); ?>

    <?php foreach ($choices as $choice_item): ?>

    <input type="<?php echo $type; ?>" name="choices" value="<?php $choice_item['id']; ?>" id="choice<?php $choice_item['id']; ?>" />
    <label for="choice<?php $choice_item['id']; ?>"><?php echo $choice_item['choice_text']; ?></label><br />

	<?php endforeach; ?>

    <br />

    <input type="submit" value="Vote" />

</form>

