/**
 * @copyright	Copyright (C) 2011 Cédric KEIFLIN alias ced1870
 * http://www.template-creator.com
 * Component Template Creator CK
 * @license		GNU/GPL
 * */

/*----------------------------------------------------------------------------- debut new code------------------*/

/*
 * Functions to manage colors conversion
 *
 */
function hexToR(h) {
    return parseInt((cutHex(h)).substring(0,2),16)
}
function hexToG(h) {
    return parseInt((cutHex(h)).substring(2,4),16)
}
function hexToB(h) {
    return parseInt((cutHex(h)).substring(4,6),16)
}
function cutHex(h) {
    return (h.charAt(0)=="#") ? h.substring(1,7):h
}
function hexToRGB(h) {
    return 'rgb('+hexToR(h)+','+hexToG(h)+','+hexToB(h)+')';
}

/*
* Show the window for global infos (name, date, author...)
*/
function editGlobalinfos() {
    if ($('infos_code').getStyle('display') != 'block') {
        document.getElements('.ckpopup').setStyles({
            'opacity':'0',
            'display':'none'
        });
        document.id('infos_code').setStyle('display','block').tween('opacity', '1');
    }
}

/*
* Show the window for global infos (name, date, author...)
*/
function showAbout() {
    if ($('about_code').getStyle('display') != 'block') {
        document.getElements('.ckpopup').setStyles({
            'opacity':'0',
            'display':'none'
        });
        document.id('about_code').setStyle('display','block').tween('opacity', '1');
    }
}

/*
 * Create the full preview of the template
 */
function templatePreview() {
    if (document.id('name').value == '') {
        alert( Joomla.JText._('TEMPLATE_MUST_HAVE_NAME', 'You must give a name to the template') );
        return;
    }

    if (!document.id('html_code').getElement('.maincontent')) {
        alert( Joomla.JText._('TEMPLATE_MUST_HAVE_CONTENT', 'You must add a content block in the template') );
        return;
    }

    document.id('packagestep1_result').empty();
    document.id('packagestepcss_result').empty();
    document.id('packagestepxml_result').empty();
    document.id('packagesteparchive_result').empty();
    makeHtmlStep(0);
    if ($('joomla_code').getStyle('display') != 'block') {
        document.getElements('.ckpopup').setStyles({
            'opacity':'0',
            'display':'none'
        });
        $('joomla_code').setStyle('display','block').tween('opacity', '1');
    }
}

/*
 * Create the full template archive
 */
function templatePackage() {
    if (document.id('name').value == '') {
        alert( Joomla.JText._('TEMPLATE_MUST_HAVE_NAME', 'You must give a name to the template') );
        return;
    }

    if (!document.id('html_code').getElement('.maincontent')) {
        alert( Joomla.JText._('TEMPLATE_MUST_HAVE_CONTENT', 'You must add a content block in the template') );
        return;
    }

    document.id('packagestep1_result').empty();
    document.id('packagestepcss_result').empty();
    document.id('packagestepxml_result').empty();
    document.id('packagesteparchive_result').empty();
    makeHtmlStep(1);
    if ($('joomla_code').getStyle('display') != 'block') {
        document.getElements('.ckpopup').setStyles({
            'opacity':'0',
            'display':'none'
        });
        $('joomla_code').setStyle('display','block').tween('opacity', '1');
    }
}

/*--------------------------------------*
 *                                      *
 *      HTML blocks creation            *
 *                                      *
 * -------------------------------------*/

function getModnewsHTML() {
    var html = "<p><img class=\"image-left\" src=\""+URIROOT+"/administrator/templates/bluestork/images/header/icon-48-themes.png\" border=\"0\"> Félicitations, vous venez de créer un site Joomla.</p>"
    +"<p><a href=\"#\">Joomla</a> rend facile la création d'un site tel que vous le rêvez et simplifie les mises à jour et la maintenance.</p>"
    return html;
}

function getModmenuHTML() {
    var html = "<ul class=\"menu\">"
    +"<li class=\"item-437\"><a href=\"\">Comment démarrer ?</a></li>"
    +"<li class=\"item-280\"><a href=\"\">Utiliser Joomla!</a></li>"
    +"<li class=\"item-278\"><a href=\"\">Le Projet Joomla!</a></li>"
    +"<li class=\"item-279\"><a href=\"\">La communauté Joomla!</a></li></ul>";
    return html;
}

function getHorizmenuHTML() {
    var html = "<ul class=\"menu\">"
    +"<li id=\"item-435\" class=\"current active\"><a href=\"#\">Dummy item active</a></li>"
    +"<li><a href=\"#\">Dummy item</a></li>"
    +"<li><a href=\"#\">Dummy item</a></li>"
    +"<li><a href=\"#\">Dummy item</a></li>"
    +"<li id=\"item-294\" class=\"deeper parent\"><a href=\"#\">Dummy item</a>"
    +"<ul><li id=\"item-290\"><a href=\"#\">Dummy item</a></li>"
    +"<li id=\"item-438\" class=\"deeper parent\"><a href=\"#\">Dummy item</a>"
    +"<ul><li id=\"item-475\"><a href=\"#\">Dummy item</a></li></ul></li>"
    +"<li id=\"item-439\"><a href=\"#\">Dummy item</a></li></ul></li>"
    +"<li id=\"item-238\" class=\"deeper parent\"><a href=\"#\">Dummy item</a>"
    +"<ul><li id=\"item-445\"><a href=\"#\">Dummy item</a></li>"
    +"<li id=\"item-446\"><a href=\"#\">Dummy item</a></li></ul></li>"
    +"<li id=\"item-448\"><a href=\"#\">Dummy item</a></li>"
    +"</ul>";
    return html;
}

function getModmostreadHTML() {
    var html = "<ul class=\"mostread\">"
    +"<li><a href=\"\">Comment démarrer ?</a></li>"
    +"<li><a href=\"\">Utiliser Joomla!</a></li>"
    +"<li><a href=\"\">Le Projet Joomla!</a></li>"
    +"<li><a href=\"\">La communauté Joomla!</a></li></ul>";
    return html;
}

function getModloginHTML() {
    var html = "<div id=\"login-form\">"
    +"<fieldset class=\"userdata\">"
    +"<p id=\"form-login-username\">"
    +"<label for=\"modlgn-username\">Identifiant</label>"
    +"<input id=\"modlgn-username\" name=\"username\" class=\"inputbox\" size=\"18\" type=\"text\">"
    +"</p>"
    +"<p id=\"form-login-password\">"
    +"<label for=\"modlgn-passwd\">Mot de passe</label>"
    +"<input id=\"modlgn-passwd\" name=\"password\" class=\"inputbox\" size=\"18\" type=\"password\">"
    +"</p>"
    +"<p id=\"form-login-remember\">"
    +"<label for=\"modlgn-remember\">Se souvenir de moi</label>"
    +"<input id=\"modlgn-remember\" name=\"remember\" class=\"inputbox\" value=\"yes\" type=\"checkbox\">"
    +"</p>"
    +"<input class=\"button\" value=\"Connexion\">"
    +"</fieldset>"
    +"<ul>"
    +"<li><a href=\"#\">Mot de passe oublié ?</a></li>"
    +"<li><a href=\"#\">Identifiant oublié ?</a></li>"
    +"<li><a href=\"#\">Créer un compte</a></li>"
    +"</ul></div>";
    return html;
}

