<?php
/**
 * @copyright	Copyright (C) 2011 Cédric KEIFLIN alias ced1870
 * http://www.template-creator.com
 * Component Template Creator CK
 * @license		GNU/GPL
 * */
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
// var_dump($this->code);
// echo $this->template->htmlcode_responsive;
?>
<script type="text/javascript">
    Joomla.submitbutton = function(task)
    {
        //alert(JSON.encode($('blocresolution320').getElements('.ckbloc').getProperties('class','ckid','data-mobile')));
        document.id('resolution1').value = JSON.encode($('blocresolution1').getElements('.ckbloc').getProperties('class','ckid','ckmobile'));
        document.id('resolution2').value = JSON.encode($('blocresolution2').getElements('.ckbloc').getProperties('class','ckid','ckmobile'));
        document.id('resolution3').value = JSON.encode($('blocresolution3').getElements('.ckbloc').getProperties('class','ckid','ckmobile'));
        document.id('resolution4').value = JSON.encode($('blocresolution4').getElements('.ckbloc').getProperties('class','ckid','ckmobile'));
        //document.id('htmlcode_responsive').value = genResponsivecode(document.id('conteneur'));

        var form = document.adminForm;
        if (task == 'cancel') {
            Joomla.submitform(task);
            return;
        }
        // do field validation
        // if (form.name.value == "") {
        // alert( "<?php echo JText::_('TEMPLATE_MUST_HAVE_NAME', true); ?>" );
        // } else {
        Joomla.submitform(task);
        // }
    }
	
    function showPopup(obj) {
        $$('.focus').removeClass('focus');
        obj.addClass('focus');
        if ($('ckpopup').getStyle('display') != 'block') {
            document.getElements('.ckpopup').setStyles({
                'opacity':'0',
                'display':'none'
            });
            document.id('ckpopup').setStyle('display','block').tween('opacity', '1');
            loadFields(obj);
        }
		
    }
	
    function savePopup(button) {
        var focus_setting = document.getElement('.ckmobile_active');
        if (!focus_setting) return;
        var focus = document.getElement('.focus');
        if (!focus) return;

        focus.setProperty('ckmobile',focus_setting.id);
    }
	
    /*
     * function to display the css fields
     */
    function loadFields(obj) {
        var myurl = "index.php?option=com_templateck&view=mobile&layout=ajaxfields&tmpl=component";
        var packageRequest = new Request.HTML({
            url:myurl,
            method: 'post',
            update: document.id('ckpopup_inner'),
            onRequest: function(){
                //document.id('packagestepcss').set('text', Joomla.JText._('CK_LOADING', 'Loading...'));
            },
            onSuccess: function(){
                //document.id('packagestepcss').set('text', Joomla.JText._('CK_LOAD_SUCCESS_STEP_CSS', 'Next step finished with success'));
                //makeXmlStep(form,makeArchive);
            },
            onFailure: function(){
                //document.id('packagestepcss').set('text', Joomla.JText._('CK_LOAD_FAILURE_STEP_CSS', 'Next step encounter some errors'));
            }

        }).post("objclass="+obj.className+"&objid="+obj.id+"&objmobile="+obj.getProperty('ckmobile'));
        packageRequest.send();
    }
	
    window.addEvent('domready', function() {
        // $$('.resolution').each(function(el) {
        // alert(el.id);
        // if (el.id == 'resolution320')
        // el.setStyle('background','red');
        // document.getElementById('resolution480').setStyle('background','green');
        // });;

        $$('.ckbloc').each(function(el) {
            el.addEvent('click', function() {
                // el.setProperty('ckmobile','testdeced');
                showPopup(el);
            });
        });
	
	
	
/* pour test preview
        var mobilewrapper = $('mobilewrapperbg');
        var myEffect = new Fx.Morph(mobilewrapper, {
            duration: 'long',
            transition: Fx.Transitions.Sine.easeOut
        });
 

        $('iphoneportrait').addEvent('click', function() {
            mobilewrapper.removeClass('iphonelandscape');
            mobilewrapper.removeClass('ipadportrait');
            mobilewrapper.removeClass('ipadlandscape');
            mobilewrapper.removeClass('tablet640');
            mobilewrapper.addClass('iphoneportrait');
        });
	
        $('iphonelandscape').addEvent('click', function() {
            mobilewrapper.removeClass('iphoneportrait');
            mobilewrapper.removeClass('ipadportrait');
            mobilewrapper.removeClass('ipadlandscape');
            mobilewrapper.removeClass('tablet640');
            mobilewrapper.addClass('iphonelandscape');
        });
	
        $('tablet640').addEvent('click', function() {
            mobilewrapper.removeClass('iphoneportrait');
            mobilewrapper.removeClass('ipadportrait');
            mobilewrapper.removeClass('ipadlandscape');
            mobilewrapper.removeClass('iphonelandscape');
            mobilewrapper.addClass('tablet640');
        });
	
        $('ipadportrait').addEvent('click', function() {
            mobilewrapper.removeClass('iphoneportrait');
            mobilewrapper.removeClass('iphonelandscape');
            mobilewrapper.removeClass('ipadlandscape');
            mobilewrapper.removeClass('tablet640');
            mobilewrapper.addClass('ipadportrait');
        });
	
        $('ipadlandscape').addEvent('click', function() {
            mobilewrapper.removeClass('iphoneportrait');
            mobilewrapper.removeClass('iphonelandscape');
            mobilewrapper.removeClass('ipadportrait');
            mobilewrapper.removeClass('tablet640');
            mobilewrapper.addClass('ipadlandscape');
        });*/
    });
    
