<?php
/**
 * @copyright	Copyright (C) 2012 Cédric KEIFLIN alias ced1870
 * http://www.joomlack.fr
 * Module Beautiful CK
 * @license		GNU/GPL
 * */

// No direct access.
defined('_JEXEC') or die;

$fontfamily = $params->get('textgfont', '0') ? "font-family:'".$params->get('textgfont', 'Droid Sans') ."';" : '';
?>
<div id="<?php echo $menuID; ?>" class="beautifulck <?php echo $theme.' '.$colorvariation; ?>">
    <div class="beautifulckbg" style="left: <?php echo $params->get('bannerleft', '-10'); ?>px; top:<?php echo $params->get('bannertop', '5'); ?>px;width: <?php echo $params->get('bannerwidth', '200'); ?>px;">
        <div class="beautifulckbgleft"></div>
        <div class="beautifulckbgcenter"></div>
        <div class="beautifulckbgcentercolor"></div>
        <div class="beautifulckbgright"></div>
    <?php if ($bannericon != '-1') : ?>
        <img src="<?php echo JURI::root().'modules/mod_beautifulck/icons/'.$bannericon; ?>" 
             alt="<?php echo $bannericon; ?>"
             class="beautifulckbgicon"
             style="left: <?php echo $params->get('iconleft', '0'); ?>px;
                    top: <?php echo $params->get('icontop', '0'); ?>px;
                    position: relative;
        "/>
    <?php endif; ?>
    <?php if ($textvalue) : ?>
    <h3 style="left: <?php echo $params->get('textleft', '-10'); ?>px; 
        top:<?php echo $params->get('texttop', '5'); ?>px;
        <?php echo $fontfamily; ?>
        font-size: <?php echo $params->get('textfontsize', '12'); ?>px;
        font-weight: <?php echo $params->get('textfontweight', 'normal'); ?>;
        color: <?php echo $params->get('textcolor', '#ffffff'); ?>;
        position: relative;
        "><?php echo $textvalue; ?>
    </h3>
    <?php endif; ?>
    </div>
    <div class="beautifulck_content"><?php echo $moduleck->html; ?></div>
</div>
