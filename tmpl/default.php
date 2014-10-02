<?php defined('_JEXEC') or die;

/**
 * File       default.php
 * Created    10/2/14 12:46 PM
 * Author     Matt Thomas | matt@betweenbrain.com | http://betweenbrain.com
 * Support    https://github.com/betweenbrain/
 * Copyright  Copyright (C) 2014 betweenbrain llc. All Rights Reserved.
 * License    GNU GPL v2 or later
 */

?>
<div class="ajaxcontacts">
	<form action="index.php?option=com_ajax&module=ajaxcontacts" method="post">
		<fieldset>
			<?php foreach ($options as $groupname => $groupoptions) : ?>
				<label><?php echo ucfirst($groupname) ?>
					<select name="<?php echo strtolower($groupname) ?>">
						<option selected="selected" value="">Please Select <?php echo ucfirst($groupname) ?></option>
						<?php foreach ($groupoptions as $option) : ?>
							<option value="<?php echo $option[$groupname] ?>"><?php echo $option[$groupname] ?></option>
						<?php endforeach ?>
					</select>
				</label>
			<?php endforeach ?>
		</fieldset>
	</form>
	<section class="results"></section>
</div>
