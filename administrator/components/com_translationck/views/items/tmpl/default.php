<?php
/**
 * @version     1.0.0
 * @package     com_translationck
 * @copyright   Copyright (C) 2011. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Created by com_combuilder - http://www.notwebdesign.com
 */


// no direct access
defined('_JEXEC') or die;
JHTML::_('behavior.framework');
?>
<script language="javascript" type="text/javascript">
function getResult() {
	var componentname = $('componentname').value;
	var languageprefix = $('languageprefix').value;
	
	var myurl = "index.php?option=com_translationck&view=items&layout=ajaxresult&tmpl=component";
	var packageRequest = new Request.HTML({
            url:myurl,
            method: 'post',
            update: $('result'),
            onRequest: function(){
                // document.id('packagestepcss').set('text', Joomla.JText._('CK_LOADING', 'Loading...'));
            },
            onSuccess: function(){
                // document.id('packagestepcss').set('text', Joomla.JText._('CK_LOAD_SUCCESS_STEP_CSS', 'Next step finished with success'));
                // makeXmlStep(form,makeArchive);
            },
            onFailure: function(){
                // document.id('packagestepcss').set('text', Joomla.JText._('CK_LOAD_FAILURE_STEP_CSS', 'Next step encounter some errors'));
            }

        }).post("componentname="+componentname
            +"&languageprefix="+languageprefix);
        packageRequest.send();
}
</script>  
<input name="componentname" id="componentname" type="text" value="com_content" />
<input name="languageprefix" id="languageprefix" type="text" value="en-GB" />
<input name="submit" type="button" onclick="getResult();" value="GO !" />
<div id="result"></div>