function getContentHTML() {
    var html = "<div class=\"item-page\"><h1>Titre de la page H1</h1>"
    +"<h2><a href=\"#\">Joomla! Titre H2</a></h2>"
    +"<ul class=\"actions\">"
    +"<li class=\"print-icon\"><a href=\"#\" title=\"Imprimer\" rel=\"nofollow\"><img src=\"../media/system/images/printButton.png\" alt=\"Imprimer\"  /></a></li>"
    +"<li class=\"email-icon\"><a href=\"#\" title=\"E-mail\" ><img src=\"../media/system/images/emailButton.png\" alt=\"E-mail\"  /></a></li>"
    +"</ul>"
    +"<span class=\"content_rating\">Note utilisateur:<img src=\"../media/system/images/rating_star_blank.png\" alt=\"\"  /><img src=\"../media/system/images/rating_star_blank.png\" alt=\"\"  /><img src=\"../media/system/images/rating_star_blank.png\" alt=\"\"  /><img src=\"../media/system/images/rating_star_blank.png\" alt=\"\"  /><img src=\"../media/system/images/rating_star_blank.png\" alt=\"\"  />&#160;/&#160;0</span><br />"
    +"<div><span class=\"content_vote\">Mauvais<input type=\"radio\" alt=\"vote 1 star\" name=\"user_rating\" value=\"1\" /><input type=\"radio\" alt=\"vote 2 star\" name=\"user_rating\" value=\"2\" /><input type=\"radio\" alt=\"vote 3 star\" name=\"user_rating\" value=\"3\" /><input type=\"radio\" alt=\"vote 4 star\" name=\"user_rating\" value=\"4\" /><input type=\"radio\" alt=\"vote 5 star\" name=\"user_rating\" value=\"5\" checked=\"checked\" />Très bien&#160;<input class=\"button\" value=\"Note\" /></span></div>"
    +"<dl class=\"article-info\">"
    +"<dt class=\"article-info-term\">Détails</dt>"
    +"<dd class=\"category-name\">Catégorie : <a href=\"#\">Joomla!</a></dd>"
    +"<dd class=\"published\">Publié le Samedi, 10 juillet 2010 21:00</dd>"
    +"<dd class=\"createdby\">Écrit par Joomla!</dd>"
    +"<dd class=\"hits\">Affichages : 7</dd>"
    +"</dl>"
    +"<h3>Ceci est un Titre H3</h3>"
    +"<h4>Ceci est un Titre H4</h4>"
    +"<h5>Ceci est un Titre H5</h5>"
    +"<h6>Ceci est un Titre H6</h6>"
    +"<p>Félicitations, vous venez de créer un site Joomla.</p>"
    +"<p>Joomla rend facile la création d\'un site tel que vous le rêvez et simplifie les mises à jour et la maintenance.</p>"
    +"<p>Joomla est une plateforme flexible et puissante, que vous ayez   besoin de créer un petit site pour vous-même ou un énorme site recevant   des centaines de milliers de visiteurs.</p>"
    +"<p>Joomla est Open Source, ce qui   signifie que vous pouvez l\'utiliser comme vous le souhaitez.</p>"
    +"<p class=\"readmore\"><a href=\"#\">Lire la suite&nbsp;: Joomla!</a></p>"
    +"<ul class=\"pagenav\">"
    +"<li class=\"pagenav-prev\"><a href=\"#\" rel=\"next\">&lt; Précédent</a></li>"
    +"<li class=\"pagenav-next\"><a href=\"#\" rel=\"prev\">Suivant &gt;</a></li>"
    +"</ul>"
    +"</div>";
    return html;
}	

/*--------------------------------------*
 *                                      *
 *      Actions to add the blocks       *
 *                                      *
 * -------------------------------------*/

function createModule() {
    var module = new Element('div', {
        'class': 'singlemodule ckbloc',
        'id': getUniqueid()
    });
    var html = "<div class=\"ckstyle\"></div><div class=\"moduletable\">"
    +"<h3>News module</h3>"
    +getModnewsHTML()
    +"</div>";
    var fields = createFields('vertical',1);
    module.set('html',fields+html);
    $('wrapper').adopt(module); // inject the block in the page
    addckfieldsevent(module); // add avents on fields and controls
    fillFields(module, 'module', '', 'news', 'xhtml');
}


function createFlexiblemodules() {
    var container = new Element('div', {
        'class': 'flexiblemodules ckbloc',
        'id': getUniqueid()
    });
    var blocfields = createFields('vertical',0);
    container.set('html',blocfields+"<div class=\"ckstyle\"></div>");
    $('wrapper').adopt(container); // inject the block in the page
    addckfieldsevent(container); // add events on fields and controls
    fillFields(container, 'modules','');

    var containerinner = new Element('div', {
        'class': 'inner'
    });
    container.adopt(containerinner);

    var fields = createFields('horizontal',1);
    var module1 = new Element('div', {
        'class': 'flexiblemodule ckbloc',
        'id': getUniqueid()
    });
    var module1html = "<div class=\"inner\"><div class=\"ckstyle\"></div><div class=\"moduletable\">"
    +"<h3>News module</h3>"
    +getModnewsHTML()
    +"</div></div>";
    module1.set('html',fields+module1html);
    containerinner.adopt(module1);
    addckfieldsevent(module1); // add avents on fields and controls
    fillFields(module1, 'module1','','position-8','xhtml');

    var module2 = new Element('div', {
        'class': 'flexiblemodule ckbloc',
        'id': getUniqueid()
    });
    var module2html = "<div class=\"inner\"><div class=\"ckstyle\"></div><div class=\"moduletable\">"
    +"<h3>News module</h3>"
    +getModnewsHTML()
    +"</div></div>";
    module2.set('html',fields+module2html);
    containerinner.adopt(module2);
    addckfieldsevent(module2); // add avents on fields and controls
    fillFields(module2, 'module2','','position-9','xhtml');

    var module3 = new Element('div', {
        'class': 'flexiblemodule ckbloc',
        'id': getUniqueid()
    });
    var module3html = "<div class=\"inner\"><div class=\"ckstyle\"></div><div class=\"moduletable\">"
    +"<h3>Menu Joomla!</h3>"
    +getModmostreadHTML()
    +"</div></div>";
    module3.set('html',fields+module3html);
    containerinner.adopt(module3);
    addckfieldsevent(module3); // add avents on fields and controls
    fillFields(module3, 'module3','','position-10','xhtml');

    var module4 = new Element('div', {
        'class': 'flexiblemodule ckbloc',
        'id': getUniqueid()
    });
    var module4html = "<div class=\"inner\"><div class=\"ckstyle\"></div><div class=\"moduletable_menu\">"
    +"<h3>Menu Joomla!</h3>"
    +getModmenuHTML()
    +"</div></div>";
    module4.set('html',fields+module4html);
    containerinner.adopt(module4);
    addckfieldsevent(module4); // add avents on fields and controls
    fillFields(module4, 'module4','','position-11','xhtml');

    var clearline = new Element('div', {
        'class': 'clr'
    });
    containerinner.adopt(clearline);
}

function createMaincontent() {
    if (document.getElement('.maincontent')) {
        alert(Joomla.JText._('CK_ONLY_ONE_COMPONENT'));
        return;
    }
    var container = new Element('div', {
        'class': 'maincontent ckbloc',
        'id': getUniqueid()
    });
    var blocfields = createFields('vertical',0);
    container.set('html',blocfields+"<div class=\"ckstyle\"></div>");
    $('wrapper').adopt(container); // inject the block in the page
    addckfieldsevent(container); // add avents on fields and controls
    fillFields(container, 'main','');

    var columnfields = createFields('horizontal',1,0);
    var column1 = new Element('div', {
        'class': 'column ckbloc',
        'id': getUniqueid()
    });
    var column1html = "<div class=\"inner\"><div class=\"ckstyle\"></div><div class=\"moduletable_menu\">"
    +"<h3>Menu Joomla!</h3>"
    +getModmenuHTML()
    +"</div>"
    +"<div class=\"moduletable\">"
    +"<h3>Login module</h3>"
    +getModloginHTML()
    +"</div></div>";
    column1.set('html',columnfields+column1html);
    container.adopt(column1);
    addckfieldsevent(column1); // add avents on fields and controls
    fillFields(column1, 'left','','position-7','xhtml');

    var centerfields = createFields('horizontal',0,0);
    var center = new Element('div', {
        'class': 'column content ckbloc',
        'id': getUniqueid()
    });
    var centerhtml = "<div class=\"inner\"><div class=\"ckstyle\"></div>"+getContentHTML()+"</div>";
    center.set('html',centerfields+centerhtml);
    container.adopt(center);
    addckfieldsevent(center); // add avents on fields and controls
    fillFields(center, 'center','');

    var column2 = new Element('div', {
        'class': 'column ckbloc',
        'id': getUniqueid()
    });
    var column2html = "<div class=\"inner\"><div class=\"ckstyle\"></div><div class=\"moduletable_menu\">"
    +"<h3>Menu Joomla!</h3>"
    +getModmenuHTML()
    +"</div>"
    +"<div class=\"moduletable\">"
    +"<h3>News module</h3>"
    +getModnewsHTML()
    +"</div></div>";
    column2.set('html',columnfields+column2html);
    container.adopt(column2);
    addckfieldsevent(column2); // add avents on fields and controls
    fillFields(column2, 'right','','position-6','xhtml');

    var clearline = new Element('div', {
        'class': 'clr'
    });
    container.adopt(clearline);
}

