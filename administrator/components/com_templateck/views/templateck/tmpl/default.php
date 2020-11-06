<?php
/**
 * @copyright	Copyright (C) 2011 Cédric KEIFLIN alias ced1870
 * http://www.template-creator.com
 * Component Template Creator CK
 * @license		GNU/GPL
 * */
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
JHTML::_('script', 'templateck_template_library.js', 'administrator/components/com_templateck/assets/');
JHTML::_('script', 'mooRainbow1.2.js', 'administrator/components/com_templateck/assets/');
JHTML::_('behavior.modal');
// load the fontface css
$this->_callfontsSquirrel();
$this->_checkIfTemplateInstalled();
?>

<script language="javascript" type="text/javascript">
    function jInsertEditorText( text, editor ) {
        var newEl = new Element('span').set('html',text);
        var valeur = newEl.getChildren()[0].getAttribute('src');
        $(editor).value = valeur;
        $(editor).fireEvent('change');
    }
			
    var URIROOT = "<?php echo JURI::root(true); ?>";
    var TEMPLATEID = "<?php echo $this->template->id; ?>";
    var CLIPBOARDCK = '';
    var CLIPBOARDCOLORCK = '';
    Joomla.submitbutton = function(task)
    {
        document.id('htmlcode').value = document.id('conteneur').get('html');
        document.id('htmlcode_responsive').value = genResponsivecode(document.id('conteneur'));

        var form = document.adminForm;
        if (task == 'cancel') {
            Joomla.submitform(task);
            return;
        }
        // do field validation
        if (form.name.value == "") {
            alert( "<?php echo JText::_('TEMPLATE_MUST_HAVE_NAME', true); ?>" );
        } else {
            Joomla.submitform(task);
        }
    }

    var updatesession = function() {
        var myurl = "index.php?option=com_templateck&task=updatesession";
        var packageRequest = new Request.HTML({
            url:myurl
        });
        packageRequest.send();
    }
	
    var pickerid = 1;

</script>
<form action="index.php" enctype="multipart/form-data" method="post" name="adminForm" id="adminForm" class="form-validate">
    <input type="hidden" name="htmlcode" id="htmlcode" value="" />
    <input type="hidden" name="htmlcode_responsive" id="htmlcode_responsive" value="" />
    <input type="hidden" name="option" value="com_templateck" />
    <input type="hidden" name="id" value="<?php echo $this->template->id; ?>" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="controller" value="templateck" />
    <?php echo $this->loadTemplate('mainmenu'); ?>
    <div>
        <fieldset class="adminform">
            <legend><?php echo JText::_('CK_TEMPLATE_EDITION'); ?></legend>
            <div id="template_container">
                <div id="code_areas">
                    <?php echo $this->loadTemplate('globalinfos'); ?>

                    <div id="ck_csscode" class="ckpopup">
                    </div>
                    <div id="modules_code" class="ckpopup">
                        <div class="ckpopuptitle"><?php echo JText::_('CK_CHECK_MODULES'); ?></div>
                        <div class="ckclose" onclick="document.getElements('.ckpopup').setStyle('display','none');"></div>
                        <div class="ckpopuplogo"></div>
                        <div id="modules_code_inner">
                        </div>
                    </div>

                    <div id="html_code" class="code_area">
                        <div id="htmlconteneur">
                            <div id="conteneur" class="focusbar focus">
                                <?php
                                if (JRequest::getVar('cid')) {
                                    echo $this->template->htmlcode;
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
        </fieldset>
    </div>
    <div class="clr"></div>


</form>
