<form method="post" action="#">
	<?php foreach ($authParams  as $key => $value) : ?>
		<input type="hidden"
			name="<?php filter_var($key, FILTER_SANITIZE_FULL_SPECIAL_CHARS)?>"
			value="<?php filter_var($value, FILTER_SANITIZE_FULL_SPECIAL_CHARS)?>" />
	<?php endforeach; ?>
	<p>
		Do you authorize the app to do its thing?
	</p>
	<input type="submit" name="accept" value="Yep" /> <input type="submit" name="accept" value="Nope" />
</form>