/* complex layout */
function createMaincontent2() {
    if (document.getElement('.maincontent')) {
        alert(Joomla.JText._('CK_ONLY_ONE_COMPONENT'));
        return;
    }
    /* ligne de séparation */
    var clearline = new Element('div', {
        'class': 'clr'
    });

    /* conteneur principal */
    var container = new Element('div', {
        'class': 'maincontent ckbloc',
        'id': getUniqueid()
    });
    var blocfields = createFields('vertical',0);
    container.set('html',blocfields+"<div class=\"ckstyle\"></div>");
    $('wrapper').adopt(container); // inject the block in the page
    addckfieldsevent(container); // add avents on fields and controls
    fillFields(container, 'main','');

    /* colonne de gauche */
    var column1fields = createFields('horizontal',1,0);
    var column1 = new Element('div', {
        'class': 'column column1 ckbloc',
        'id': getUniqueid()
    });
    var column1html = "<div class=\"inner\"><div class=\"ckstyle\"></div><div class=\"moduletable_menu\">"
    +"<h3>Menu Joomla!</h3>"
    +getModmenuHTML()
    +"</div>"
    +"<div class=\"moduletable\">"
    +"<h3>Login module</h3>"
    +getModloginHTML()
    +"</div></div>";
    column1.set('html',column1fields+column1html);
    container.adopt(column1);
    addckfieldsevent(column1); // add avents on fields and controls
    fillFields(column1, 'left','','position-7','xhtml');

    /* maincenter container */
    var maincenterfields = createFields('horizontal',0,0);
    var maincenter = new Element('div', {
        'class': 'column maincenter ckbloc',
        'id': getUniqueid()
    });
    maincenter.set('html',maincenterfields+"<div class=\"ckstyle\"></div>");
    container.adopt(maincenter);
    addckfieldsevent(maincenter); // add avents on fields and controls
    fillFields(maincenter, 'maincenter','');

    var maincenterinner = new Element('div', {
        'class': 'inner'
    });
    maincenter.adopt(maincenterinner);

    /* maintop module */
    var maintopfields = createFields('vertical',1);
    var maintop = new Element('div', {
        'class': 'maintop ckbloc',
        'id': getUniqueid()
    });
    var maintophtml = "<div class=\"ckstyle\"></div><div class=\"moduletable\">"
    +"<h3>News module</h3>"
    +getModnewsHTML()
    +"</div>";
    maintop.set('html',maintopfields+maintophtml);
    maincenterinner.adopt(maintop);
    addckfieldsevent(maintop); // add avents on fields and controls
    fillFields(maintop, 'maintop','','position-16','xhtml');

    //maincenter.adopt(clearline.clone());

    // conteneur du centre et colonne droite, bloc fantome
    var centercont = new Element('div', {
        'class': 'centercont ckbloc',
        'id': getUniqueid()
    });
    maincenterinner.adopt(centercont);
	
    /* conteneur central */
    var centerfields = createFields('horizontal',0,0);
    var center = new Element('div', {
        'class': 'column center ckbloc',
        'id': getUniqueid()
    });
    //var centerhtml = getContentHTML();
    center.set('html',centerfields+"<div class=\"ckstyle\"></div>");
    centercont.adopt(center);
    addckfieldsevent(center); // add avents on fields and controls
    fillFields(center, 'center','');

    var centerinner = new Element('div', {
        'class': 'inner'
    });
    center.adopt(centerinner);

    /* centertop module */
    var centertopfields = createFields('vertical',1);
    var centertop = new Element('div', {
        'class': 'centertop ckbloc',
        'id': getUniqueid()
    });
    var centertophtml = "<div class=\"ckstyle\"></div><div class=\"moduletable\">"
    +"<h3>News module</h3>"
    +getModnewsHTML()
    +"</div>";
    centertop.set('html',centertopfields+centertophtml);
    centerinner.adopt(centertop);
    addckfieldsevent(centertop); // add avents on fields and controls
    fillFields(centertop, 'centertop','','position-17','xhtml');

    /* contenu */
    var contentfields = createFields('vertical',0,0);
    var content = new Element('div', {
        'class': 'content ckbloc',
        'id': getUniqueid()
    });
    var contenthtml = getContentHTML();
    content.set('html',contentfields+contenthtml+"<div class=\"ckstyle\"></div>");
    centerinner.adopt(content);
    addckfieldsevent(content); // add avents on fields and controls
    fillFields(content, 'content','');

    /* centerbottom module */
    var centerbottomfields = createFields('vertical',1);
    var centerbottom = new Element('div', {
        'class': 'centerbottom ckbloc',
        'id': getUniqueid()
    });
    var centerbottomhtml = "<div class=\"ckstyle\"></div><div class=\"moduletable\">"
    +"<h3>News module</h3>"
    +getModnewsHTML()
    +"</div>";
    centerbottom.set('html',centerbottomfields+centerbottomhtml);
    centerinner.adopt(centerbottom);
    addckfieldsevent(centerbottom); // add avents on fields and controls
    fillFields(centerbottom, 'centerbottom','','position-18','xhtml');

    /* colonne de droite */
    var column2fields = createFields('horizontal',1,0);
    var column2 = new Element('div', {
        'class': 'column column2 ckbloc',
        'id': getUniqueid()
    });
    var column2html = "<div class=\"inner\"><div class=\"ckstyle\"></div><div class=\"moduletable_menu\">"
    +"<h3>Menu Joomla!</h3>"
    +getModmenuHTML()
    +"</div>"
    +"<div class=\"moduletable\">"
    +"<h3>News module</h3>"
    +getModnewsHTML()
    +"</div></div>";
    column2.set('html',column2fields+column2html);
    centercont.adopt(column2);
    addckfieldsevent(column2); // add avents on fields and controls
    fillFields(column2, 'right','','position-6','xhtml');

    centercont.adopt(clearline.clone());

    /* mainbottom module */
    var mainbottomfields = createFields('vertical',1);
    var mainbottom = new Element('div', {
        'class': 'mainbottom ckbloc',
        'id': getUniqueid()
    });
    var mainbottomhtml = "<div class=\"ckstyle\"></div><div class=\"moduletable\">"
    +"<h3>News module</h3>"
    +getModnewsHTML()
    +"</div>";
    mainbottom.set('html',mainbottomfields+mainbottomhtml);
    maincenterinner.adopt(mainbottom);
    addckfieldsevent(mainbottom); // add avents on fields and controls
    fillFields(mainbottom, 'mainbottom','','position-19','xhtml');

    container.adopt(clearline);
}
/* fin complex layout*/

function createBannerlogo() {
    var clearline = new Element('div', {
        'class': 'clr'
    });
    
    var container = new Element('div', {
        'class': 'mainbanner ckbloc',
        'id': getUniqueid()
    });
    var blocfields = createFields('vertical',0);
    container.set('html',blocfields+"<div class=\"ckstyle\"></div>");
    $('wrapper').adopt(container); // inject the block in the page
    addckfieldsevent(container); // add avents on fields and controls
    fillFields(container, 'mainbanner','');

    var logofields = createFields('horizontal',0);
    var logo = new Element('div', {
        'class': 'bannerlogo ckbloc',
        'blocwidth': '286',
        'id': getUniqueid()
    });
    var logohtml = "<div>"
    +"<img src=\"../components/com_templateck/logo.png\" width=\"286\" height=\"64\" />"
    +"</div>";
    logo.set('html',logofields+logohtml+"<div class=\"ckstyle\"></div>");
    container.adopt(logo);
    addckfieldsevent(logo); // add avents on fields and controls
    fillFields(logo, 'logo','');

    logo.adopt(clearline.clone());

    var logodescfields = createFields('vertical',0);
    var logodesc = new Element('div', {
        'class': 'bannerlogodesc ckbloc',
        'id': getUniqueid()
    });
    var logodeschtml = "<div>"
    +"This is a logo description"
    +"</div>";
    logodesc.set('html',logodescfields+logodeschtml+"<div class=\"ckstyle\"></div>");
    logo.adopt(logodesc);
    addckfieldsevent(logodesc); // add avents on fields and controls
    fillFields(logodesc, 'logodesc','');

    var bannerfields = createFields('horizontal',1);
    var banner = new Element('div', {
        'class': 'banner ckbloc',
        'blocwidth': '400',
        'id': getUniqueid()
    });
    var bannerhtml = "<div class=\"ckstyle\"></div><div class=\"moduletable\">"
    +"<h3>News module</h3>"
    +getModnewsHTML()
    +"</div>";
    banner.set('html',bannerfields+bannerhtml);
    container.adopt(banner);
    addckfieldsevent(banner); // add avents on fields and controls
    fillFields(banner, 'banner','', 'position-0','none');

    
    container.adopt(clearline);
}

function createCustomblock() {

    var container = new Element('div', {
        'class': 'custombloc ckbloc',
        'id': getUniqueid()
    });
    var blocfields = createFields('vertical',0);
    container.set('html',blocfields+"<div class=\"ckstyle\"></div>");
    $('wrapper').adopt(container); // inject the block in the page
    addckfieldsevent(container); // add avents on fields and controls
    fillFields(container, 'custom','');

    var customfield = new Element('div', {
        'styles': {
            'height' : '75px',
            'background-color' : '#efefef',
            'border' : '1px solid #666',
            'margin-left' : '290px'
        },
        'class': 'customcont',
        'text' : 'Click and edit me !'
    }).setProperties({
        contenteditable: 'true'
    });

    container.adopt(customfield);

}

function createHorizontalmenu() {
    var module = new Element('div', {
        'class': 'horiznav ckbloc',
        'id': getUniqueid()
    });
    var html = getHorizmenuHTML()
    +"<style type=\"text/css\" >.horiznav ul.menu li {float:left;} .horiznav ul.menu li ul, .horiznav ul.menu li:hover ul ul, .horiznav ul.menu li:hover ul ul ul {position: absolute;left: -999em;z-index: 999;} .horiznav ul.menu li:hover ul {left: auto;} .horiznav ul.menu li:hover ul, .horiznav ul.menu li:hover ul li:hover ul, .horiznav ul.menu li:hover ul li:hover ul li:hover ul {left: auto;} .horiznav ul.menu li ul ul {margin-left: 100px;margin-top: -30px;background:#eee;} .horiznav ul.menu li li {float: none;display: block;}</style>";
    var fields = createFields('vertical',1);
    module.set('html',fields+html+"<div class=\"ckstyle\"></div>");
    $('wrapper').adopt(module); // inject the block in the page
    addckfieldsevent(module); // add avents on fields and controls
    fillFields(module, 'nav', '', 'position-1', 'none');

    var clearline = new Element('div', {
        'class': 'clr'
    });
    module.adopt(clearline);


}


