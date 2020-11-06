<?php

/**
 * @copyright  GENIUS
 * httpwww.system-bg.info
 * Template made with the joomla component Template Creator CK - http://www.joomlack.fr
 * raibera
 * @license NickolayPetroff
 * @version 1.0
 * */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>" >
<head>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/bg_BG/all.js#xfbml=1&appId=1403005629956523";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div class="fb-recommendations-bar" data-site="www.raiberakoi.com" data-read-time="30" data-side="left" data-action="like"></div>

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
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/mobile.css" type="text/css" />
    <?php } ?>
    <?php if ($this->params->get('usecsspie','1')) { ?><!--[if lte IE 8]>
    <style type="text/css">
    .pagenav a,.readmore a,.button,#nav > div.inner,#nav > div.inner ul.menu ul,#modulestop > div.inner,#left > div.inner,#center > div.inner,#right > div.inner,#modulesbottom > div.inner { behavior: url(<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/pie.htc) }
    </style>
    <![endif]--><?php } ?>
<?php
$nbmodules3 = (bool)$this->countModules('position-8') + (bool)$this->countModules('position-9') + (bool)$this->countModules('position-10') + (bool)$this->countModules('position-11') + (bool)$this->countModules('position-12');
?>

<?php
$mainclass = "";
if (!$this->countModules('position-7')) { $mainclass .= " noleft";}
if (!$this->countModules('position-6')) { $mainclass .= " noright";}
$mainclass = trim($mainclass); ?>

<?php
$nbmodules20 = (bool)$this->countModules('position-13') + (bool)$this->countModules('position-14') + (bool)$this->countModules('position-15') + (bool)$this->countModules('position-16') + (bool)$this->countModules('position-17');
?>

</head>
<body>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-49132238-2', 'raiberakoi.com');
  ga('send', 'pageview');

</script>


<div id="wrapper">
  <div class="inner container-fluid">
  <?php if ($this->countModules('position-1')) : ?>
  <div id="nav">
    <div class="inner clearfix">
      <jdoc:include type="modules" name="position-1" />
    </div>
  </div>
  <?php endif; ?>

  <?php if ($nbmodules3) : ?>
  <div id="modulestop">
    <div class="inner clearfix <?php echo 'n'.$nbmodules3 ?>">
      <?php if ($this->countModules('position-8')) : ?>
      <div id="modulestopmod1" class="flexiblemodule ">
        <div class="inner clearfix">
          <jdoc:include type="modules" name="position-8" style="xhtml" />
        </div>
      </div>
      <?php endif; ?>
      <?php if ($this->countModules('position-9')) : ?>
      <div id="modulestopmod2" class="flexiblemodule ">
        <div class="inner clearfix">
          <jdoc:include type="modules" name="position-9" style="xhtml" />
        </div>
      </div>
      <?php endif; ?>
      <?php if ($this->countModules('position-10')) : ?>
      <div id="modulestopmod3" class="flexiblemodule ">
        <div class="inner clearfix">
          <jdoc:include type="modules" name="position-10" style="xhtml" />
        </div>
      </div>
      <?php endif; ?>
      <?php if ($this->countModules('position-11')) : ?>
      <div id="modulestopmod4" class="flexiblemodule ">
        <div class="inner clearfix">
          <jdoc:include type="modules" name="position-11" style="xhtml" />
        </div>
      </div>
      <?php endif; ?>
      <?php if ($this->countModules('position-12')) : ?>
      <div id="modulestopmod5" class="flexiblemodule ">
        <div class="inner clearfix">
          <jdoc:include type="modules" name="position-12" style="xhtml" />
        </div>
      </div>
      <?php endif; ?>
      <div class="clr"></div>
    </div>
  </div>
  <?php endif; ?>

  <div id="maincontent">
    <div class="inner clearfix">
    <?php if ($this->countModules('position-7')) : ?>
      <div id="left" class="column column1">
        <div class="inner clearfix">
          <jdoc:include type="modules" name="position-7" style="xhtml" />
        </div>
      </div>
      <?php endif; ?>
      <div id="main" class="column main <?php echo $mainclass ?> ">
        <div class="inner clearfix">
          <?php if ($this->countModules('maintop')) : ?>
          <div id="maintop">
            <div class="inner clearfix">
              <jdoc:include type="modules" name="maintop" style="xhtml" />
            </div>
          </div>
          <?php endif; ?>
          <div id="maincenter" class="maincenter ">
            <div class="inner clearfix">
              <div id="center" class="column center ">
                <div class="inner">
                  <?php if ($this->countModules('centertop')) : ?>
                  <div id="centertop" class="">
                    <div class="inner clearfix">
                      <jdoc:include type="modules" name="centertop" style="xhtml" />
                    </div>
                  </div>
                  <?php endif; ?>
                  <div id="content" class="">
                    <div class="inner clearfix">
                      <jdoc:include type="message" />
                      <jdoc:include type="component" />
                    </div>
                  </div>
                  <?php if ($this->countModules('centerbottom')) : ?>
                  <div id="centerbottom" class="">
                    <div class="inner clearfix">
                      <jdoc:include type="modules" name="centerbottom" style="xhtml" />
                    </div>
                  </div>
                  <?php endif; ?>
                </div>
              </div>
              <?php if ($this->countModules('position-6')) : ?>
              <div id="right" class="column column2">
                <div class="inner clearfix">
                  <jdoc:include type="modules" name="position-6" style="xhtml" />
                </div>
              </div>
              <?php endif; ?>
              <div class="clr"></div>
            </div>
          </div>
          <?php if ($this->countModules('mainbottom')) : ?>
          <div id="mainbottom">
            <div class="inner clearfix">
              <jdoc:include type="modules" name="mainbottom" style="xhtml" />
            </div>
          </div>
          <?php endif; ?>

        </div>
      </div>
      <div class="clr"></div>
    </div>
  </div>
  <?php if ($nbmodules20) : ?>
  <div id="modulesbottom">
    <div class="inner clearfix <?php echo 'n'.$nbmodules20 ?>">
      <?php if ($this->countModules('position-13')) : ?>
      <div id="modulesbottommod1" class="flexiblemodule ">
        <div class="inner clearfix">
          <jdoc:include type="modules" name="position-13" style="xhtml" />
        </div>
      </div>
      <?php endif; ?>
      <?php if ($this->countModules('position-14')) : ?>
      <div id="modulesbottommod2" class="flexiblemodule ">
        <div class="inner clearfix">
          <jdoc:include type="modules" name="position-14" style="xhtml" />
        </div>
      </div>
      <?php endif; ?>
      <?php if ($this->countModules('position-15')) : ?>
      <div id="modulesbottommod3" class="flexiblemodule ">
        <div class="inner clearfix">
          <jdoc:include type="modules" name="position-15" style="xhtml" />
        </div>
      </div>
      <?php endif; ?>
      <?php if ($this->countModules('position-16')) : ?>
      <div id="modulesbottommod4" class="flexiblemodule ">
        <div class="inner clearfix">
          <jdoc:include type="modules" name="position-16" style="xhtml" />
        </div>
      </div>
      <?php endif; ?>
      <?php if ($this->countModules('position-17')) : ?>
      <div id="modulesbottommod5" class="flexiblemodule ">
        <div class="inner clearfix">
          <jdoc:include type="modules" name="position-17" style="xhtml" />
        </div>
      </div>
      <?php endif; ?>
      <div class="clr"></div>
    </div>
  </div>
  <?php endif; ?>

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
