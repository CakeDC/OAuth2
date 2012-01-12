<form method="post" action="#">
	<?php if (!empty($authParams)) : ?>
		<?php foreach ($authParams  as $key => $value) : ?>
			<input type="hidden"
				name="<?php echo filter_var($key, FILTER_SANITIZE_FULL_SPECIAL_CHARS)?>"
				value="<?php echo filter_var($value, FILTER_SANITIZE_FULL_SPECIAL_CHARS)?>" />
		<?php endforeach; ?>
	<?php endif; ?>
	<p>
		Do you authorize the app to do its thing?
	</p>
	<input type="submit" name="accept" value="Yep" /> <input type="submit" name="accept" value="Nope" />
</form>