/**
 *
 * Function to create the fields
 */
function createFields(orientation, addmodule, candelete) {

	if (candelete != 0) candelete = 1;
	
    if (orientation == 'horizontal') {
        var optionclass = ' horiz';
    } else {
        var optionclass = '';
    }
	
    if (addmodule == 1) {
        var modulefields = "<label class=\"labelblock\">Position</label><input type=\"text\" name=\"ckmoduleposition\" size=\"8\" class=\"ckfield\" />"
    /*+"<label class=\"labelblock\">Style</label>"
        +"<select name=\"ckmodulestyle\" style=\"width:55px;\" class=\"ckfield\">"
        +"<option value=\"none\">none</option>"
        +"<option value=\"xhtml\">xhtml</option>"
        +"<option value=\"rounded\">rounded</option>"
        +"</select>"*/;
    } else {
        var modulefields = "";
    }
	
	var deletefieldstyle = "";
	if (!candelete) deletefieldstyle = " style=\"display:none;\"";
	
    var fields = "<div class=\"ckfields\">"
    +"<div class=\"controlDel isControl\""+deletefieldstyle+"></div>"
    +"<div class=\"controlUp isControl"+optionclass+"\"></div>"
    +"<div class=\"controlDown isControl"+optionclass+"\"></div>"
    +"<div class=\"controlCss isControl\">CSS</div>"
    +"<label class=\"labelblock\">ID</label><input type=\"text\" name=\"ckid\" size=\"8\" class=\"ckfield\" />"
    //+"<label class=\"labelblock\">Class</label><input type=\"text\" name=\"ckclass\" size=\"8\" class=\"ckfield\" />"
    +modulefields
    +"<div style=\"clear:both;\"></div>"
    +"</div>";
    return fields;
}

/*
 * function to add events on fields
 */
function addckfieldsevent(obj) {
    // add event on fields for displaying controls,ID, class, ...
    obj.addEvent('mouseover', function(){
        obj.getElement('.ckfields').setStyle('opacity',1).setStyle('visibility','visible');
    });
    obj.addEvent('mouseleave', function(){
        obj.getElement('.ckfields').setStyle('opacity',0);
    });
    // create event to move up
    obj.getElement('.controlUp').addEvents({
        'click': function(){
            el = this.getParent().getParent();
            var myPrevious = el.getPrevious();
            if (myPrevious && myPrevious.hasClass('ckbloc')) el.inject(myPrevious, 'before');
        }
    });
    // create event to move down
    obj.getElement('.controlDown').addEvents({
        'click': function(){
            el = this.getParent().getParent();
            var myNext = el.getNext();
            if (myNext && myNext.hasClass('ckbloc')) el.inject(myNext, 'after');
        }
    });
    // create event to delete
    obj.getElement('.controlDel').addEvents({
        'click': function(){
            if (confirm('Do you want to delete ?')) {
                el = this.getParent().getParent();
                el.destroy();
            }
        }
    });
    // create event to play with styles
    obj.getElement('.controlCss').addEvents({
        'click': function(){
            showCsspopup(obj);
        }
    });
    // applying automatically attribs
    obj.getElements('.ckfield').each(function(field) {
        field.addEvent('change',function(){
            if (el = field.getParent().getParent()) {
                el.setProperty(field.name,field.value);
            }
        });
    });
}


/*
 * Method to show the css popup
 */
function showCsspopup(obj) {
    $$('.cssfocus').removeClass('cssfocus');
    obj.addClass('cssfocus');
    if ($('ck_csscode').getStyle('display') != 'block') {
        document.getElements('.ckpopup').setStyles({
            'opacity':'0',
            'display':'none'
        });
        document.id('ck_csscode').setStyle('display','block').tween('opacity', '1').empty();
        loadCssFields(obj);
        fillCssFields(obj);
    }
}

function closeCsspopup(button) {
    //button.getParent().setStyle('display','none');
    var focus = $('template_container').getElement('.cssfocus');
    getPreviewstylescss(focus);
    if (focus.hasClass('bannerlogo')) getPreviewlogo(focus);
}

function copytoclipboard(button) {
    CLIPBOARDCK = document.getElements('.inputbox').getProperties('id','value');
    alert(Joomla.JText._('CK_COPYTOCLIPBOARD','Current styles copied to clipboard !'));
}

function pastefromclipboard(button) {
    if (CLIPBOARDCK) {
        if (!confirm(Joomla.JText._('CK_COPYFROMCLIPBOARD','Apply styles from Clipboard ? This will replace all current existing styles.'))) return;
        CLIPBOARDCK.each(function(field) {
            if ($(field.id) && field.value) {
                $(field.id).value = field.value;
                $(field.id).fireEvent('change');
            }
        });
    } else {
        alert(Joomla.JText._('CK_CLIPBOARDEMPTY','Clipboard is empty'));
    }
}


function getPreviewlogo(focus) {
    var logoimg = focus.getElement('img');
    if (focus.getProperty('blocheight')) logoimg.height = focus.getProperty('blocheight');
    if (focus.getProperty('blocwidth')) logoimg.width = focus.getProperty('blocwidth');
    if (focus.getProperty('blocbackgroundimageurl')) {
        focus.setStyle('background-image', 'none');
        logoimg.src = '../'+focus.getProperty('blocbackgroundimageurl');
    }
}

function getPreviewstylescss(focus) {
    var myurl = "index.php?option=com_templateck&view=templateck&layout=ajaxrendercss&tmpl=component";

    var fieldslist = $$('.inputbox').getProperty('name').join(',');
    focus.setProperty('fieldslist',fieldslist);
    
    //var fields = JSON.encode(document.getElements('.inputbox').getProperties('id','value'));
    fieldslist = new Array();
    fields = new Object();
    if (focus.getProperty('fieldslist')) fieldslist = focus.getProperty('fieldslist').split(",");
    fieldslist.each(function(fieldname) {
        fields[fieldname] = focus.getProperty(fieldname);
    });
    fields = JSON.encode(fields);
    //fields = fields.replace(/#/g,"|di|");

    

    var packageRequest = new Request.HTML({
        url:myurl,
        method: 'post',
        update: focus.getElement('.ckstyle'),
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

    }).post("objid="+focus.id+"&objclass="+focus.className+"&fields="+fields+"&action=preview");
    packageRequest.send();
}

/*
 * function to fill the fields with values
 */
function fillFields(obj, ckid, ckclass, ckmoduleposition, ckmodulestyle) {
    obj.getElements('.ckfield').each(function(field) {
        if (obj == field.getParent().getParent()) {
            if (field.name == 'ckid') {
                field.value = ckid;
                field.fireEvent('change');
            }
            if (field.name == 'ckclass') {
                field.value = ckclass;
                field.fireEvent('change');
            }
            if (field.name == 'ckmoduleposition') {
                field.value = ckmoduleposition;
                field.fireEvent('change');
            }
            if (field.name == 'ckmodulestyle') {
                field.value = ckmodulestyle;
                field.fireEvent('change');
            }
        }
    });
}

/*
 * function to fill the css fields with the values stored in the block
 */
function fillCssFields(obj){
    var cssvalue = '';   
    $$('.inputbox').each(function(field) {
        cssvalue = obj.getProperty(field.name);
        if (cssvalue) {
            field.value = cssvalue;
            field.checked = true;
            if (field.hasClass('colorPicker') && field.value) field.setStyle('background-color',field.value);
            if (field.getProperty('type') == 'checkbox') {
                if (field.value == 1) {
                    field.checked = true;
                } else {
                    field.checked = false;
                }
            }
            if (field.getProperty('type') == 'radio') {
                if (obj.getProperty(field.name)) {
                    $(obj.getProperty(field.name)).checked = true;
                }
            }
        } else {
            field.value = '';
            field.checked = false;
        }
    });
}

/*
 * function to display the css fields
 */
function loadCssFields(obj) {
    var myurl = "index.php?option=com_templateck&view=templateck&layout=ajaxstylescss&tmpl=component";
    var packageRequest = new Request.HTML({
        url:myurl,
        method: 'post',
        update: document.id('ck_csscode'),
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

    }).post("objclass="+obj.className+"&objid="+obj.id);
    packageRequest.send();
}


/*
 * Function to load the HTML modele in the page
 */
function loadModele(name) {
    var myurl = "index.php?option=com_templateck&view=templateck&layout="+name+"&tmpl=component";
    var packageRequest = new Request.HTML({
        url:myurl,
        method: 'post',
        update: $('conteneur'),
        onRequest: function(){
            $('conteneur').set('text', Joomla.JText._('CK_LOADING', 'Loading...'));
        },
        onFailure: function(){
            $('conteneur').set('text', Joomla.JText._('CK_LOAD_FAILURE', 'Error during data load !'));
        }
    });
    packageRequest.send();
}


