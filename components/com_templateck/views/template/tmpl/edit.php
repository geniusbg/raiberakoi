<?php
/**
 * @name		Template Creator CK 3
 * @package		com_templateck
 * @copyright	Copyright (C) 2013. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 * @author		Cedric Keiflin - http://www.template-creator.com - http://www.joomlack.fr
 */
// no direct access
defined('_JEXEC') or die;

JHtml::_('script', 'components/com_templateck/assets/jquery.min.js');
JHtml::_('script', 'components/com_templateck/assets/jquery-noconflict.js');
JHtml::_('behavior.framework', true);
JHtml::_('behavior.keepalive');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.modal', 'a.modal');
JHtml::_('behavior.formvalidation');
JHtml::_('script', 'components/com_templateck/assets/templateck_template.js');
JHtml::_('script', 'components/com_templateck/assets/mooRainbow1.2.js');
JHtml::_('stylesheet', 'components/com_templateck/assets/templateck_template.css');
$this->_callfontsSquirrel();
$lang = JFactory::getLanguage();
$lang->load('com_templateck', JPATH_ADMINISTRATOR);
?>
<script type="text/javascript">
	function keepAliveAdmin() {
		var myAjax = new Request({method: "get", url: "<?php echo JUri::root(true); ?>/administrator/index.php"}).send();
	}

	var URIROOT = "<?php echo JUri::root(true); ?>";
	var URIBASE = "<?php echo JUri::base(true); ?>";
	var TEMPLATEID = "<?php echo $this->item->id; ?>";
	var CLIPBOARDCK = '';
	var CLIPBOARDCOLORCK = '';

	Joomla.submitbutton = function(task) {

		$ck('#htmlcode').attr('value', $ck('#conteneur').html());
		if (task == 'template.cancel' || document.formvalidator.isValid(document.id('adminForm'))) {
			Joomla.submitform(task);
		}
		else {
			alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED')); ?>');
		}
	}
	$ck(document).ready(function() {
		$ck('.ckbloc', $ck('#body')).each(function(i, bloc) {
			addControlsOnHover(bloc);
		});
		$ck('.alert-message > a.close').click(function() {
			$ck(this).parent().remove();
		});
		checkModules();
		$ck('#body').removeClass('expert');
		keepAliveAdmin();
	});
</script>
<div id="bootstrapload"><link rel="stylesheet" type="text/css" href="components/com_templateck/default.css"></div>
<form action="index.php" enctype="multipart/form-data" method="post" name="adminForm" id="adminForm" class="form-validate">
    <input type="hidden" name="htmlcode" id="htmlcode" value="" />
    <input type="hidden" name="option" value="com_templateck" />
    <input type="hidden" name="id" value="<?php echo $this->item->id; ?>" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="controller" value="templateck" />
	<?php echo JHtml::_('form.token'); ?>
	<?php echo $this->loadTemplate('mainmenu'); ?>
    <div>
		<div id="template_container">
			<div id="code_areas">
				<?php echo $this->loadTemplate('globalinfos'); ?>

				<div id="popup_editionck" class="ckpopup">
				</div>

				<?php echo $this->loadTemplate('checkmodules'); ?>
				<div id="html_code" class="code_area">
					<div id="htmlconteneur">
						<div id="conteneur" class="focusbar focus">
							<?php
							if ($this->item->htmlcode) {
								echo $this->item->htmlcode;
							} else {
								echo $this->loadTemplate('modeles');
							}
							?>
						</div>
						<div class="clr"></div>
					</div>
					<div class="clr"></div>
				</div>
				<?php echo $this->loadTemplate('package'); ?>

				<div class="clr"></div>
			</div>
			<div class="clr"></div>
		</div>
    </div>
    <div class="clr"></div>
</form>