<form method="post" action="#">
<?php
	foreach ($authParams  as $key => $value) : ?>
		<input type="hidden" name="<?=filter_var($key, FILTER_SANITIZE_FULL_SPECIAL_CHARS)?>" value="<?=filter_var($value, FILTER_SANITIZE_FULL_SPECIAL_CHARS)?>" />
    <?php endforeach; ?>
      Do you authorize the app to do its thing?
      <p>
        <input type="submit" name="accept" value="Yep" />
        <input type="submit" name="accept" value="Nope" />
      </p>
    </form>