/*
 * Method to give a random unique ID
 */
function getUniqueid(){
    var now = new Date().getTime();
    var id = 'ID'+parseInt(now, 10);
    if ($(id)) getUniqueid();
    return id;
}



/************************************
 * Functions to manage package creation *
 * **************************************/

function getBlocks() {
    var blocs = new Array();
    var cssblocs = new Object();
    var i= 0;
    document.getElements('.ckbloc').each(function(bloc){
        bloc.getElements('.ckfield').fireEvent('change');
        var cssblocs = new Object();
        var fieldslist = new Array();
        cssblocs['class'] = bloc.className;
        cssblocs['ckid'] = bloc.getProperty('ckid');
        if (bloc.id == "body" || bloc.id == "wrapper") cssblocs['ckid'] = bloc.id;
        cssblocs['ckclass'] = bloc.getProperty('ckclass');
        cssblocs['ckmoduleposition'] = bloc.getProperty('ckmoduleposition');
        cssblocs['ckmodulestyle'] = bloc.getProperty('ckmodulestyle');
        if (bloc.getProperty('fieldslist')) fieldslist = bloc.getProperty('fieldslist').split(",");
        fieldslist.each(function(fieldname) {
            cssblocs[fieldname] = bloc.getProperty(fieldname);
        });
        blocs[i] = cssblocs;
        i++;
    });

    return blocs;
}
/**
 *
 * Function create htmlcode and folder structure and begin the process
 */
