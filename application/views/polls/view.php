<h2><?php echo $title; ?></h2>

<?php 
    if ($this->session->flashdata('errors')) {
        echo '<p style="color:red">';
        echo $this->session->flashdata('errors');
        echo '</p>';
    }
 ?>

<?php echo form_open('polls/submit/'.$question_item['id']); ?>

    <?php foreach ($choices as $choice_item): ?>

    <input type="<?php echo $type; ?>" name="choices<?php if ($type == 'checkbox') echo '[]'; ?>" value="<?php echo $choice_item['id']; ?>" id="choice<?php echo $choice_item['id']; ?>" />
    <label for="choice<?php echo $choice_item['id']; ?>"><?php echo $choice_item['choice_text']; ?></label><br />

	<?php endforeach; ?>

    <br />

    <input type="submit" value="Vote" />

</form>

