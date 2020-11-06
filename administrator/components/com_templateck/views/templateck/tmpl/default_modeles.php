<?php
/**
 * @copyright	Copyright (C) 2011 Cédric KEIFLIN alias ced1870
 * http://www.joomlack.fr
 * Component Template Creator CK
 * @license		GNU/GPL
 * */
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
?>
<style type="text/css">
div.ckmodele {
	display: inline-block;
	margin: 3px;
	padding: 5px;
	background: #fff;
	border: 1px solid #fff;
	-moz-box-shadow: 0 0 5px #888;
    -webkit-box-shadow: 0 0 5px#888;
    box-shadow: 0 0 5px #888;
    -moz-border-radius: 7px;
    border-radius: 7px;
}

div.ckmodele:hover {
	background: #aaa;
	cursor: pointer;
}

div.ckmodeletitle {
	text-align: center;
	font-size: 14px;
}
</style>
<script language="javascript" type="text/javascript">

</script>

<div class="ckmodele" onclick="loadModele('modele1');">
	<div class="ckmodeletitle"><?php echo JText::_('CK_MODELE_1'); ?></div>
	<img src="components/com_templateck/images/modele1.png" width="256" height="256" />
</div>
<div class="ckmodele" onclick="loadModele('modele2');">
	<div class="ckmodeletitle"><?php echo JText::_('CK_MODELE_2'); ?></div>
	<img src="components/com_templateck/images/modele2.png" width="256" height="256" />
</div>
<div class="ckmodele" onclick="loadModele('modele3');">
	<div class="ckmodeletitle"><?php echo JText::_('CK_MODELE_3'); ?></div>
	<img src="components/com_templateck/images/modele3.png" width="256" height="256" />
</div>
<div class="ckmodele" onclick="loadModele('modele4');">
	<div class="ckmodeletitle"><?php echo JText::_('CK_MODELE_4'); ?></div>
	<img src="components/com_templateck/images/modele4.png" width="256" height="256" />
</div>
<div class="ckmodele" onclick="loadModele('modele5');">
	<div class="ckmodeletitle"><?php echo JText::_('CK_MODELE_5'); ?></div>
	<img src="components/com_templateck/images/modele5.png" width="256" height="256" />
</div>
<div class="ckmodele" onclick="loadModele('modele6');">
	<div class="ckmodeletitle"><?php echo JText::_('CK_MODELE_6'); ?></div>
	<img src="components/com_templateck/images/modele6.png" width="256" height="256" />
</div>