function makeHtmlStep(makeArchive) {

    // store the properties for each block
    
    blocs = getBlocks();
    blocs = JSON.encode(blocs);
    blocs = blocs.replace(/#/g,"|di|");

    // first method to create html structure
    var htmlcode = makeHtmlOutput();

    var myurl = "index.php?option=com_templateck&view=templateck&layout=ajaxindex&tmpl=component";
    var packageRequest = new Request.HTML({
        url:myurl,
        method: 'post',
        update: document.id('packagestep1_result'),
        onRequest: function(){
            document.id('packagestep1').set('text', Joomla.JText._('CK_LOADING', 'Loading...'));
        },
        onSuccess: function(){
            document.id('packagestep1').set('text', Joomla.JText._('CK_LOAD_SUCCESS_STEP1', 'Step 1 finished with success'));
            makeCssStep(makeArchive);
        },
        onFailure: function(){
            document.id('packagestep1').set('text', Joomla.JText._('CK_LOAD_FAILURE_STEP1', 'Step 1 encounter some errors'));
        }

    }).post("bodycode="+htmlcode["body"]
        +"&headcode="+htmlcode["head"]
        +"&joomlaversion="+$('joomlaversion').value
        +"&templatename="+$('name').value
        +"&creationdate="+$('creationDate').value
        +"&author="+$('author').value
        +"&authorEmail="+$('authorEmail').value
        +"&authorUrl="+$('authorUrl').value
        +"&copyright="+$('copyright').value
        +"&license="+$('license').value
        +"&version="+$('version').value
        +"&description="+$('description').value
        +"&blocs="+blocs
        +"&makearchive="+makeArchive);
    packageRequest.send();
}

/**
 *
 * Function to generate template.css file
 */
function makeCssStep(makeArchive) {
    
    // store the properties for each block
    blocs = getBlocks();

    blocs = JSON.encode(blocs);
    blocs = blocs.replace(/#/g,"|di|");

    var myurl = "index.php?option=com_templateck&view=templateck&layout=ajaxtemplatecss&tmpl=component";
    var packageRequest = new Request.HTML({
        url:myurl,
        method: 'post',
        update: document.id('packagestepcss_result'),
        onRequest: function(){
            document.id('packagestepcss').set('text', Joomla.JText._('CK_LOADING', 'Loading...'));
        },
        onSuccess: function(){
            document.id('packagestepcss').set('text', Joomla.JText._('CK_LOAD_SUCCESS_STEP_CSS', 'Next step finished with success'));
            makeXmlStep(makeArchive);
        },
        onFailure: function(){
            document.id('packagestepcss').set('text', Joomla.JText._('CK_LOAD_FAILURE_STEP_CSS', 'Next step encounter some errors'));
        }
    }).post("templatename="+$('name').value
        +"&templateid="+TEMPLATEID
        +"&wrapperwidth="+WRAPPERWIDTH
        +"&column1width="+COLUMN1WIDTH
        +"&column2width="+COLUMN2WIDTH
        +"&blocs="+blocs);
    packageRequest.send();
}


/**
 *
 * Function to generate XML file
 */
function makeXmlStep(makeArchive) {
    // other method to create xml file
    var positions = document.getElements('.ckbloc').getProperty('ckmoduleposition');

    var myurl = "index.php?option=com_templateck&view=templateck&layout=ajaxxml&tmpl=component";
//    +"&templatename="+$('name').value
//    +"&joomlaversion="+$('joomlaversion').value
//    +"&creationdate="+$('creationDate').value
//    +"&author="+$('author').value
//    +"&authorEmail="+$('authorEmail').value
//    +"&authorUrl="+$('authorUrl').value
//    +"&copyright="+$('copyright').value
//    +"&license="+$('license').value
//    +"&version="+$('version').value
//    +"&description="+$('description').value
//    +"&positions="+positions;

    var packageRequest = new Request.HTML({
        url:myurl,
        method: 'get',
        update: document.id('packagestepxml_result'),
        onRequest: function(){
            document.id('packagestepxml').set('text', Joomla.JText._('CK_LOADING', 'Loading...'));
        },
        onSuccess: function(){
            document.id('packagestepxml').set('text', Joomla.JText._('CK_LOAD_SUCCESS_STEP_XML', 'Next step finished with success'));
            if (makeArchive) {
                makeArchiveStep();
            } else {
                makePreviewStep();
            }
        },
        onFailure: function(){
            document.id('packagestepxml').set('text', Joomla.JText._('CK_LOAD_FAILURE_STEP_XML', 'Next step encounter some errors'));
        }
    }).post("templatename="+$('name').value
        +"&joomlaversion="+$('joomlaversion').value
        +"&creationdate="+$('creationDate').value
        +"&author="+$('author').value
        +"&authorEmail="+$('authorEmail').value
        +"&authorUrl="+$('authorUrl').value
        +"&copyright="+$('copyright').value
        +"&license="+$('license').value
        +"&version="+$('version').value
        +"&description="+$('description').value
        +"&positions="+positions);
    packageRequest.send();
}


/**
 *
 * Function to generate the preview button
 */

function makePreviewStep() {
    // last method to create zip archive
    var myurl = URIROOT+"/index.php?option=com_templateck&view=templateck&layout=default&tmpl=component&template=system"
    +"&templatename="+$('name').value;

    var previewparagraphe = new Element('p', {
        'styles': {
            'padding': '15px'
        }
    });

    var previewlink = new Element('a', {
        'styles': {
        },
        'class': 'ckpreview',
        'href' : myurl,
        'target' : '_blank'
    }).addEvents({
        'click': function(){

        }
    });
    previewparagraphe.adopt(previewlink);
    previewlink.set('text',Joomla.JText._('CK_PREVIEW_TEMPLATE'));
    document.id('packagesteparchive_result').adopt(previewparagraphe);
}



/**
 *
 * Function to generate the ZIP archive
 */

function makeArchiveStep(form) {
    // last method to create zip archive
    var myurl = "index.php?option=com_templateck&view=templateck&layout=ajaxarchive&tmpl=component";
//    +"&templatename="+$('name').value;

    var packageRequest = new Request.HTML({
        url:myurl,
        method: 'get',
        update: document.id('packagesteparchive_result'),
        onRequest: function(){
            document.id('packagesteparchive').set('text', Joomla.JText._('CK_LOADING', 'Loading...'));
        },
        onSuccess: function(){
            document.id('packagesteparchive').set('text', Joomla.JText._('CK_LOAD_SUCCESS_STEP_ARCHIVE', 'Archive finished with success'));
        },
        onFailure: function(){
            document.id('packagesteparchive').set('text', Joomla.JText._('CK_LOAD_FAILURE_STEP_ARCHIVE', 'Archive encounter some errors'));
        }

    }).post("templatename="+$('name').value
    +"&saveintemplate="+$('saveintemplate').checked);
    packageRequest.send();
}

/**
 *
 * Function to generate final html code
 */
function makeHtmlOutput() {

    var code = new Array("head", "body");
    code["head"] = '';
    code["body"] = '';
    var j = 0;
    var customcode = '';
//    var wrapperwidth = $('htmlconteneur').getElement('#wrapper').getProperty('blocwidth') ? $('htmlconteneur').getElement('#wrapper').getProperty('blocwidth') : "1000";
//    window['WRAPPERWIDTH'] = wrapperwidth;
    
    document.getElements('.ckbloc').each(function(bloc){
        var retrievecode = '';
        // retrieve id for the block
        var blocid = '';
        if (bloc.getProperty("ckid")) {
            blocid = ' id="'+bloc.getProperty("ckid")+'"';
        }

        // retrieve id for the block
        var blocmoduleposition = '';
        if (bloc.getProperty("ckmoduleposition")) {
            blocmoduleposition = bloc.getProperty("ckmoduleposition");
        }

        // retrieve class for the bloc
        var blocclass = '';
        if (bloc.getProperty("ckclass")) {
            blocclass = ' class="'+bloc.getProperty("ckclass")+'"';
        }

        // retrieve style for the module
        var blocmodulestyle = ' style="xhtml"';
        if (bloc.getProperty("ckmodulestyle")) {
            blocmodulestyle = ' style="'+bloc.getProperty("ckmodulestyle")+'"';
        }

        // Begin the modules code construction
        // construct single module code
        if (bloc.hasClass('singlemodule')) {
            retrievecode = makeHtmlSingleModule(bloc, blocmoduleposition, blocid, blocclass, blocmodulestyle);
            code["body"] += retrievecode["body"];
        }

        // construct flexible module code
        if (bloc.hasClass('flexiblemodules')) {
            retrievecode = makeHtmlFlexibleModule(bloc, blocid, blocclass, j);
            code["body"] += retrievecode["body"];
            code["head"] += retrievecode["head"];
        }

        // construct banner and logo block code
        if (bloc.hasClass('mainbanner')) {
            retrievecode = makeHtmlBanner(bloc, blocid, blocclass);
            code["body"] += retrievecode["body"];
        }

        // construct horizontal menu code
        if (bloc.hasClass('horiznav')) {
            retrievecode = makeHtmlHorizNav(bloc, blocmoduleposition, blocid, blocclass, blocmodulestyle);
            code["body"] += retrievecode["body"];
        }

        // construct custom block code
        if (bloc.hasClass('custombloc')) {
            customcode = bloc.getElement('div.customcont').get('text').replace(/#/g,"|di|");
            code["body"] += '|tab|<div'+blocid+blocclass+'>'+customcode+'</div>|rr|';
        }

        
        // construct simple 3 cols component layout code
        if (bloc.hasClass('maincontent') && !bloc.getElement('.maincenter')) {
            retrievecode = makeHtmlSimpleComponent(bloc, blocid, blocclass, j);
            code["body"] += retrievecode["body"];
            code["head"] += retrievecode["head"];
        }

        // construct complex component layout code
        if (bloc.hasClass('maincontent') && bloc.getElement('.maincenter')) {
            retrievecode = makeHtmlComplexComponent(bloc, blocid, blocclass, blocmodulestyle, j);
            code["body"] += retrievecode["body"];
            code["head"] += retrievecode["head"];
        }

        j++;
    });

    return code;
}


/***********************************************
 * modules html creation *
 * *********************************************/

/**
 * Function to render a single module
 *
 */
function makeHtmlSingleModule(bloc, blocmoduleposition, blocid, blocclass, blocmodulestyle) {
    // initialisation
    var code = new Array("head", "body");
    code["head"] = '';
    code["body"] = '';

    code["body"] = '|tab|<?php if ($this->countModules(\''+blocmoduleposition+'\')) : ?>|rr|'
    +'|tab|<div'+blocid+blocclass+'>|rr|'
    +'|tab||tab|<jdoc:include type="modules" name="'+blocmoduleposition+'"'+blocmodulestyle+' />|rr|'
    +'|tab|</div>|rr|'
    +'|tab|<div class="clr"></div>|rr|'
    +'|tab|<?php endif; ?>|rr||rr|';
    return code;
}


/**
 * Function to render some flexible modules
 *
 */
function makeHtmlFlexibleModule(bloc, blocid, blocclass, j) {
    // initialisation
    var code = new Array("head", "body");
    code["head"] = '';
    code["body"] = '';

    code["body"] += '|tab|<?php if ($nbmodules'+j+' > 0) : ?>|rr|'
    +'|tab|<div'+blocid+blocclass+'>|rr|'
    +'|tab||tab|<div class="inner">|rr|';

    code["head"] += '<?php|rr|'
    +'$nbmodules'+j+' = 0;|rr|';

    //var modulepos = new Array();
    bloc.getElements('.flexiblemodule').each(function(module){

        // retrieve data for the block
        module.ckid = module.getProperty("ckid") ? ' id="'+module.getProperty("ckid")+'"' : '';
        module.classe = module.getProperty("ckclass") ? module.getProperty("ckclass") : '';
        module.jdocstyle = module.getProperty("ckmodulestyle") ? ' style="'+module.getProperty("ckmodulestyle")+'"' : ' style="xhtml"';
        module.jdocposition = module.getProperty("ckmoduleposition") ? module.getProperty("ckmoduleposition") : '';

        code["body"] += '|tab||tab||tab|<?php if ($this->countModules(\''+module.jdocposition+'\')) : ?>|rr|'
        +'|tab||tab||tab|<div'+module.ckid+' class="flexiblemodule <?php echo $modulesclasse'+j+'; ?> '+module.classe+'">|rr|'
        +'|tab||tab||tab||tab|<div class="inner">|rr|'
        +'|tab||tab||tab||tab||tab|<jdoc:include type="modules" name="'+module.jdocposition+'"'+module.jdocstyle+' />|rr|'
        +'|tab||tab||tab||tab|</div>|rr|'
        +'|tab||tab||tab|</div>|rr|'
        +'|tab||tab||tab|<?php endif; ?>|rr|';

        code["head"] += 'if ($this->countModules(\''+module.jdocposition+'\'))  $nbmodules'+j+'|plus||plus|;|rr|';
    });
    code["body"] += '|tab||tab||tab|<div class="clr"></div>|rr|'
    +'|tab||tab|</div>|rr|'
    +'|tab|</div>|rr|'
    +'|tab|<?php endif; ?>|rr||rr|';

    code["head"] += 'if ($nbmodules'+j+' == 1) $modulesclasse'+j+' = \'full\';|rr|'
    +'if ($nbmodules'+j+' == 2) $modulesclasse'+j+' = \'demi\';|rr|'
    +'if ($nbmodules'+j+' == 3) $modulesclasse'+j+' = \'tiers\';|rr|'
    +'if ($nbmodules'+j+' == 4) $modulesclasse'+j+' = \'quart\';|rr|'
    +'?>|rr||rr|';

    return code;
}

/**
 * Function to render a banner with logo
 *
 */
function makeHtmlBanner(bloc, blocid, blocclass) {
    // initialisation
    var code = new Array("head", "body");
    code["head"] = '';
    code["body"] = '';

    code["body"] += '|tab|<div'+blocid+blocclass+'>|rr|';

    bloc.getElements('.ckbloc').each(function(module){

        // retrieve data for the block
        module.ckid = module.getProperty("ckid") ? ' id="'+module.getProperty("ckid")+'"' : '';
        module.classe = module.getProperty("ckclass") ? ' class="logobloc '+module.getProperty("ckclass")+'"' : ' class="logobloc"';
        module.jdocstyle = module.getProperty("ckmodulestyle") ? ' style="'+module.getProperty("ckmodulestyle")+'"' : ' style="xhtml"';
        module.jdocposition = module.getProperty("ckmoduleposition") ? module.getProperty("ckmoduleposition") : '';

        if (module.hasClass('bannerlogo')) { 
            module.logoimage = module.getElement("img") ? module.getElement("img").src.split("/").reverse()[0] : '';
            module.logowidth = module.getProperty("blocwidth") ? ' width="'+module.getProperty("blocwidth")+'px"' : '';
            module.logoheight = module.getProperty("blocheight") ? ' height="'+module.getProperty("blocheight")+'px"' : '';
            module.logodivwidth = module.getProperty("blocwidth") ? 'width:'+module.getProperty("blocwidth")+'px;' : 'width:400px';
            module.logodivheight = module.getProperty("blocheight") ? 'height:'+module.getProperty("blocheight")+'px;' : '';

            logodesc = module.getElement('.ckbloc');
            logodesccode = '';
            if (logodesc) {
                logodesc.ckid = logodesc.getProperty("ckid") ? ' id="'+logodesc.getProperty("ckid")+'"' : '';
                logodesccode = '|tab||tab||tab|<?php if ($this->params->get(\'logodescription\')) { ?>|rr|'
                    +'|tab||tab||tab|<div'+logodesc.ckid+'><?php echo htmlspecialchars($this->params->get(\'logodescription\'));?></div>|rr|'
                    +'|tab||tab||tab|<?php } ?>|rr|';
            }

            code["body"] += '|tab||tab|<div'+module.ckid+module.classe+' style="'+module.logodivwidth+module.logodivheight+'">|rr|'
            +'|tab||tab||tab|<?php if ($this->params->get(\'logolink\')) { ?>|rr|'
            +'|tab||tab||tab|<a href="<?php echo htmlspecialchars($this->params->get(\'logolink\')); ?>">|rr|'
            +'|tab||tab||tab|<?php } ?>|rr|'
            +'|tab||tab||tab||tab|<img src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/images/'+module.logoimage+'"'+module.logowidth+module.logoheight+' alt="<?php echo htmlspecialchars($this->params->get(\'logotitle\'));?>" />|rr|'
            +'|tab||tab||tab|<?php if ($this->params->get(\'logolink\')) { ?>|rr|'
            +'|tab||tab||tab|</a>|rr|'
            +'|tab||tab||tab|<?php } ?>|rr|'
            +logodesccode
            +'|tab||tab|</div>|rr|';


        } else if (!module.hasClass('bannerlogodesc')) {
            module.logodivwidth = module.getProperty("blocwidth") ? 'width:'+module.getProperty("blocwidth")+'px;' : 'width:400px;';
            code["body"] += '|tab||tab|<?php if ($this->countModules(\''+module.jdocposition+'\')) : ?>|rr|'
            +'|tab||tab|<div'+module.ckid+module.classe+' style="'+module.logodivwidth+'">|rr|'
            +'|tab||tab||tab||tab|<jdoc:include type="modules" name="'+module.jdocposition+'"'+module.jdocstyle+' />|rr|'
            +'|tab||tab|</div>|rr|'
            +'|tab||tab|<?php endif; ?>|rr|';
        }

    });

    code["body"] += '|tab||tab|<div class="clr"></div>|rr|'
    +'|tab|</div>|rr|';

    return code;
}


/**
 * Function to render a horizontal menu
 *
 */
function makeHtmlHorizNav(bloc, blocmoduleposition, blocid, blocclass, blocmodulestyle) {
    // initialisation
    var code = new Array("head", "body");
    code["head"] = '';
    code["body"] = '';

    code["body"] = '|tab|<?php if ($this->countModules(\''+blocmoduleposition+'\')) : ?>|rr|'
    +'|tab|<div'+blocid+blocclass+'>|rr|'
    +'|tab||tab|<jdoc:include type="modules" name="'+blocmoduleposition+'" />|rr|'
    +'|tab|</div>|rr|'
    +'|tab|<div class="clr"></div>|rr|'
    +'|tab|<?php endif; ?>|rr||rr|';
    return code;
}


/**
 * Function to render a simple component layout
 *
 */
function makeHtmlSimpleComponent(bloc, blocid, blocclass, j) {
    // initialisation
    var code = new Array("head", "body");
    code["head"] = '';
    code["body"] = '';

    code["body"] += '|tab|<div'+blocid+blocclass+'>|rr|';
		
    var columns = new Array();
    var columnswidth = new Array();
    var wrapperwidth = $('htmlconteneur').getElement('#wrapper').getProperty('blocwidth') ? $('htmlconteneur').getElement('#wrapper').getProperty('blocwidth') : "1000";
    var i = 1;
    bloc.getElements('.column').each(function(column){	
        // retrieve data for the column
        column.ckid = column.getProperty("ckid") ? ' id="'+column.getProperty("ckid")+'"' : '';
        column.classe = column.getProperty("ckclass") ? column.getProperty("ckclass") : '';
        column.jdocstyle = column.getProperty("ckmodulestyle") ? ' style="'+column.getProperty("ckmodulestyle")+'"' : ' style="xhtml"';
        column.jdocposition = column.getProperty("ckmoduleposition") ? column.getProperty("ckmoduleposition") : '';
		
        // if in a single column, not in the component
        if (!column.hasClass('content')) {
            columns[i] = column.jdocposition;
            columnswidth[i] = column.getProperty('blocwidth') ? column.getProperty('blocwidth') : "200";
            code["body"] += '|tab||tab|<?php if ($this->countModules(\''+columns[i]+'\')) : ?>|rr|'
            +'|tab||tab|<div'+column.ckid+' class="column column'+i+' '+column.classe+'" style="width:'+(parseFloat(columnswidth[i]) / parseFloat(wrapperwidth)*100)+'%">|rr|'
            +'|tab||tab||tab|<div class="inner">|rr|'
            +'|tab||tab||tab||tab|<jdoc:include type="modules" name="'+columns[i]+'"'+column.jdocstyle+' />|rr|'
            +'|tab||tab||tab|</div>|rr|'
            +'|tab||tab|</div>|rr|'
            +'|tab||tab|<?php endif; ?>|rr|';
            i++;
        // if in the component
        } else {
            code["body"] += '|tab||tab|<div'+column.ckid+' class="column center '+column.classe+'" style="width:<?php echo $componentwidth; ?>%">|rr|'
            +'|tab||tab||tab|<div class="inner">|rr|'
            +'|tab||tab||tab||tab|<jdoc:include type="message" />|rr|'
            +'|tab||tab||tab|<jdoc:include type="component" />|rr|'
            +'|tab||tab||tab|</div>|rr|'
            +'|tab||tab|</div>|rr|';
        }              
    });
    code["body"] += '|tab||tab|<div class="clr"></div>|rr|'
    +'|tab|</div>|rr||rr|';

    
    var column1percent = parseFloat(columnswidth[1]) / parseFloat(wrapperwidth)*100;
    var column2percent = parseFloat(columnswidth[2]) / parseFloat(wrapperwidth)*100;
    code["head"] += '<?php|rr|'
    +'$componentwidth = 100;|rr|'
//    +'if ($this->countModules(\''+columns[1]+'\')) { $componentwidth = $componentwidth-'+columnswidth[1]+';}|rr|'
//    +'if ($this->countModules(\''+columns[2]+'\')) { $componentwidth = $componentwidth-'+columnswidth[2]+';}|rr|'
    +'if ($this->countModules(\''+columns[1]+'\')) { $componentwidth = 100-'+column1percent+';}|rr|'
    +'if ($this->countModules(\''+columns[2]+'\')) { $componentwidth = $componentwidth-'+column2percent+';}|rr|'
    +'?>|rr||rr|';

    window['COLUMN1WIDTH'] = columnswidth[1];
    window['COLUMN2WIDTH'] = columnswidth[2];
    window['WRAPPERWIDTH'] = wrapperwidth;
  
    return code;
}


/*
 * Function to render a complex component layout
 *
 */

function makeHtmlComplexComponent(bloc, blocid, blocclass, j) {
    var code = new Array("head", "body");
    code["head"] = '';
    code["body"] = '';
		
    // store data for each block in the layout
    bloc.getElements('.ckbloc').each(function(ckbloc){
        // retrieve data for the ckbloc
        ckbloc.ckid = ckbloc.getProperty("ckid") ? ' id="'+ckbloc.getProperty("ckid")+'"' : '';
        ckbloc.classe = ckbloc.getProperty("ckclass") ? ' '+ckbloc.getProperty("ckclass") : '';
        ckbloc.jdocstyle = ckbloc.getProperty("ckmodulestyle") ? ' style="'+ckbloc.getProperty("ckmodulestyle")+'"' : ' style="xhtml"';
        ckbloc.jdocposition = ckbloc.getProperty("ckmoduleposition") ? ckbloc.getProperty("ckmoduleposition") : '';
    });

    // begin the global container
    code["body"] += '|tab|<div'+blocid+blocclass+'>|rr|';
    var i = 1;
    bloc.getElements('.ckbloc').each(function(column){

        // if the first big column
        if (column.hasClass('column1')) {
            column1 = column.jdocposition;
            column1width = column.getProperty('blocwidth') ? column.getProperty('blocwidth') : '200';
            code["body"] += '|tab||tab|<?php if ($this->countModules(\''+column1+'\')) : ?>|rr|'
            +'|tab||tab|<div'+column.ckid+' class="column column1'+column.classe+'" style="width:'+column1width+'px">|rr|'
            +'|tab||tab||tab|<div class="inner">|rr|'
            +'|tab||tab||tab||tab|<jdoc:include type="modules" name="'+column1+'"'+column.jdocstyle+' />|rr|'
            +'|tab||tab||tab|</div>|rr|'
            +'|tab||tab|</div>|rr|'
            +'|tab||tab|<?php endif; ?>|rr|';
            i++;
        }

        // if the main container column - look into to search for other blocks
        if (column.hasClass('maincenter')) {
            code["body"] += '|tab||tab|<div'+column.ckid+' class="column maincenter'+column.classe+'" style="width:<?php echo $mainwidth; ?>px">|rr|'
            +'|tab||tab||tab|<div class="inner">|rr|';

            // look for sub columns
            column.getElements('.ckbloc').each(function(subcolumn){

                if (subcolumn.hasClass('maintop') || subcolumn.hasClass('mainbottom')) {
                    code["body"] += '|tab||tab||tab||tab|<?php if ($this->countModules(\''+subcolumn.jdocposition+'\')) : ?>|rr|'
                    +'|tab||tab||tab||tab|<div'+subcolumn.ckid+' class="'+subcolumn.classe+'">|rr|'
                    +'|tab||tab||tab||tab||tab|<jdoc:include type="modules" name="'+subcolumn.jdocposition+'"'+subcolumn.jdocstyle+' />|rr|'
                    +'|tab||tab||tab||tab|</div>|rr|'
                    +'|tab||tab||tab||tab|<?php endif; ?>|rr|';
                }

                if (subcolumn.hasClass('centercont')) {
                    // begin the center container
                    code["body"] += '|tab||tab||tab||tab|<div>|rr|';

                    subcolumn.getElements('.ckbloc').each(function(centercolumn) {
						
						
                        if (centercolumn.hasClass('column2')) {
                            column2 = centercolumn.jdocposition;
                            column2width = centercolumn.getProperty('blocwidth') ? centercolumn.getProperty('blocwidth') : '200';
                            code["body"] += '|tab||tab||tab||tab|<?php if ($this->countModules(\''+column2+'\')) : ?>|rr|'
                            +'|tab||tab||tab||tab|<div'+centercolumn.ckid+' class="column column2'+centercolumn.classe+'" style="width:'+column2width+'px">|rr|'
                            +'|tab||tab||tab||tab||tab|<div class="inner">|rr|'
                            +'|tab||tab||tab||tab||tab||tab|<jdoc:include type="modules" name="'+column2+'"'+centercolumn.jdocstyle+' />|rr|'
                            +'|tab||tab||tab||tab||tab|</div>|rr|'
                            +'|tab||tab||tab||tab|</div>|rr|'
                            +'|tab||tab||tab||tab|<?php endif; ?>|rr|';
                        }

                        if (centercolumn.hasClass('center')) {
                            code["body"] += '|tab||tab||tab||tab|<div'+centercolumn.ckid+' class="column center '+centercolumn.classe+'" style="width:<?php echo $componentwidth; ?>px">|rr|'
                            +'|tab||tab||tab||tab||tab|<div class="inner">|rr|';

                            // look for sub blocks
                            centercolumn.getElements('.ckbloc').each(function(centerbloc){
                                if (centerbloc.hasClass('centertop') || centerbloc.hasClass('centerbottom')) {
                                    code["body"] += '|tab||tab||tab||tab||tab||tab|<?php if ($this->countModules(\''+centerbloc.jdocposition+'\')) : ?>|rr|'
                                    +'|tab||tab||tab||tab||tab||tab|<div'+centerbloc.ckid+' class="'+centerbloc.classe+'">|rr|'
                                    +'|tab||tab||tab||tab||tab||tab||tab|<div class="inner">|rr|'
                                    +'|tab||tab||tab||tab||tab||tab||tab||tab|<jdoc:include type="modules" name="'+centerbloc.jdocposition+'"'+centerbloc.jdocstyle+' />|rr|'
                                    +'|tab||tab||tab||tab||tab||tab||tab|</div>|rr|'
                                    +'|tab||tab||tab||tab||tab||tab|</div>|rr|'
                                    +'|tab||tab||tab||tab||tab||tab|<?php endif; ?>|rr|';
                                }

                                if (centerbloc.hasClass('content')) {
                                    code["body"] += '|tab||tab||tab||tab||tab||tab|<div'+centerbloc.ckid+' class="'+centerbloc.classe+'">|rr|'
                                    +'|tab||tab||tab||tab||tab||tab||tab||tab|<jdoc:include type="message" />|rr|'
                                    +'|tab||tab||tab||tab||tab||tab||tab|<jdoc:include type="component" />|rr|'
                                    +'|tab||tab||tab||tab||tab||tab|</div>|rr|';

                                }
                            });

                            code["body"] += '|tab||tab||tab||tab||tab|</div>|rr|'
                        +'|tab||tab||tab||tab|</div>|rr|';

                        }
                    });

                    // close the center container
                    code["body"] += '|tab||tab||tab||tab||tab|<div class="clr"></div>|rr|'
                +'|tab||tab||tab||tab|</div>|rr|';
                }

            });

            // close main container column
            code["body"] += '|rr|'
        +'|tab||tab||tab|</div>|rr|'
        +'|tab||tab|</div>|rr|';
        }
    });


    // end floating and close the global container
    code["body"] += '|tab||tab|<div class="clr"></div>|rr|'
    +'|tab|</div>|rr||rr|';


    // make all head code
    var wrapperwidth = $('htmlconteneur').getElement('#wrapper').getProperty('blocwidth') ? $('htmlconteneur').getElement('#wrapper').getProperty('blocwidth') : "1000";
    code["head"] += '<?php|rr|'
    +'$mainwidth = '+wrapperwidth+';|rr|'
    +'if ($this->countModules(\''+column1+'\')) { $mainwidth = $mainwidth-'+column1width+';}|rr|'
    +'$componentwidth = $mainwidth;|rr|'
    +'if ($this->countModules(\''+column2+'\')) { $componentwidth = $mainwidth-'+column2width+';}|rr|'
    +'?>|rr||rr|';

    window['COLUMN1WIDTH'] = column1width;
    window['COLUMN2WIDTH'] = column2width;
    window['WRAPPERWIDTH'] = wrapperwidth;

    return code;
}

/**
 * Method to return a message if some position have no module published
 */
function checkModules(action) {
    if (!action) action = 'test';
    var myurl = "index.php?option=com_templateck&view=templateck&layout=ajaxcheckmodules&tmpl=component"
    +"&positions="+$$('.ckbloc').getProperty('ckmoduleposition')
    +"&action="+action;

    var packageRequest = new Request.HTML({
        url:myurl,
        method: 'get',
        update: document.id('modules_code_inner'),
        onRequest: function(){
        // document.id('packagestepxml').set('text', Joomla.JText._('CK_LOADING', 'Loading...'));
        },
        onSuccess: function(){
        // document.id('packagestepxml').set('text', Joomla.JText._('CK_LOAD_SUCCESS_STEP_XML', 'Next step finished with success'));
        },
        onFailure: function(){
        // document.id('packagestepxml').set('text', Joomla.JText._('CK_LOAD_FAILURE_STEP_XML', 'Next step encounter some errors'));
        }
    });
    packageRequest.send();



}

/**
 * Method to return a message if some position have no module published
 */
function showcheckModules() {
    if ($('modules_code').getStyle('display') != 'block') {
        document.getElements('.ckpopup').setStyles({
            'opacity':'0',
            'display':'none'
        });
        document.id('modules_code').setStyle('display','block').tween('opacity', '1');
    }

    checkModules();
}


/*
 * Get the HTML and transform it into simple block for responsive management
 * @container Object the main html container
 * return Array of blocks
 */
function genResponsivecode(container) {
	var blocks = container.getElements('.ckbloc');
	var code = new Array();
	var i = 0;
	blocks.each(function(el) {
		block = new Object();
		block['ckid'] = el.getProperty('ckid');
		block['ckclass'] = el.className;
		code[i] = block;
		i++;
	});

	return JSON.encode(code);
}



/**********************************************
 * now begin the DOM *
 * ***********************************************/
window.addEvent('domready', function() {

    // add drag and drop on the menu
    //    $$('.ckpopup').each(function(popup) {
    //        new Drag(popup);
    //    });

    // check if the modules positions contains some data to be displayed
    checkModules();
	
    // add event on fields for displaying controls,ID, class, ...
    $$('.ckbloc').each(function(el) {
        if (el.getElement('.ckfields')) {
            addckfieldsevent(el);
            fillFields(el, el.getProperty('ckid'), el.getProperty('ckclass'), el.getProperty('ckmoduleposition'), el.getProperty('ckmodulestyle'));
        }
    });


    // add event to launch function depending on rel attribute of the link to add a block
    $$('.ck_action').each(function(el){
        el.addEvent('click',function(){
            var func = window[this.getProperty('rel')];
            func();
            checkModules();
        });
    });

    // manage the css controls for the body and wrapper
    if ($('body')) {
        $('bodycss').addEvent('click', function() {
            showCsspopup($('body'));
        });
    }
    if ($('wrapper')) {
        $('wrappercss').addEvent('click', function() {
            showCsspopup($('wrapper'));
        });
    }

});



/**
 * Class for simple tabs
 */
var tabsCK = new Class({
    options: {
        buttonsClass: 'menubutton',
        containersClass: 'menupane',
        prefix: '',
        activeclass: 'activecontainer'
    },

    initialize: function(el, options) {
        var el = document.id(el);
        if (!el) return;
        this.setOptions(options);

        var prefix = this.options.prefix;
        var tabsButtons = el.getElements('.'+this.options.buttonsClass);
        var tabsContainers = el.getElements('.'+this.options.containersClass);
        var buttonsClass = this.options.buttonsClass;
        var activeclass = this.options.activeclass;


        tabsContainers.setStyle('display','none');
        tabsContainers[0].setStyle('display','block').addClass(activeclass);
        tabsButtons[0].addClass('activebutton');

        tabsButtons.addEvent('click', function() {
            tabsPosition = tabsButtons.length-this.getAllNext('.'+buttonsClass).length-1;

            if (!this.hasClass('activebutton')) {
                tabsButtons.removeClass('activebutton');
                this.addClass('activebutton');
                el.getElements('.'+activeclass).setStyle('display','none').removeClass(activeclass);
                tabsContainers[tabsPosition].setStyle('display', 'block').addClass(activeclass);
            }
        });
    }
});
tabsCK.implement(new Options);
