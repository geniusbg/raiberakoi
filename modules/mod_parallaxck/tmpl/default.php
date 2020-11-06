<?php
/**
 * @copyright	Copyright (C) 2011 Cédric KEIFLIN alias ced1870
 * http://www.ck-web-creation-alsace.com
 * http://www.joomlack.fr
 * Module Parallax_CK for Joomla! 1.6
 * @license		GNU/GPL
 * @ version : 1.0
**/

// no direct access
defined('_JEXEC') or die('Restricted access');
$width = ($params->get('imagewidth') && $params->get('imagewidth') != 'auto') ? 'width : '.$params->get('imagewidth').'px;' : '';
?>


<div id="parallaxCK" style="height : <?php echo $params->get('imageheight'); ?>px; <?php echo $params->get('imagewidth'); ?>">
	<?php
	$i = 1;
	foreach ($items as $item) {
		if (isset($item->image)) {
			echo '<div id="parallaxCK'.$i.'" style="'
				.'height : '.$params->get('imageheight').'px;'
				.'background : url('.$item->image.') top center repeat-x;'
				.'">';
		} else {
			echo '<div id="parallaxCK'.$i.'" style="'
				.'height : '.$params->get('imageheight').'px;'
				.'">';
		}


		$i++;
	}
	echo '</div></div></div></div></div>';
	?>
	<div style="clear:both;"></div>
</div>

