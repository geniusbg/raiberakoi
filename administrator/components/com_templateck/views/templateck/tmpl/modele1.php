<?php
/**
 * @copyright	Copyright (C) 2011 C�dric KEIFLIN alias ced1870
 * http://www.joomlack.fr
 * Component Template Creator CK
 * @license		GNU/GPL
 * */
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
?>
<script language="javascript" type="text/javascript">
	window.addEvent('domready', function() {
		if ($('body')) {
			$('bodycss').addEvent('click', function() {
				showCsspopup($('body'));
			});
		}
		if ($('wrapper')) {
			$('wrappercss').addEvent('click', function() {
				showCsspopup($('wrapper'));
			});
		}
	});
</script>



<div id="body" class="body ckbloc">
	<div class="controlCss isControl" id="bodycss"><?php echo JText::_('BODY_CSS'); ?></div>
        <div class="ckstyle"></div>
	<div id="wrapper" class="wrapper ckbloc">
		<div class="controlCss isControl" id="wrappercss"><?php echo JText::_('WRAPPER_CSS'); ?></div>
                <div class="ckstyle"></div>
		<div class="clr"></div>
	</div>
</div>