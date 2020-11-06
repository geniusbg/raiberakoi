<?php

/**
 * @copyright	CedricKEIFLIN
 * 
 * Template made with the joomla component Template Creator CK - http://www.joomlack.fr
 * tpl_multibackgrounds
 * @license GNUGPL
 * @version 1.0.0
 * */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>" >
<head>
    <jdoc:include type="head" />
    <link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/system/css/system.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/system/css/general.css" type="text/css" />
    <?php if ($this->params->get('usebootstrap','')) { ?>
        <?php JHtml::_('bootstrap.framework'); ?>
        <link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/bootstrap.css" type="text/css" />
        <?php JHtmlBootstrap::loadCss($includeMaincss = false, $this->direction); ?>
    <?php } ?>
    <?php if ($this->direction == 'rtl') { ?>
		<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/default_rtl.css" type="text/css" />
                <link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/template_rtl.css" type="text/css" />
    <?php } else { ?>
		<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/default.css" type="text/css" />
                <link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/template.css" type="text/css" />
	<?php } ?>
    <link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/fonts/fonts.css" type="text/css" />
    <?php if ($this->params->get('useresponsive','1')) { ?>
        <meta name="viewport" content="width=device-width; initial-scale=1.0" />
        <link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/mobile.css" type="text/css" />
    <?php } ?>
    
<?php
$nbmodules8 = (bool)$this->countModules('midnews') + (bool)$this->countModules('position-9') + (bool)$this->countModules('position-10');
?>

<?php
$mainclass = "";
if (!$this->countModules('position-7')) { $mainclass .= " noleft";}
$mainclass .= " noright";
$mainclass = trim($mainclass); ?>

</head>
<body>
<div id="topwrapper">
	<div class="container-fluid inner">
	<?php if ($this->countModules('position-1')) : ?>
	<div id="menu">
		<div class="inner clearfix">
			<jdoc:include type="modules" name="position-1" />
		</div>
	</div>
	<?php endif; ?>

	<div id="topbanner">
		<div class="inner clearfix">
			<div id="topbannerlogo" class="logobloc">
				<div class="inner clearfix">
					<?php if ($this->params->get('logolink')) { ?>
					<a href="<?php echo htmlspecialchars($this->params->get('logolink')); ?>">
					<?php } ?>
						<img src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/images/logo_fake.png" width="216px" height="53px" alt="<?php echo htmlspecialchars($this->params->get('logotitle'));?>" />
					<?php if ($this->params->get('logolink')) { ?>
					</a>
					<?php } ?>
					<?php if ($this->params->get('logodescription')) { ?>
					<div class="bannerlogodesc">
						<div class="inner clearfix"><?php echo htmlspecialchars($this->params->get('logodescription'));?></div>
					</div>
					<?php } ?>
				</div>
			</div>
			<?php if ($this->countModules('position-0')) : ?>
			<div id="topbannermodule" class="logobloc">
				<div class="inner clearfix">
					<jdoc:include type="modules" name="position-0" style="xhtml" />
				</div>
			</div>
			<?php endif; ?>
		</div>
	</div>
	<?php if ($this->countModules('topnews')) : ?>
	<div id="topnews">
		<div class="inner clearfix">
			<jdoc:include type="modules" name="topnews" style="xhtml" />
		</div>
	</div>
	<?php endif; ?>

	</div>
</div>
<div id="midwrapper">
	<div class="container-fluid inner">
	<?php if ($nbmodules8) : ?>
	<div id="midnews">
		<div class="inner clearfix <?php echo 'n'.$nbmodules8 ?>">
			<?php if ($this->countModules('midnews')) : ?>
			<div id="midnewsmod1" class="flexiblemodule ">
				<div class="inner clearfix">
					<jdoc:include type="modules" name="midnews" style="xhtml" />
				</div>
			</div>
			<?php endif; ?>
			<?php if ($this->countModules('position-9')) : ?>
			<div id="midnewsmod2" class="flexiblemodule ">
				<div class="inner clearfix">
					<jdoc:include type="modules" name="position-9" style="xhtml" />
				</div>
			</div>
			<?php endif; ?>
			<?php if ($this->countModules('position-10')) : ?>
			<div id="midnewsmod3" class="flexiblemodule ">
				<div class="inner clearfix">
					<jdoc:include type="modules" name="position-10" style="xhtml" />
				</div>
			</div>
			<?php endif; ?>
			<div class="clr"></div>
		</div>
	</div>
	<?php endif; ?>

	</div>
</div>
<div id="wrapper">
	<div class="container-fluid inner">
	<?php if ($this->countModules('bottomnews')) : ?>
	<div id="bottomnews">
		<div class="inner clearfix">
			<jdoc:include type="modules" name="bottomnews" style="xhtml" />
		</div>
	</div>
	<?php endif; ?>

	<div id="maincontent">
		<div class="inner clearfix">
			<div id="main" class="column main <?php echo $mainclass ?> ">
				<div class="inner clearfix">
											<jdoc:include type="message" />
											<jdoc:include type="component" />

				</div>
			</div>
		<?php if ($this->countModules('position-7')) : ?>
			<div id="left" class="column column1">
				<div class="inner clearfix">
					<jdoc:include type="modules" name="position-7" style="xhtml" />
				</div>
			</div>
			<?php endif; ?>
			<div class="clr"></div>
		</div>
	</div>
	<?php if ($this->countModules('position-3')) : ?>
	<div id="footer">
		<div class="inner clearfix">
			<jdoc:include type="modules" name="position-3" style="xhtml" />
		</div>
	</div>
	<?php endif; ?>


    </div>
</div>
<jdoc:include type="modules" name="debug" />
</body>
</html>