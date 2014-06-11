<h2>Create a news item</h2>

<?php echo validation_errors(); ?>

<?php echo form_open('news/create') ?>

	<label for="title"><?php echo $title ?></label>
	<input type="input" name="title" value="<?php echo empty($news['title']) != true ? $news['title'] : ""; ?>" /><br />

	<label for="text">Text</label>
	<textarea name="text"><?php echo empty($news['text']) != true ? $news['text'] : ""; ?></textarea><br />

	<input type="submit" name="submit" value="Create news item" />
        
        <input type="hidden" name="update" value="<?php echo $update ?>" />
        <input type="hidden" name="slug" value="<?php echo empty($news['slug']) != true ? $news['slug'] : ""; ?>" />
</form>