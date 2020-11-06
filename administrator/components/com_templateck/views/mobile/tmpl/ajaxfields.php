<?php
/**
 * @copyright	Copyright (C) 2011 Cédric KEIFLIN alias ced1870
 * http://www.joomlack.fr
 * Component Template Creator CK
 * @license		GNU/GPL
 * */
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
$objclass = JRequest::getVar('objclass', '');
$objid = JRequest::getVar('objid', '');
$objmobile = JRequest::getVar('objmobile', '');
// var_dump($objmobile);
?>

<script language="javascript" type="text/javascript">
    window.addEvent('domready', function() {

        //updatesession();
		$$('.ckmobile_setting').each(function(el) {
			el.addEvent('click', function() {
				if (!el.hasClass('ckmobile_active')) {
					$$('.ckmobile_setting').removeClass('ckmobile_active');
					el.addClass('ckmobile_active');
				}
			});
		});
		
		// set active config
		var active_setting = '';
		if (active_setting = document.getElement('.focus').getProperty('ckmobile')) {
			document.id(active_setting).addClass('ckmobile_active');
		}
    });
</script>

<div class="ckpopuptitle"><?php echo JText::_('CK_MOBILE_EDIT'); ?></div>
<div class="ckclose cksave" onclick="savePopup(this);document.getElements('.ckpopup').setStyle('display','none');"><?php echo JText::_('CK_VALIDATE'); ?></div>
<div class="ckclose ckcancel" onclick="document.getElements('.ckpopup').setStyle('display','none');"><?php echo JText::_('CK_CANCEL'); ?></div>
<div class="clr"></div>
<div ckclass="<?php echo $objclass; ?>">
    <div id="mobile_default" class="ckmobile_setting">DEFAULT</div>
    <div id="mobile_hide" class="ckmobile_setting">HIDDEN</div>
    <div id="mobile_alignhalf" class="ckmobile_setting">ALIGN HALF</div>
    <div id="mobile_notaligned" class="ckmobile_setting">NOT ALIGNED</div>
    <div id="mobile_lefttop" class="ckmobile_setting">LEFT ON TOP</div>
    <div id="mobile_lefthidden" class="ckmobile_setting">LEFT HIDDEN</div>
    <div id="mobile_rightbottom" class="ckmobile_setting">RIGHT ON BOTTOM</div>
    <div id="mobile_righthidden" class="ckmobile_setting">RIGHT HIDDEN</div>
</div>