</script>

<form action="index.php" enctype="multipart/form-data" method="post" name="adminForm" id="adminForm" class="form-validate">
    <input type="hidden" name="resolution1" id="resolution1" value="" />
    <input type="hidden" name="resolution2" id="resolution2" value="" />
    <input type="hidden" name="resolution3" id="resolution3" value="" />
    <input type="hidden" name="resolution4" id="resolution4" value="" />
    <input type="hidden" name="option" value="com_templateck" />
    <input type="hidden" name="id" value="<?php echo $this->mobilecode->id; ?>" />
    <input type="hidden" name="templateid" value="<?php echo $this->mobilecode->templateid; ?>" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="controller" value="mobile" />
</form>
<div>
<?php
// var_dump($this->mobilecode);
// var_dump($this->code);
$resolutions = array('1', '2', '3', '4');

// var_dump($this->mobilecode);

foreach ($resolutions as $resolution) {
?>
    <div id="blocresolution<?php echo $resolution; ?>" class="blocresolution">
        <p class="resolution-title"><?php echo JText::_('CK_RESOLUTION'.$resolution) ; ?></p>
<?php
    foreach ($this->code as $block) {
        $val = 'resolution' . $resolution;
        $ckid = $block->ckid;
        $test = $this->mobilecode->$val;
// var_dump($this->mobilecode->$val);
// var_dump($block->ckclass);
        if ($block->ckid AND !(
                //stristr($block->ckclass, 'bannerlogo') OR
                //stristr($block->ckclass, 'bannerlogodesc') OR
                (stristr($block->ckclass, 'banner') AND !stristr($block->ckclass, 'mainbanner')) 
                OR stristr($block->ckclass, 'flexiblemodule ')
                OR stristr($block->ckclass, 'column')
                OR stristr($block->ckclass, 'maintop')
                OR stristr($block->ckclass, 'centertop')
                OR (stristr($block->ckclass, 'content') AND !stristr($block->ckclass, 'maincontent'))
                OR stristr($block->ckclass, 'centerbottom')
                OR stristr($block->ckclass, 'mainbottom')
                )) {
            $ckmobile = isset($this->mobilecode->$val->$ckid) ? $this->mobilecode->$val->$ckid : '';
            echo '<div class="' . $block->ckclass . '"'
            . ' ckid="' . $block->ckid . '"'
            . ' ckmobile="' . $ckmobile . '">'
            . $block->ckid . '</div>';
        }
    }
?>
    </div>
<?php
}
?>
    <div class="clr"></div>
</div>
<div id="ckpopup" class="ckpopup">
    <div id="ckpopup_inner">
    </div>
</div>
<!--
<div id="iphoneportrait">click for iphone portait 320px</div>
<div id="iphonelandscape">click for iphone landscape 480px</div>
<div id="tablet640">click for resolution 640px</div>
<div id="ipadportrait">click for ipad portait 768px</div>
<div id="ipadlandscape">click for ipad landscape 1024px</div>
<div id="mobilewrapperbg">
    <div id="mobilewrapper">
        <iframe style="width:100%;height:100%;overflow:hidden" src="<?php echo JURI::root(); ?>index.php?templatename=templatecreator2&template=templatecreatorck" />
    </div>
</div>
-->




