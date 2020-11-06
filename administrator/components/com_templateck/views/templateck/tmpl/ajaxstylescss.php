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
//var_dump($objid);
$cache = JFactory::getCache('com_templateck', '');

$showheight = (stristr($objclass, 'mainbanner') OR stristr($objclass, 'bannerlogo') OR stristr($objclass, 'horizmenu')) ? true : false;
$showwidth = ((stristr($objclass, 'wrapper') OR stristr($objclass, 'bannerlogo') OR stristr($objclass, 'banner') OR stristr($objclass, 'column')) AND !stristr($objclass, 'content')) ? true : false;
$isContent = (stristr($objclass, 'content') OR stristr($objclass, 'bannerlogodesc')) ? true : false;
$isBody = stristr($objclass, 'body') ? true : false;
$isWrapper = stristr($objclass, 'wrapper') ? true : false;
$isContainer = (stristr($objclass, 'body') OR stristr($objclass, 'wrapper') OR stristr($objclass, 'mainbanner') OR stristr($objclass, 'bannerlogo') OR stristr($objclass, 'flexiblemodules') OR stristr($objclass, 'maincontent') OR stristr($objclass, 'content')) ? true : false;
$menustyles = new MenuStyles();
?>

<script language="javascript" type="text/javascript">
    window.addEvent('domready', function() {
<?php if (!$isContainer OR $isBody) { ?>
            new tabsCK('ck_csscode',{buttonsClass: 'menulink',containersClass: 'pane', prefix: '',activeclass: 'activeglobalcontainer'});
            new tabsCK('paneContainer',{buttonsClass: 'menulink2',containersClass: 'pane2', prefix: '',activeclass: 'activeglobalcontainer2'});
            new tabsCK('paneContainer3',{buttonsClass: 'menulink3',containersClass: 'pane3', prefix: '',activeclass: 'activeglobalcontainer3'});
<?php } ?>
	
        // manage the checkboxes
        $$('#template_container input.inputbox[type="checkbox"]').each(function(coche) {
            coche.addEvent('click',function(){
                if (this.checked) {
                    this.value="1";
                } else {
                    this.value="0";
                }
                $('template_container').getElement('.cssfocus').setProperty(coche.id,coche.value);
            });
        });
		
        // manage the checkboxes
        $$('#template_container input.inputbox[type="radio"]').each(function(coche) {
            coche.addEvent('click',function(){
                var focus = $('template_container').getElement('.cssfocus');
                focus.setProperty(coche.name,coche.id);
            });
        });
        
        $$('.inputbox').each(function(field) {
            field.addEvent('change', function(){
                if (field.getProperty('type') != 'radio')
                    $('template_container').getElement('.cssfocus').setProperty(field.id,field.value);
            });
        });
		
        fillCssFields($('template_container').getElement('.cssfocus'));
		
        var startcolor = '';
        // add mooRainbow color picker for each control
        document.getElements('.colorPicker').each(function(picker){
            setpickercolor(picker);
            picker.addEvent('mousedown',function() {
                if (picker.value) { startcolor = '['+hexToR(picker.value)+','+hexToG(picker.value)+','+hexToB(picker.value)+']'; }
                else {  startcolor = '[0,255,255]';}
                new MooRainbow(picker, {
                    'id': 'colorpicker'+pickerid,
                    'startColor': startcolor,
                    'imgPath': URIROOT+'/administrator/components/com_templateck/images/moorainbow/',
                    'onChange': function(color) {
                        setpickercolor(picker);
						
                        picker.value = color.hex;
                        picker.fireEvent('change');
                        picker.setStyle('background-color',color.hex);
                        //picker.setStyle('color',pickercolor);
                    },
                    'onClean': function(color) {
                        picker.value = '';
                        picker.setStyle('background','none');
                        picker.fireEvent('change');
                    },
                    'onCopy': function(color) {
                        CLIPBOARDCOLORCK = picker.value;
                    },
                    'onPaste': function(color) {
                        picker.value = CLIPBOARDCOLORCK;
                        picker.setStyle('background',CLIPBOARDCOLORCK);
                        setpickercolor(picker);
                        picker.fireEvent('change');
                    }
                });
                pickerid++;
            });
            
        });

        updatesession();
    });

    /**
     * Method to give a black or white color to have a good contrast
     */
    function setpickercolor(picker) {
        pickercolor =
            0.213 * hexToR(picker.value)/100 +
            0.715 * hexToG(picker.value)/100 +
            0.072 * hexToB(picker.value)/100
            < 1.5 ? '#FFF' : '#000';
        picker.setStyle('color',pickercolor);
        return pickercolor;
    }
