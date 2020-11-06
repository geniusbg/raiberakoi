<?php
/**
 * @copyright	Copyright (C) 2011 Cédric KEIFLIN alias ced1870
 * http://www.ck-web-creation-alsace.com
 * http://www.joomlack.fr
 * Module mooCoverFlow_CK pour Joomla! 1.6
 * @license		GNU/GPL
**/

// no direct access
defined('_JEXEC') or die('Restricted access');
?>
<div id="MooFlow<?php echo $module->id; ?>" class="mf" style="width:<?php echo $params->get('width','400') ?>px;">
    <?php
    foreach ($items as $i => &$item) {
        echo '<a href="'.$item->link.'" rel="lightbox">'
                .$item->image
            .'</a>';
    }
    ?>
</div>