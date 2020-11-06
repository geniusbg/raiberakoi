<?php
/**
 * @name		Template Creator CK 3
 * @package		com_templateck
 * @copyright	Copyright (C) 2013. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 * @author		Cedric Keiflin - http://www.template-creator.com - http://www.joomlack.fr
 */
defined('_JEXEC') or die;

if(version_compare(JVERSION,'3.0.0','le') > 0) {
	JHtml::_('script', 'components/com_templateck/assets/jquery.min.js');
	JHtml::_('script', 'components/com_templateck/assets/jquery-noconflict.js');
}

// Add Stylesheets
$doc = JFactory::getDocument();
$doc->addStyleSheet('templates/' . $this->template . '/css/template.css');
if ($this->direction == 'rtl') :
	$doc->addStyleSheet('../media/jui/css/bootstrap-rtl.css');
endif;
?>
<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<jdoc:include type="head" />
	<style type="text/css">
		/* Responsive Styles */
		@media (max-width: 480px) {
			.btn{
				font-size: 13px;
				padding: 4px 10px 4px;
			}
		}
	</style>
</head>

<body class="site view-login">
	<!-- Container -->
	<div class="container">
		<div id="content">
			<!-- Begin Content -->
			<div id="element-box" class="login well">
				<img src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template ?>/images/template_creator_ck_logo64.png" alt="Joomla!" />
				<hr />
				<div class="alert">
<?php echo JText::_('COM_TEMPLATECK_CANLOGIN') ?>
				</div>
				<jdoc:include type="component" />
				<jdoc:include type="message" />
			</div>
			<noscript>
<?php echo JText::_('JGLOBAL_WARNJAVASCRIPT') ?>
			</noscript>
			<!-- End Content -->
		</div>
	</div>
<jdoc:include type="modules" name="debug" style="none" />
</body>
</html>