</script>
<?php //$prefix, $objclass = '',$textetab = 1, $showheight = 1, showwidth = 1, $showlinks = 1
?>
<div class="ckpopuptitle"><?php echo JText::_('CK_CSS_EDIT'); ?></div>
<div class="ckclose cksave" onclick="closeCsspopup(this);document.getElements('.ckpopup').setStyle('display','none');"><?php echo JText::_('CK_VALIDATE'); ?></div>
<div class="ckclose ckpaste" id="pastefromclipboard" onclick="pastefromclipboard(this)"><?php echo JText::_('CK_PASTE'); ?></div>
<div class="ckclose ckcopy" id="copytoclipboard" onclick="copytoclipboard(this)"><?php echo JText::_('CK_COPYALLCSS'); ?></div>
<?php
//$prefix, $objclass = '',$textetab = 1, $showheight = 1, showwidth = 1, $showlinks = 1
//if (!($htmlpage = $cache->get($objid, 'com_templateck')))
//ob_start();
//var_dump($htmlpage);
?>
<ul id="elementsmenu">
    <li class="menulink current"><?php echo JText::_('CK_BLOCK_STYLES'); ?></li>
    <?php if (!$isContainer) { ?>
        <li class="menulink"><?php echo JText::_('CK_MODULES_STYLES'); ?></li>
        <li class="menulink"><?php echo JText::_('CK_MODULES_TITLES_STYLES'); ?></li>
        <li class="menulink"><?php echo JText::_('CK_MENUS_STYLES'); ?></li>
    <?php } ?>
    <?php if ($isBody) {
    ?>
        <li class="menulink"><?php echo JText::_('CK_TITLES'); ?></li>
        <li class="menulink"><?php echo JText::_('CK_BUTTONS'); ?></li>
        <li class="menulink"><?php echo JText::_('CK_SYSTEMIMAGES'); ?></li>
    <?php } ?>
    <div class="clr"></div>
    <div class="clr"></div>
    <div id="elementscontent">
        <div id="paneContainer">
            <div class="pane" id="start">
                <div id="ckpopupdescription">
                    <div id="ckpopupdescriptiontitle"><?php echo JText::_('CK_BLOCK_DESC_TITLE'); ?></div>
                    <?php echo JText::_('CK_BLOCK_DESC_TEXT'); ?>
                
                <div id="ckpopupillustration">
                    <img align="right" src="<?php echo JURI::ROOT(); ?>administrator/components/com_templateck/images/illustration_blocks.png" />
                </div>
                    </div>
                <?php
                    if ($isBody OR $isContent) {
                        echo $menustyles->create('bloc', $objclass, 1, $showheight, $showwidth, 1);
                    } else {
                        echo $menustyles->create('bloc', $objclass, 0, 1, 1, 0);
                    }
                ?>
                </div>
            <?php if (!$isContainer) {
            ?>
                        <div class="pane">
                            <div id="ckpopupdescription">
                                <div id="ckpopupdescriptiontitle"><?php echo JText::_('CK_MODULE_DESC_TITLE'); ?></div>
                    <?php echo JText::_('CK_MODULE_DESC_TEXT'); ?>
                    
                    <div id="ckpopupillustration">
                        <img align="right" src="<?php echo JURI::ROOT(); ?>administrator/components/com_templateck/images/illustration_modules.png" />
                    </div>
                                </div>
                <?php echo $menustyles->create('module', $objclass, 1, 1, 1, 1); ?>
                    </div>
                    <div class="pane">
                        <div id="ckpopupdescription">
                                <div id="ckpopupdescriptiontitle"><?php echo JText::_('CK_MODULETITLE_DESC_TITLE'); ?></div>
                    <?php echo JText::_('CK_MODULETITLE_DESC_TEXT'); ?>
                    
                    <div id="ckpopupillustration">
                        <img align="right" src="<?php echo JURI::ROOT(); ?>administrator/components/com_templateck/images/illustration_moduletitles.png" />
                    </div>
                                </div>
                <?php echo $menustyles->create('moduletitle', $objclass, 1, 1, 1, 0); ?>
                    </div>
                    <div class="pane">
                        <div id="ckpopupdescription">
                                <div id="ckpopupdescriptiontitle"><?php echo JText::_('CK_MENU_DESC_TITLE'); ?></div>
                    <?php echo JText::_('CK_MENU_DESC_TEXT'); ?>
                    
                    <div id="ckpopupillustration">
                        <img align="right" src="<?php echo JURI::ROOT(); ?>administrator/components/com_templateck/images/illustration_menus.png" />
                    </div>
                                </div>
                        <ul id="elementsmenu2">
                            <div style="float:left;width:75px;padding:3px;background:#2a2929;-moz-border-radius: 7px 0 0 0;border-radius: 7px 0 0 0;text-align:right;"><?php echo JText::_('CK_FIRST_LEVEL'); ?></div>
                            <li class="menulink2"><?php echo JText::_('CK_FIRST_LEVEL_CONTAINER'); ?></li>
                            <li class="menulink2"><?php echo JText::_('CK_FIRST_LEVEL_MENULINK'); ?></li>
                            <li class="menulink2"><?php echo JText::_('CK_FIRST_LEVEL_MENULINK_HOVER'); ?></li>
                            <li class="menulink2"><?php echo JText::_('CK_FIRST_LEVEL_MENULINK_ACTIVE'); ?></li>
                            <div style="clear:both;border-bottom: 1px solid #2a2929;"></div>
                            <div style="float:left;width:75px;padding:3px;background:#2a2929;text-align:right;"><?php echo JText::_('CK_FIRST_SUBLEVEL'); ?></div>
                            <li class="menulink2"><?php echo JText::_('CK_FIRST_SUBLEVEL_CONTAINER'); ?></li>
                            <li class="menulink2"><?php echo JText::_('CK_FIRST_SUBLEVEL_MENULINK'); ?></li>
                            <li class="menulink2"><?php echo JText::_('CK_FIRST_SUBLEVEL_MENULINK_HOVER'); ?></li>
                            <li class="menulink2"><?php echo JText::_('CK_FIRST_SBULEVEL_MENULINK_ACTIVE'); ?></li>
                             <div style="clear:both;border-bottom: 1px solid #2a2929;"></div>
                             <div style="float:left;width:75px;padding:3px;background:#2a2929;-moz-border-radius: 0 0 0 7px;border-radius: 0 0 0 7px;text-align:right;"><?php echo JText::_('CK_SECOND_SUBLEVEL'); ?></div>
                            <li class="menulink2"><?php echo JText::_('CK_SECOND_SUBLEVEL_CONTAINER'); ?></li>
                            <div class="clr"></div>
                        </ul>
                        <div id="elementscontent2">
                            <div class="pane2"><?php echo $menustyles->create('level0bg', $objclass, 0, 1, 1, 0); ?></div>
                            <div class="pane2"><?php echo $menustyles->create('level0item', $objclass, 1, 1, 0, 0); ?></div>
                            <div class="pane2"><?php echo $menustyles->create('level0itemhover', $objclass, 1, 1, 0, 0); ?></div>
                            <div class="pane2"><?php echo $menustyles->create('level0itemactive', $objclass, 1, 1, 0, 0); ?></div>
                            <div class="pane2"><?php echo $menustyles->create('level1bg', $objclass, 0, 0, 1, 0); ?></div>
                            <div class="pane2"><?php echo $menustyles->create('level1item', $objclass, 1, 1, 0, 0); ?></div>
                            <div class="pane2"><?php echo $menustyles->create('level1itemhover', $objclass, 1, 1, 0, 0); ?></div>
                            <div class="pane2"><?php echo $menustyles->create('level1itemactive', $objclass, 1, 1, 0, 0); ?></div>
                            <div class="pane2"><?php echo $menustyles->create('level2bg', $objclass, 0, 0, 1, 0); ?></div>
                        </div>
                    </div>
            <?php } ?>
            <?php if ($isBody) {
            ?>
                        <div class="pane">
                            <div id="ckpopupdescription">
                                <div id="ckpopupdescriptiontitle"><?php echo JText::_('CK_TITLE_DESC_TITLE'); ?></div>
                    <?php echo JText::_('CK_TITLE_DESC_TEXT'); ?>

                    <div id="ckpopupillustration">
<!--                        <img align="right" src="<?php //echo JURI::ROOT(); ?>administrator/components/com_templateck/images/illustration_menus.png" />-->
                    </div>
                                </div>
                            <ul id="elementsmenu2">
                                <li class="menulink2"><?php echo JText::_('CK_H1'); ?></li>
                                <li class="menulink2"><?php echo JText::_('CK_H2'); ?></li>
                                <li class="menulink2"><?php echo JText::_('CK_H3'); ?></li>
                                <li class="menulink2"><?php echo JText::_('CK_H4'); ?></li>
                                <li class="menulink2"><?php echo JText::_('CK_H5'); ?></li>
                                <li class="menulink2"><?php echo JText::_('CK_H6'); ?></li>
                                <div class="clr"></div>
                            </ul>
                            <div id="elementscontent2">
                                <div class="pane2"><?php echo $menustyles->create('h1title', $objclass, 1, 1, 1, 1); ?></div>
                                <div class="pane2"><?php echo $menustyles->create('h2title', $objclass, 1, 0, 0, 1); ?></div>
                                <div class="pane2"><?php echo $menustyles->create('h3title', $objclass, 1, 0, 0, 1); ?></div>
                                <div class="pane2"><?php echo $menustyles->create('h4title', $objclass, 1, 0, 0, 1); ?></div>
                                <div class="pane2"><?php echo $menustyles->create('h5title', $objclass, 1, 0, 0, 1); ?></div>
                                <div class="pane2"><?php echo $menustyles->create('h6title', $objclass, 1, 0, 0, 1); ?></div>
                            </div>
                        </div>
                        <div class="pane">
                            <div id="ckpopupdescription">
                                <div id="ckpopupdescriptiontitle"><?php echo JText::_('CK_BUTTON_DESC_TITLE'); ?></div>
                    <?php echo JText::_('CK_BUTTON_DESC_TEXT'); ?>

                    <div id="ckpopupillustration">
<!--                        <img align="right" src="<?php //echo JURI::ROOT(); ?>administrator/components/com_templateck/images/illustration_menus.png" />-->
                    </div>
                                </div>
                            <div id="paneContainer3">
                                <ul id="elementsmenu3">
                                    <li class="menulink3"><?php echo JText::_('CK_PAGENAV'); ?></li>
                                    <li class="menulink3"><?php echo JText::_('CK_PAGENAV_HOVER'); ?></li>
                                    <li class="menulink3"><?php echo JText::_('CK_READMORE'); ?></li>
                                    <li class="menulink3"><?php echo JText::_('CK_READMORE_HOVER'); ?></li>
                                    <div style="clear:both;border-bottom: 1px solid #2a2929;"></div>
                                    <li class="menulink3"><?php echo JText::_('CK_BUTTON'); ?></li>
                                    <li class="menulink3"><?php echo JText::_('CK_BUTTON_HOVER'); ?></li>
                                    <li class="menulink3"><?php echo JText::_('CK_INPUTFIELD'); ?></li>
                                    <li class="menulink3"><?php echo JText::_('CK_INPUTFIELD_ACTIVE'); ?></li>
                                    <div class="clr"></div>
                                </ul>
                                <div id="elementscontent3">
                                    <div class="pane3"><?php echo $menustyles->create('pagenavbutton', $objclass, 1, 1, 1, 1); ?></div>
                                    <div class="pane3"><?php echo $menustyles->create('pagenavbuttonhover', $objclass, 1, 1, 1, 1); ?></div>
                                    <div class="pane3"><?php echo $menustyles->create('readmorebutton', $objclass, 1, 1, 1, 1); ?></div>
                                    <div class="pane3"><?php echo $menustyles->create('readmorebuttonhover', $objclass, 1, 1, 1, 1); ?></div>
                                    <div class="pane3"><?php echo $menustyles->create('buttonbutton', $objclass, 1, 1, 1, 1); ?></div>
                                    <div class="pane3"><?php echo $menustyles->create('buttonbuttonhover', $objclass, 1, 1, 1, 1); ?></div>
                                    <div class="pane3"><?php echo $menustyles->create('inputfieldbutton', $objclass, 1, 1, 1, 1); ?></div>
                                    <div class="pane3"><?php echo $menustyles->create('inputfieldbuttonactive', $objclass, 1, 1, 1, 1); ?></div>
                                </div>

                            </div>
                        </div>
                        <div class="pane" style="text-align:left;height: 25px;width: 750px;clear:both;">
                            <div id="ckpopupdescription">
                                <div id="ckpopupdescriptiontitle"><?php echo JText::_('CK_IMAGE_DESC_TITLE'); ?></div>
                    <?php echo JText::_('CK_IMAGE_DESC_TEXT'); ?>

                    <div id="ckpopupillustration">
<!--                        <img align="right" src="<?php //echo JURI::ROOT(); ?>administrator/components/com_templateck/images/illustration_menus.png" />-->
                    </div>
                                </div>
                            <div style="text-align:left;height: 25px;clear:both;">
                                <input style="width:200px;" class="inputbox" type="text" value="" name="emailsystemimageurl" id="emailsystemimageurl" size="10" /><a class="modal" href="index.php?option=com_media&view=images&tmpl=component&e_name=emailsystemimageurl" rel="{handler: 'iframe', size: {x: 570, y: 400}}" ><?php echo JText::_('CK_SELECT'); ?></a><img src="<?php echo JURI::ROOT(); ?>administrator/components/com_templateck/images/emailButton.png" align="middle" /><?php echo JText::_('CK_EMAIL_IMAGE'); ?>
                            </div>
                            <div style="text-align:left;height: 25px;clear:both;">
                                <input style="width:200px;" class="inputbox" type="text" value="" name="printsystemimageurl" id="printsystemimageurl" size="10" /><a class="modal" href="index.php?option=com_media&view=images&tmpl=component&e_name=printsystemimageurl" rel="{handler: 'iframe', size: {x: 570, y: 400}}" ><?php echo JText::_('CK_SELECT'); ?></a><img src="<?php echo JURI::ROOT(); ?>administrator/components/com_templateck/images/printButton.png" align="middle" /><?php echo JText::_('CK_PRINT_IMAGE'); ?>
                            </div>
                            <div style="text-align:left;height: 25px;clear:both;">
                                <input style="width:200px;" class="inputbox" type="text" value="" name="ratingblanksystemimageurl" id="ratingblanksystemimageurl" size="10" /><a class="modal" href="index.php?option=com_media&view=images&tmpl=component&e_name=ratingblanksystemimageurl" rel="{handler: 'iframe', size: {x: 570, y: 400}}" ><?php echo JText::_('CK_SELECT'); ?></a><img src="<?php echo JURI::ROOT(); ?>administrator/components/com_templateck/images/rating_star_blank.png" /><?php echo JText::_('CK_RATINGBLANK_IMAGE'); ?>
                            </div>
                            <div style="text-align:left;height: 25px;clear:both;">
                                <input style="width:200px;" class="inputbox" type="text" value="" name="ratingfilledsystemimageurl" id="ratingfilledsystemimageurl" size="10" /><a class="modal" href="index.php?option=com_media&view=images&tmpl=component&e_name=ratingfilledsystemimageurl" rel="{handler: 'iframe', size: {x: 570, y: 400}}" ><?php echo JText::_('CK_SELECT'); ?></a><img src="<?php echo JURI::ROOT(); ?>administrator/components/com_templateck/images/rating_star.png" /><?php echo JText::_('CK_RATINGFILLED_IMAGE'); ?>
                            </div>
                            <div style="text-align:left;height: 25px;clear:both;">
                                <input style="width:200px;" class="inputbox" type="text" value="" name="editsystemimageurl" id="editsystemimageurl" size="10" /><a class="modal" href="index.php?option=com_media&view=images&tmpl=component&e_name=editsystemimageurl" rel="{handler: 'iframe', size: {x: 570, y: 400}}" ><?php echo JText::_('CK_SELECT'); ?></a><img src="<?php echo JURI::ROOT(); ?>administrator/components/com_templateck/images/edit.png" /><?php echo JText::_('CK_EDIT_IMAGE'); ?>
                            </div>
                            <div style="text-align:left;height: 25px;clear:both;">
                                <input style="width:200px;" class="inputbox" type="text" value="" name="arrowsystemimageurl" id="arrowsystemimageurl" size="10" /><a class="modal" href="index.php?option=com_media&view=images&tmpl=component&e_name=arrowsystemimageurl" rel="{handler: 'iframe', size: {x: 570, y: 400}}" ><?php echo JText::_('CK_SELECT'); ?></a><img src="<?php echo JURI::ROOT(); ?>administrator/components/com_templateck/images/arrow.png" /><?php echo JText::_('CK_ARROW_IMAGE'); ?>
                            </div>
                            <div style="text-align:left;height: 25px;clear:both;">
                                <input style="width:200px;" class="inputbox" type="text" value="" name="faviconsystemimageurl" id="faviconsystemimageurl" size="10" /><a class="modal" href="index.php?option=com_media&view=images&tmpl=component&e_name=faviconsystemimageurl" rel="{handler: 'iframe', size: {x: 570, y: 400}}" ><?php echo JText::_('CK_SELECT'); ?></a><img src="<?php echo JURI::ROOT(); ?>administrator/components/com_templateck/images/favicon.png" /><?php echo JText::_('CK_FAVICON_IMAGE'); ?>
                            </div>
                            <div style="text-align:left;height: 25px;clear:both;">
                                <input style="width:200px;" class="inputbox" type="text" value="" name="template_thumbnailsystemimageurl" id="template_thumbnailsystemimageurl" size="10" /><a class="modal" href="index.php?option=com_media&view=images&tmpl=component&e_name=template_thumbnailsystemimageurl" rel="{handler: 'iframe', size: {x: 570, y: 400}}" ><?php echo JText::_('CK_SELECT'); ?></a><img src="<?php echo JURI::ROOT(); ?>administrator/components/com_templateck/images/nul.png" /><?php echo JText::_('CK_THUMB_IMAGE'); ?>
                            </div>
                            <div style="text-align:left;height: 25px;clear:both;">
                                <input style="width:200px;" class="inputbox" type="text" value="" name="template_previewsystemimageurl" id="template_previewsystemimageurl" size="10" /><a class="modal" href="index.php?option=com_media&view=images&tmpl=component&e_name=template_previewsystemimageurl" rel="{handler: 'iframe', size: {x: 570, y: 400}}" ><?php echo JText::_('CK_SELECT'); ?></a><img src="<?php echo JURI::ROOT(); ?>administrator/components/com_templateck/images/nul.png" /><?php echo JText::_('CK_PREVIEW_IMAGE'); ?>
                            </div>
                        </div>
            <?php } ?>
                </div>
            </div>
        </ul>

<?php
//if (!($htmlpage = $cache->get($objid, 'com_templateck'))) {
//$htmlpage = ob_get_contents();
//ob_end_clean();
//
//}
//echo $htmlpage;
//$cache->store($htmlpage, $objid, 'com_templateck');
?>
