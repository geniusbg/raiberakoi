<?php
/**
 * @copyright	Copyright (C) 2013 Cedric KEIFLIN alias ced1870
 * http://www.joomlack.fr
 * Module Playlist CK
 * @license		GNU/GPL
 * */
// no direct access
defined('_JEXEC') or die('Restricted access');
JHtml::_('behavior.modal');
// définit la largeur du slideshow
$width = ($params->get('width') AND $params->get('width') != 'auto') ? ' style="width:' . $params->get('width') . 'px;"' : '';
?>
<!-- debut Playlist CK -->
<div id="playlistck_wrap_cont_<?php echo $module->id; ?>" class="playlistck_wrap_cont">
	<div class="playlistck<?php echo $params->get('moduleclass_sfx'); ?> playlistck_wrap <?php echo $params->get('skin'); ?>" id="playlistck_wrap_<?php echo $module->id; ?>"<?php echo $width; ?>>

		<?php
		foreach ($items as $i => $item) {

			$dataalignment = '';	
			$imgtarget = ($item->imgtarget == 'default') ? $params->get('imagetarget') : $item->imgtarget;
			$datatitle = ($params->get('lightboxcaption', 'caption') != 'caption') ? 'data-title="' . htmlspecialchars(str_replace("\"", "&quot;", str_replace(">", "&gt;", str_replace("<", "&lt;", $datacaption)))) . '" ' : '';
			$datarel = ($imgtarget == 'lightbox') ? 'data-rel="lightbox" ' : '';
			$datatime = ($item->imgtime) ? ' data-time="' . $item->imgtime . '"' : '';
			?>
			<div <?php echo $datarel . $datatitle; ?>data-thumb="<?php echo $item->imgthumb; ?>" data-src="<?php echo $item->imgname; ?>" <?php if ($item->imglink) echo 'data-link="' . $item->imglink . '" data-target="' . $imgtarget . '"'; echo $dataalignment . $datatime; ?>>    
				<?php if ($item->imgvideo) { ?>
					<iframe src="<?php echo $item->imgvideo; ?>" width="100%" height="100%" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
				<?php
				} //else { 
				if (($item->imgcaption || $item->article) && (($params->get('lightboxcaption', 'caption') != 'title' || $imgtarget != 'lightbox') || !$item->imglink)) {
					?>
					<div class="playlistck_caption <?php echo $params->get('captioneffect', 'moveFromBottom'); ?>">
						<div class="playlistck_caption_title">
							<?php echo str_replace("|dq|", "\"", $item->imgtitle); ?>
							<?php
							if ($item->article && $params->get('showarticletitle', '1') == '1') {
								if ($params->get('articlelink', 'readmore') == 'title')
									echo '<a href="' . $item->article->link . '">';
								echo $item->article->title;
								if ($params->get('articlelink', 'readmore') == 'title')
									echo '</a>';
							}
							?>
						</div>
						<div class="playlistck_caption_desc">
		<?php echo str_replace("|dq|", "\"", $item->imgcaption); ?>
					<?php
					if ($item->article) {
						echo $item->article->text;
						if ($params->get('articlelink', 'readmore') == 'readmore')
							echo '<a href="' . $item->article->link . '">' . JText::_('COM_CONTENT_READ_MORE_TITLE') . '</a>';
					}
					?>
						</div>
					</div>
		<?php
	}
	//} 
	?>
			</div>
<?php } ?>

	</div>
</div>
<div style="clear:both;"></div>
<!-- fin Playlist CK -->
