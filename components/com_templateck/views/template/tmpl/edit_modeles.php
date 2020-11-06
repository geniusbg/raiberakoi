<?php
/**
 * @name		Template Creator CK 3
 * @package		com_templateck
 * @copyright	Copyright (C) 2013. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 * @author		Cedric Keiflin - http://www.template-creator.com - http://www.joomlack.fr
 */
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
?>
<style type="text/css">
	#ck_modelewrapper {
		top: 0;
		left: 0;
		padding-left: 10px;
		height: 100%;
		margin: 0 0 0 0;
	}

	div.ck_modele {
		display: inline-block;
		margin: 3px;
		padding: 5px;
		background: #fff;
		color: #777;
		text-align: center;
		border: 2px solid transparent;
	}

	div.ck_modele img {
		-moz-box-shadow: 0px 0px 5px #888;
		box-shadow: 0px 0px 5px #888;
	}

	div.ck_modele:hover {
		background: #fff;
		color: #000;
		cursor: pointer;
		border: 2px solid #000;
	}

	div.ck_modeletitle {
		text-align: center;
		font-size: 12px;
		color: #4c4c4c;
		padding: 5px;
		font-family: Verdana;
	}
</style>
<div id="ck_modelewrapper">
    <table>
        <tr>
            <td style="vertical-align:top;">
				<div class="layoutinfos">
					<div class="layoutinfostitle"><?php echo JText::_('CK_LAYOUTS'); ?></div>
					<div class="layoutinfosdesc"><?php echo JText::_('CK_LAYOUTS_DESC'); ?></div>
				</div>
            </td>
            <td style="vertical-align:top;">
				<div>
					<?php
					for ($i = 1; $i < 15; $i++) {
						?>
						<div class="ck_modele" onclick="loadModele('modele<?php echo $i ?>');">
							<img src="components/com_templateck/images/modeles/modele<?php echo $i ?>.png" width="104" height="110" />
							<div class="ck_modeletitle"><?php echo JText::_('CK_MODELE_' . $i); ?></div>
						</div>
						<?php
					}
					?>
				</div>
            </td>
        </tr>
    </table>
</div>