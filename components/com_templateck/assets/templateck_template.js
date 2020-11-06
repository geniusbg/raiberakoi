/**
 * @name		Template Creator CK 3
 * @package		com_templateck
 * @copyright	Copyright (C) 2013. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 * @author		Cedric Keiflin - http://www.template-creator.com - http://www.joomlack.fr
 */

var $ck = jQuery.noConflict();

/*
 * Functions to manage colors conversion
 *
 */
function hexToR(h) {
	return parseInt((cutHex(h)).substring(0, 2), 16)
}
function hexToG(h) {
	return parseInt((cutHex(h)).substring(2, 4), 16)
}
function hexToB(h) {
	return parseInt((cutHex(h)).substring(4, 6), 16)
}
function cutHex(h) {
	return (h.charAt(0) == "#") ? h.substring(1, 7) : h
}
function hexToRGB(h) {
	return 'rgb(' + hexToR(h) + ',' + hexToG(h) + ',' + hexToB(h) + ')';
}

function jInsertEditorText(text, editor) {
	var newEl = new Element('span').set('html', text);
	var valeur = newEl.getChildren()[0].getAttribute('src');
	$(editor).value = valeur;
	$(editor).fireEvent('change');
}

function initTooltips() {
	new Tips($$('.hasTip'),
			{maxTitleChars: 50, fixed: false});
}

function initModalPopup() {
	SqueezeBox.initialize({});
	SqueezeBox.assign($$('a.modal'), {
		parse: 'rel'
	});
}

function initAccordionStyles() {
	$ck('.menustylesblockaccordion').hide();
	$ck('.ckproperty').each(function(i, tab) {
		tab = $ck(tab);
		$ck('.menustylesblockaccordion', tab).first().show();
		$ck('.menustylesblocktitle', tab).first().addClass('open');
		$ck('.menustylesblocktitle', tab).click(function() {
			if (!$ck(this).hasClass('open')) {
				$ck('.menustylesblockaccordion', tab).slideUp('fast');
				blocstyle = $ck(this).next('.menustylesblockaccordion');
				$ck('.menustylesblocktitle', tab).removeClass('open');
				$ck(this).addClass('open');
				blocstyle.slideDown('fast');
			}
		});
	});

}

function initColorPickers() {
	var startcolor = '';
	document.getElements('.colorPicker').each(function(picker) {
		setpickercolor(picker);
		picker.addEvent('mousedown', function() {
			if (picker.value) {
				startcolor = [hexToR(picker.value), hexToG(picker.value), hexToB(picker.value)]/*'['+hexToR(picker.value)+','+hexToG(picker.value)+','+hexToB(picker.value)+']'*/;
			}
			else {
				startcolor = [0, 255, 255];
			}
			$ck('#colorpicker').remove();
			new MooRainbow(picker, {
				'id': 'colorpicker',
				'startColor': startcolor,
				'imgPath': URIROOT + '/components/com_templateck/images/moorainbow/',
				'onChange': function(color) {
					setpickercolor(picker);
					picker.value = color.hex;
					picker.setStyle('background-color', color.hex);
				},
				'onClean': function(color) {
					picker.value = '';
					picker.setStyle('background', 'none');
				},
				'onCopy': function(color) {
					CLIPBOARDCOLORCK = picker.value;
				},
				'onPaste': function(color) {
					picker.value = CLIPBOARDCOLORCK;
					picker.setStyle('background', CLIPBOARDCOLORCK);
					setpickercolor(picker);
				}
			});
		});
	});
}

/**
 * Method to give a black or white color to have a good contrast
 */
function setpickercolor(picker) {
	pickercolor =
			0.213 * hexToR(picker.value) / 100 +
			0.715 * hexToG(picker.value) / 100 +
			0.072 * hexToB(picker.value) / 100
			< 1.5 ? '#FFF' : '#000';
	picker.setStyle('color', pickercolor);
	return pickercolor;
}

function createGradientPreview(prefix) {
	if (!$(prefix + 'gradientpreview'))
		return;
	var area = $(prefix + 'gradientpreview');
	if ($(prefix + 'backgroundcolorstart') && $(prefix + 'backgroundcolorstart').value) {
		$(prefix + 'backgroundcolorend').removeProperty('disabled');
		$(prefix + 'backgroundpositionend').removeProperty('disabled');
	} else {
		$(prefix + 'backgroundcolorend').setProperties({'disabled': 'disabled', 'value': ''});
		$(prefix + 'backgroundcolorend').setStyle('background-color', '');
		$(prefix + 'backgroundpositionend').setProperties({'disabled': 'disabled', 'value': '100'});
	}
	if ($(prefix + 'backgroundcolorend') && $(prefix + 'backgroundcolorend').value) {
		$(prefix + 'backgroundcolorstop1').removeProperty('disabled');
		$(prefix + 'backgroundpositionstop1').removeProperty('disabled');
		$(prefix + 'backgroundopacity').setProperties({'disabled': 'disabled', 'value': ''});
	} else {
		$(prefix + 'backgroundcolorstop1').setProperties({'disabled': 'disabled', 'value': ''});
		$(prefix + 'backgroundcolorstop1').setStyle('background-color', '');
		$(prefix + 'backgroundpositionstop1').setProperties({'disabled': 'disabled', 'value': ''});
		$(prefix + 'backgroundopacity').removeProperty('disabled');
	}
	if ($(prefix + 'backgroundcolorstop1') && $(prefix + 'backgroundcolorstop1').value) {
		$(prefix + 'backgroundcolorstop2').removeProperty('disabled');
		$(prefix + 'backgroundpositionstop2').removeProperty('disabled');
	} else {
		$(prefix + 'backgroundcolorstop2').setProperties({'disabled': 'disabled', 'value': ''});
		$(prefix + 'backgroundcolorstop2').setStyle('background-color', '');
		$(prefix + 'backgroundpositionstop2').setProperties({'disabled': 'disabled', 'value': ''});
	}

	var gradientstop1 = '';
	var gradientstop2 = '';
	var gradientend = '';
	var gradientpositionstop1 = '';
	var gradientpositionstop2 = '';
	var gradientpositionend = '';
	if ($(prefix + 'backgroundpositionstop1') && $(prefix + 'backgroundpositionstop1').value)
		gradientpositionstop1 = $(prefix + 'backgroundpositionstop1').value + '%';
	if ($(prefix + 'backgroundpositionstop2') && $(prefix + 'backgroundpositionstop2').value)
		gradientpositionstop2 = $(prefix + 'backgroundpositionstop2').value + '%';
	if ($(prefix + 'backgroundpositionstop3') && $(prefix + 'backgroundpositionend').value)
		gradientpositionend = $(prefix + 'backgroundpositionend').value + '%';
	if ($(prefix + 'backgroundcolorstop1') && $(prefix + 'backgroundcolorstop1').value)
		gradientstop1 = $(prefix + 'backgroundcolorstop1').value + ' ' + gradientpositionstop1 + ',';
	if ($(prefix + 'backgroundcolorstop2') && $(prefix + 'backgroundcolorstop2').value)
		gradientstop2 = $(prefix + 'backgroundcolorstop2').value + ' ' + gradientpositionstop2 + ',';
	if ($(prefix + 'backgroundcolorend') && $(prefix + 'backgroundcolorend').value)
		gradientend = $(prefix + 'backgroundcolorend').value + ' ' + gradientpositionend;
	var stylecode = '<style type="text/css">'
			+ '#' + prefix + 'gradientpreview {'
			+ 'background:' + $(prefix + 'backgroundcolorstart').value + ';'
			+ 'background-image: -o-linear-gradient(top,' + $(prefix + 'backgroundcolorstart').value + ',' + gradientstop1 + gradientstop2 + gradientend + ');'
			+ 'background-image: -webkit-linear-gradient(top,' + $(prefix + 'backgroundcolorstart').value + ',' + gradientstop1 + gradientstop2 + gradientend + ');'
			+ 'background-image: -webkit-gradient(linear, left top, left bottom,' + $(prefix + 'backgroundcolorstart').value + ',' + gradientstop1 + gradientstop2 + gradientend + ');'
			+ 'background-image: -moz-linear-gradient(top,' + $(prefix + 'backgroundcolorstart').value + ',' + gradientstop1 + gradientstop2 + gradientend + ');'
			+ 'background-image: -ms-linear-gradient(top,' + $(prefix + 'backgroundcolorstart').value + ',' + gradientstop1 + gradientstop2 + gradientend + ');'
			+ 'background-image: linear-gradient(top,' + $(prefix + 'backgroundcolorstart').value + ',' + gradientstop1 + gradientstop2 + gradientend + ');'
			+ '}'
			+ '</style>';
	area.getElement('.injectstyles').set('html', stylecode);
}

function toggleNoeditorMode(button) {
	if ($ck('#body').hasClass('noeditor')) {
		$ck('#body').addClass('editor');
		$ck('#body').removeClass('noeditor');
		$ck(button).removeClass('noeditor');
	} else {
		$ck('#body').addClass('noeditor');
		$ck('#body').removeClass('editor');
		$ck(button).addClass('noeditor');
	}
}

function toggleExpertMode(button) {
	if ($ck('#body').hasClass('expert')) {
		$ck('#body').removeClass('expert');
		$ck(button).removeClass('expert');
	} else {
		$ck('#body').addClass('expert');
		$ck(button).addClass('expert');
	}
}

function toggleThemes(button) {
	if ($ck(button).hasClass('active')) {
		$ck('#showthemes').hide('slow');
		$ck(button).removeClass('active');
	} else {
		$ck('#showthemes').show('slow');
		$ck(button).addClass('active');
	}
}

function toggleBootstrap() {
	if ($ck('#blocloadboostrap').length && $ck('#blocloadboostrap').attr('value') == '0' || $ck('#joomlaversion').attr('value') != 'j3') {
		$ck('#body > .tab_blocstyles').attr('blocloadboostrap', '0');
		$ck("#bootstrapload").empty();
		$ck('#bootstrapload').append('<link rel="stylesheet" type="text/css" href="' + URIROOT + '/components/com_templateck/default.css">');
		$ck("#bootstrapload").removeClass('bootstraploaded');
	} else if ($ck('#blocloadboostrap').length && $ck('#blocloadboostrap').attr('value') == '1') {
		$ck("#bootstrapload").empty();
		$ck('#bootstrapload').append('<link rel="stylesheet" type="text/css" href="' + URIROOT + '/components/com_templateck/assets/bootstrap.css">');
		$ck("#bootstrapload").addClass('bootstraploaded');
	}
}

function toogleWrapperFluid() {
	if (!$ck('#blocwrapperfluid').length && $ck('> .tab_blocstyles', $ck('#body')).length && !$ck('> .tab_blocstyles', $ck('#body')).attr('blocwrapperfluid').length)
		return;
	if ($ck('#blocwrapperfluid').length) {
		value = $ck('#blocwrapperfluid').attr('value');
	} else {
		value = $ck('> .tab_blocstyles', $ck('#body')).attr('blocwrapperfluid');
	}
	if (value == 'fluid') {
		$ck('.container').removeClass('container').addClass('container-fluid');
	} else {
		$ck('.container-fluid').removeClass('container-fluid').addClass('container');
	}
}

function copytoclipboard(button) {
	CLIPBOARDCK = document.getElements('.inputbox').getProperties('id', 'value');
	alert(Joomla.JText._('CK_COPYTOCLIPBOARD', 'Current styles copied to clipboard !'));
}

function pastefromclipboard(button) {
	if (CLIPBOARDCK) {
		if (!confirm(Joomla.JText._('CK_COPYFROMCLIPBOARD', 'Apply styles from Clipboard ? This will replace all current existing styles.')))
			return;
		CLIPBOARDCK.each(function(field) {
			if ($(field.id)) {
				$(field.id).value = field.value;
			}
		});
	} else {
		alert(Joomla.JText._('CK_CLIPBOARDEMPTY', 'Clipboard is empty'));
	}
}

function validateTemplateName(input) {
	input = $ck(input);
	var name = input.attr('value').replace(/\s/g, "");
	name = name.toLowerCase();
	input.attr('value', name);
}

/*
 * Show the window for global infos (name, date, author...)
 */
function editGlobalinfos() {
	$ck('#infos_code').toggle('fast');
}

/*
 * Function to load the HTML modele in the page
 */
function loadModele(name) {
	var myurl = "index.php?option=com_templateck&view=template&layout=" + name + "&template=templatecreatorck&tmpl=component";
	$ck.ajax({
		type: "POST",
		url: myurl
	}).done(function(code) {
		$ck("#conteneur").html(code);
		checkModules();
		loadTheme('default', 'no');
	}).fail(function(code) {
		alert(Joomla.JText._('CK_FAILED', 'Failed'));
	});
}

function loadTheme(themename, ask) {
	valid = '1';
	valid = confirm(Joomla.JText._('CK_ERASE_WITH_NEW_THEME', 'WARNING : This will erase your data with the new theme, continue ?'));
	if (valid == null || valid == "")
		return;
	$ck(document.body).append('<div id="ckwaitoverlay"></div>');
	var myurl = "index.php?option=com_templateck&view=template&layout=ajaxloadtheme&template=templatecreatorck&tmpl=component";
	$ck.ajax({
		type: "POST",
		url: myurl,
		data: {themename: themename}
	}).done(function(code) {
		applyTheme(code);
		$ck('#ckwaitoverlay').remove();
	}).fail(function() {
		alert(Joomla.JText._('CK_FAILED', 'Failed'));
		$ck('#ckwaitoverlay').remove();
	});
}

function applyTheme(code) {
	code = code.replace(/\|di\|/g, "#");
	theme = $ck.parseJSON(code);
	$ck('.ckstyle').empty();
	$ck('.ckprops').remove();
	for (i = 0; i < theme.length; i++) {
		bloc = theme[i];
		if (!bloc)
			continue;
		focus = $ck(bloc['type']);
		focus.each(function(k, focusbloc) {
			j = 0;
			focusbloc = $ck(focusbloc);
			while (bloc['ckprops' + j]) {
				blocClass = $ck('<div ' + bloc['ckprops' + j] + ' />').removeClass('ckprops').attr('class');
				$ck('> .' + blocClass, focusbloc).remove();
				focusbloc.prepend('<div ' + bloc['ckprops' + j] + ' />');
				j++;
			}
			if (bloc['style']) {
				blocstyle = bloc['style'].replace(/\|ID\|/g, focusbloc.attr('id')).replace(/\|URIBASE\|/g, URIBASE + "/");
				$ck('> .ckstyle', focusbloc).empty().append('<style>' + blocstyle + '</style>');
			}
		});
	}
	toogleWrapperFluid();
}

function getTheme() {
	var blocs = new Array();
	var types = Array('.body', '.wrapper', '.mainbanner', '.bannerlogo', '.bannerlogodesc', '.banner', '.horiznav', '.singlemodule', '.flexiblemodules',
			'.flexiblemodules > .inner > .flexiblemodule:first-child', '.flexiblemodules > .inner > .flexiblemodule:first-child + .flexiblemodule', '.flexiblemodules > .inner > .flexiblemodule:first-child + .flexiblemodule + .flexiblemodule', '.flexiblemodules > .inner > .flexiblemodule:first-child + .flexiblemodule + .flexiblemodule + .flexiblemodule', '.flexiblemodules > .inner > .flexiblemodule:first-child + .flexiblemodule + .flexiblemodule + .flexiblemodule + .flexiblemodule',
			'.maincontent', '.column1', '.main', '.maintop', '.maincenter', '.mainbottom', '.center',
			'.column2', '.centertop', '.centerbottom', '.content');
	for (i = 0; i < types.length; i++) {
		type = types[i];
		if (!$ck(type).length) {
			alert('pas de ' + type + ' dans la page !');
			continue;
		}
		bloc = $ck(type);
		var cssblocs = new Object();
		cssblocs['type'] = type;
		blocstyle = ($ck('> .ckstyle', bloc).length && $ck('> .ckstyle', bloc).html()) ? $ck('> .ckstyle', bloc).html() : '';
		if (blocstyle) {
			var id = new RegExp(bloc.attr('id'), "g");
			blocstyle = blocstyle.replace(id, "|ID|");
			var uri = new RegExp(URIBASE + "/", "g");
			blocstyle = blocstyle.replace(uri, "|URIBASE|");
		}
		cssblocs['style'] = blocstyle;
		$ck('> .ckprops', bloc).each(function(i, ckprops) {
			ckprops = $ck(ckprops);
			text = 'class="' + ckprops.attr('class') + '" ';
			fieldslist = ckprops.attr('fieldslist') ? ckprops.attr('fieldslist').split(',') : Array();
			text += 'fieldslist="' + ckprops.attr('fieldslist') + '" ';
			fieldslist.each(function(fieldname) {
				text += fieldname + '="' + ckprops.attr(fieldname) + '" ';
			});
			cssblocs['ckprops' + i] = text;
		});
		blocs[i] = cssblocs;
	}
	return blocs;
}

function saveTheme() {
	var theme = getTheme();
	theme = JSON.stringify(theme);
	theme = theme.replace(/#/g, "|di|");
	themename = prompt('nom du theme ?');
	if (themename == null || themename == '')
		return;
	var myurl = "index.php?option=com_templateck&view=template&layout=ajaxsavetheme&template=templatecreatorck&tmpl=component";
	$ck.ajax({
		type: "POST",
		url: myurl,
		data: {theme: theme,
			themename: themename}
	}).done(function(code) {
		$ck("#themefile").html(code);
		checkModules();
	}).fail(function(code) {
		alert(Joomla.JText._('CK_FAILED', 'Failed'));
	});
}

/*
 * Create the full template archive
 */
function templatePackage(task) {
	if ($ck('#name').attr('value') == '') {
		alert(Joomla.JText._('TEMPLATE_MUST_HAVE_NAME', 'You must give a name to the template'));
		return;
	}

	$ck('#packagestep1').empty();
	$ck('#packagestepcss').empty();
	$ck('#packagestepxml').empty();
	$ck('.packagesteparchive').empty();
	$ck('#joomla_code').fadeIn();
	makeHtmlStep(task);
}

/**
 * Method to return a message if some position have no module published
 */
function checkModules(action) {
	if (!action)
		action = 'test';
	var myurl = "index.php?option=com_templateck&view=template&layout=ajaxcheckmodules&tmpl=component"
			+ "&positions=" + $$('.ckbloc[isdisabled!=true]').getProperty('ckmoduleposition')
			+ "&action=" + action;

	var packageRequest = new Request.HTML({
		url: myurl,
		method: 'get',
		update: document.id('modules_code_inner'),
		onRequest: function() {
			// document.id('packagestepxml').set('text', Joomla.JText._('CK_LOADING', 'Loading...'));
		},
		onSuccess: function() {
			// document.id('packagestepxml').set('text', Joomla.JText._('CK_LOAD_SUCCESS_STEP_XML', 'Next step finished with success'));
		},
		onFailure: function() {
			// document.id('packagestepxml').set('text', Joomla.JText._('CK_LOAD_FAILURE_STEP_XML', 'Next step encounter some errors'));
		}
	});
	packageRequest.send();
}


/**
 * Method to return a message if some position have no module published
 */
function showcheckModules() {
	$ck('#modules_code').fadeIn();
	checkModules();
}

/*
 * Method to give a random unique ID
 */
function getUniqueid() {
	var now = new Date().getTime();
	var id = 'ID' + parseInt(now, 10);
	if ($ck('#' + id).length)
		getUniqueid();
	return id;
}

function createWrapperBloc(currentblocid) {
	var blockid = prompt("Please enter a unique ID for the new wrapper (must be a text)", getWrapperProposal());
	if (blockid != null && blockid != "" && !$ck('#' + blockid).length) {
		addBloc('wrapper', blockid, '', currentblocid);
	} else if ($ck('#' + blockid).length) {
		alert(Joomla.JText._('CK_INVALID_ID', 'ID invalid or already exist'));
	}
}

function getWrapperProposal() {
	var i = 1;
	while ($ck('#wrapper' + i).length && i < 1000) {
		i++;
	}
	return 'wrapper' + i;
}

function showBlocSelection(currentblocid) {
	$ck(document.body).append('<div id="ckwaitoverlay"></div>');
	$ck('.controlfocus').removeClass('controlfocus');
	$ck('#popup_editionck').empty().fadeIn();
	$ck('html, body').animate({scrollTop: 0}, 'slow');
	var myurl = "index.php?option=com_templateck&view=template&layout=ajaxblocselection&template=templatecreatorck&tmpl=component";
	$ck.ajax({
		type: "POST",
		url: myurl,
		data: {
			currentblocid: currentblocid
		}
	}).done(function(code) {
		$ck('#popup_editionck').append(code);
		$ck('#ckwaitoverlay').remove();
	}).fail(function() {
		alert(Joomla.JText._('CK_FAILED', 'Failed'));
		$ck('#ckwaitoverlay').remove();
	});
}

function addBloc(type, blockid, blockposition, currentblocid) {
	$ck('#popup_editionck').empty().hide();
	var myurl = "index.php?option=com_templateck&view=template&layout=ajaxcreatebloc&template=templatecreatorck&tmpl=component";
	$ck.ajax({
		type: "POST",
		url: myurl,
		data: {
			tmpl: 'component',
			blockid: blockid,
			blockposition: blockposition,
			fluid: $ck('#body > .tab_blocstyles').attr('blocwrapperfluid'),
			type: type
		}
	}).done(function(code) {
		if (type == 'wrapper') {
			$ck('#' + currentblocid).before(code);
		} else {
			$ck('#' + currentblocid + ' > div.inner').prepend(code);
		}
	}).fail(function() {
		alert(Joomla.JText._('CK_FAILED', 'Failed'));
	});
}

function addControlsOnHover(bloc) {
	bloc = $ck(bloc);
	if ($ck('> .editorck', bloc).length)
		return;
	bloc.mouseenter(function() {
		addEdition(this);
	});
	bloc.mouseleave(function() {
		removeEdition(this);
	});
	bloc.dblclick(function() {
		if (bloc.hasClass('paused')) {
			removeEdition(this);
			bloc.removeClass('paused');
		} else {
			addEdition(this);
			bloc.addClass('paused');
		}
	});
}

function addEdition(bloc, i) {
	if ($ck('.paused').length) return;
	if (!i)
		i = 0;
	bloc = $ck(bloc);
	if ($ck('> .editorck', bloc).length && i == 0)
		return;
	var leftpos = bloc.position().left;
	var toppos = bloc.position().top;
	var editorclass = '';
	if (i == 0)
		editorclass = ' mainroot';
	var editor = '<div class="editorck' + editorclass + '" id="' + bloc.prop('id') + '-edition"></div>';
	editor = $ck(editor);
	editor.css({
		'left': leftpos,
		'top': toppos,
		'position': 'absolute',
		'z-index': 100 + i,
		'width': bloc.outerWidth()
	});
	addEditionControls(editor, bloc);
	bloc.append(editor);
	editor.css('display', 'none').fadeIn('fast');
}

function addEditionControls(editor, bloc) {
	var controlclass = 'innermodule';
	var fadebloc = false;
	if (bloc.hasClass('flexiblemodules')
			|| bloc.hasClass('singlemodule')
			|| bloc.hasClass('maincontent')
			|| bloc.hasClass('mainbanner')
			|| bloc.hasClass('wrapper')
			) {
		controlclass = 'mainleft';
		fadebloc = true;
	}

	var controls = "<div class=\"ckfields " + controlclass + "\">"
			+ "<div class=\"controlDel isControl\" onclick=\"deletebloc('" + bloc.attr('id') + "');\"></div>"
			+ "<div class=\"controlUp isControl\" onclick=\"moveblocUp('" + bloc.attr('id') + "'," + fadebloc + ");\"></div>"
			+ "<div class=\"controlDown isControl\" onclick=\"moveblocDown('" + bloc.attr('id') + "'," + fadebloc + ");\"></div>"
			+ "<div class=\"controlCss isControl\" onclick=\"showEditionPopup('" + bloc.attr('id') + "');\"></div>";
	if (bloc.hasClass('flexiblemodules'))
		controls += "<div class=\"controlModules isControl\" onclick=\"showModulesPopup('" + bloc.attr('id') + "')\"></div>";
	if (bloc.hasClass('maincontent'))
		controls += "<div class=\"controlMaincontent isControl\" onclick=\"showMaincontentPopup('" + bloc.attr('id') + "')\"></div>";
	if (bloc.hasClass('wrapper')) {
		controls += "<div class=\"controladdBlock isControl\" onclick=\"showBlocSelection('" + bloc.attr('id') + "')\"></div>";
		controls += "<div class=\"controladdWrapper isControl\" onclick=\"createWrapperBloc('" + bloc.attr('id') + "')\"></div>";
	}
	controls += "<span class=\"editorcktitle\" onclick=\"changeBlocId('" + bloc.attr('id') + "')\">" + bloc.attr('id') + "</span>";
	if (bloc.attr('ckmoduleposition'))
		controls += "<span class=\"editorckposition\" onclick=\"changeBlocPosition('" + bloc.attr('id') + "')\">" + bloc.attr('ckmoduleposition') + "</span>";
	controls += "</div>";

	editor.append(controls);
}

function removeEdition(bloc, all) {
	if (!all)
		all = false;
	bloc = $ck(bloc);
	if (bloc.hasClass('paused')) return;
	if (all = true) {
		$ck('.editorck', bloc).remove();
	} else {
		$ck('> .editorck', bloc).remove();
	}
}

function deletebloc(blocid) {
	bloc = $ck('#' + blocid);
	if (confirm('Do you want to delete ?')) {
		bloc.remove();
	}
}

function moveblocUp(blocid, fadebloc) {
	bloc = $ck('#' + blocid);
	var myPrevious = bloc.prev();
	if (myPrevious.length && myPrevious.hasClass('ckbloc')) {
		myPrevious.before(bloc);
		if (fadebloc == true) {
			bloc.css('display', 'none').fadeIn();
			removeEdition($ck(document.body), true);
		}
		removeEdition($ck(document.body), true);
	}
}

function moveblocDown(blocid, fadebloc) {
	bloc = $ck('#' + blocid);
	var myNext = bloc.next();
	if (myNext.length && myNext.hasClass('ckbloc')) {
		myNext.after(bloc);
		if (fadebloc == true) {
			bloc.css('display', 'none').fadeIn();
			removeEdition($ck(document.body));
		}
		removeEdition($ck(document.body));
	}
}

function changeBlocId(blocid) {
	bloc = $ck('#' + blocid);
	if (bloc.attr('id') == 'wrapper')
		return;
	var result = prompt(Joomla.JText._('CK_ENTER_UNIQUE_ID', 'Please enter a unique ID (must be a text)'), bloc.attr('id'));
	if (!result)
		return;
	result = validateName(result);
	if (validateBlocId(result))
		updateIdPosition(blocid, result, '');
}

function changeBlocPosition(blocid) {
	bloc = $ck('#' + blocid);
	var result = prompt(Joomla.JText._('CK_ENTER_UNIQUE_POSITION', 'Please enter a unique Position (must be a text)'), bloc.attr('ckmoduleposition'));
	if (!result)
		return;
	result = validateName(result);
	if (validateBlocPosition(result))
		updateIdPosition(blocid, '', result);
}

function validateBlocId(newid) {
	if (newid != null && newid != "" && !$ck('#' + newid).length) {
		return true;
	} else if ($ck('#' + newid).length && $ck('#' + newid).attr('isdisabled') != 'true') {
		alert(Joomla.JText._('CK_INVALID_ID', 'ID invalid or already exist'));
		return false;

	} else if (newid == null || newid == "") {
		alert(Joomla.JText._('CK_ENTER_VALID_ID', 'Please enter a valid ID'));
		return false;
	}
	return true;
}

function validateName(name) {
	var name = name.replace(/\s/g, "");
	name = name.toLowerCase();
	return name;
}

function validateBlocPosition(newposition) {
	if (newposition == null || newposition == "") {
		alert(Joomla.JText._('CK_ENTER_VALID_POSITION', 'Please enter a valid position'));
		return false;
	}
	var alreadyexists = false;
	$ck('.ckbloc').each(function(i, bloc) {
		bloc = $ck(bloc);
		if (bloc.attr('ckmoduleposition') == newposition && bloc.attr('isdisabled') != 'true') {
			alert(Joomla.JText._('CK_POSITION_ALREADY_USED', 'Position already used'));
			alreadyexists = true;
		}
	});
	return !alreadyexists;
}

function updateIdPosition(blocid, newid, newposition) {
	bloc = $ck('#' + blocid);
	if (newposition) {
		$ck('.editorckposition', bloc).html(newposition);
		bloc.attr('ckmoduleposition', newposition);
	}
	if (newid) {
		$ck('.editorcktitle', bloc).html(newid);
		bloc.attr('id', newid);
	}
}

function showEditionPopup(blocid) {
	blocid = '#' + blocid;
	keepAliveAdmin();
	$ck(document.body).append('<div id="ckwaitoverlay"></div>');
	bloc = $ck(blocid);
	$ck('.cssfocus').removeClass('cssfocus');
	bloc.addClass('cssfocus');
	$ck('#popup_editionck').empty().fadeIn();
	$ck('html, body').animate({scrollTop: 0}, 'slow');

	var myurl = "index.php?option=com_templateck&view=template&layout=ajaxstylescss&template=templatecreatorck&tmpl=component";
	$ck.ajax({
		type: "POST",
		url: myurl,
		data: {
			objclass: bloc.prop('class'),
			expertmode: $ck('#body').hasClass('expert'),
			objid: bloc.prop('id')
		}
	}).done(function(code) {
		$ck('#popup_editionck').append(code);
		$ck('#ckwaitoverlay').remove();
		fillEditionPopup(blocid);
	}).fail(function() {
		alert(Joomla.JText._('CK_FAILED', 'Failed'));
		$ck('#ckwaitoverlay').remove();
	});
}

function showModulesPopup(blocid) {
	$ck(document.body).append('<div id="ckwaitoverlay"></div>');
	bloc = $ck('#' + blocid);
	$ck('.cssfocus').removeClass('cssfocus');
	bloc.addClass('cssfocus');
	$ck('#popup_editionck').empty().fadeIn();
	$ck('html, body').animate({scrollTop: 0}, 'slow');
	var myurl = "index.php?option=com_templateck&view=template&layout=ajaxmodulesmanager&template=templatecreatorck&tmpl=component";
	$ck.ajax({
		type: "POST",
		url: myurl,
		data: {
		}
	}).done(function(code) {
		$ck('#popup_editionck').append(code);
		$ck('#ckwaitoverlay').remove();
	}).fail(function() {
		alert(Joomla.JText._('CK_FAILED', 'Failed'));
		$ck('#ckwaitoverlay').remove();
	});
}

function showMaincontentPopup(blocid) {
	$ck(document.body).append('<div id="ckwaitoverlay"></div>');
	bloc = $ck('#' + blocid);
	$ck('.cssfocus').removeClass('cssfocus');
	bloc.addClass('cssfocus');
	$ck('#popup_editionck').empty().fadeIn();
	$ck('html, body').animate({scrollTop: 0}, 'slow');
	var myurl = "index.php?option=com_templateck&view=template&layout=ajaxmaincontentmanager&template=templatecreatorck&tmpl=component";
	$ck.ajax({
		type: "POST",
		url: myurl,
		data: {
		}
	}).done(function(code) {
		$ck('#popup_editionck').append(code);
		$ck('#ckwaitoverlay').remove();
	}).fail(function() {
		alert(Joomla.JText._('CK_FAILED', 'Failed'));
		$ck('#ckwaitoverlay').remove();
	});
}

function showParamsPopup() {
	$ck(document.body).append('<div id="ckwaitoverlay"></div>');
	bloc = $ck('#body');
	$ck('#popup_editionck').empty().fadeIn();
	$ck('html, body').animate({scrollTop: 0}, 'slow');
	var myurl = "index.php?option=com_templateck&view=template&layout=ajaxparams&template=templatecreatorck&tmpl=component";
	$ck.ajax({
		type: "POST",
		url: myurl,
		data: {
			expertmode: $ck('#body').hasClass('expert'),
			joomlaversion: $ck('#joomlaversion').attr('value')
		}
	}).done(function(code) {
		$ck('#popup_editionck').append(code);
		$ck('#ckwaitoverlay').remove();
		fillEditionPopup('#body');
	}).fail(function() {
		alert(Joomla.JText._('CK_FAILED', 'Failed'));
		$ck('#ckwaitoverlay').remove();
	});
}

function showResponsivePopup() {
	$ck(document.body).append('<div id="ckwaitoverlay"></div>');
	blocs = getBlocks();
	blocs = JSON.stringify(blocs);
	blocs = blocs.replace(/#/g, "|di|");
	bloc = $ck('#body');
	$ck('#popup_editionck').empty().fadeIn();
	var myurl = "index.php?option=com_templateck&view=template&layout=ajaxresponsive&template=templatecreatorck&tmpl=component";
	$ck.ajax({
		type: "POST",
		url: myurl,
		data: {
			blocs: blocs
		}
	}).done(function(code) {
		$ck('#popup_editionck').append(code);
		$ck('#ckwaitoverlay').remove();
		fillEditionPopup('#body');
	}).fail(function() {
		alert(Joomla.JText._('CK_FAILED', 'Failed'));
		$ck('#ckwaitoverlay').remove();
	});
}

function fillEditionPopup(blocid) {
	bloc = $ck(blocid);
	$ck('> .ckprops', bloc).each(function(i, ckprops) {
		ckprops = $ck(ckprops);
		fieldslist = ckprops.attr('fieldslist') ? ckprops.attr('fieldslist').split(',') : Array();
		fieldslist.each(function(fieldname) {
			if (!$ck('#' + fieldname).length)
				return;
			cssvalue = ckprops.attr(fieldname);
			field = $ck('#' + fieldname);
			if (field.attr('type') == 'radio') {
				if (cssvalue == 'checked') {
					field.attr('checked', 'checked');
				} else {
					field.removeAttr('checked');
				}
			} else if (cssvalue) {
				field.attr('value', cssvalue);
				if (field.hasClass('colorPicker') && field.attr('value')) {
					field.css('background-color', field.attr('value'));
					if (field.attr('id').indexOf('backgroundcolorend') != -1) {
						prefix = field.attr('id').replace("backgroundcolorend", "");
						if (prefix && $ck('#blocbackgroundcolorstart').attr('value'))
							createGradientPreview(prefix);
					}
					if (field.attr('id').indexOf('backgroundcolorstart') != -1) {
						prefix = field.attr('id').replace("backgroundcolorstart", "");
						if (prefix && $ck('#blocbackgroundcolorstart').attr('value'))
							createGradientPreview(prefix);
					}
				}
			} else {
				field.attr('value', '');
			}
		});
	});
}

function saveEditionPopup(blocid) {
	var editionarea = $ck('#popup_editionck');
	var focus = blocid ? $ck('#' + blocid) : $ck('.cssfocus');
	$ck('.ckproperty', editionarea).each(function(i, tab) {
		tab = $ck(tab);
		tabid = tab.attr('id');
		(!$ck('> .' + tabid, focus).length) ? createFocusProperty(focus, tabid) : $ck('> .' + tabid, focus).empty();
		focusprop = $ck('> .' + tabid, focus);
		savePopupfields(focusprop, tabid);
		fieldslist = getPopupFieldslist(focusprop, tabid);
		focusprop.attr('fieldslist', fieldslist);
	});
	if (focus.hasClass('bannerlogo'))
		getPreviewlogo(focus);
	toogleWrapperFluid();
	toggleBootstrap();
	getPreviewstylescss(blocid, editionarea);
	editionarea.empty().hide();
}

function getPreviewlogo(focus) {
	var logoimg = $ck('img', focus);
	if ($ck('> .tab_blocstyles', focus).attr('blocheight'))
		logoimg.attr('height', $ck('> .tab_blocstyles', focus).attr('blocheight'));
	if ($ck('> .tab_blocstyles', focus).attr('blocwidth'))
		logoimg.attr('width', $ck('> .tab_blocstyles', focus).attr('blocwidth'));
	if ($ck('> .tab_blocstyles', focus).attr('blocbackgroundimageurl')) {
		focus.css('background', 'none');
		logoimg.attr('src', URIROOT + '/' + $ck('> .tab_blocstyles', focus).attr('blocbackgroundimageurl'));
	}
}

function createFocusProperty(focus, tabid) {
	focus.prepend('<div class="' + tabid + ' ckprops" />')
}

function savePopupfields(focusprop, tabid) {
	$ck('.inputbox', $ck('#' + tabid)).each(function(i, field) {
		field = $ck(field);
		if (field.attr('type') != 'radio') {
			if (field.attr('value') && field.attr('value') != 'default') {
				focusprop.attr(field.attr('id'), field.attr('value'));
			} else {
				focusprop.removeAttr(field.attr('id'));
			}
		} else {
			if (field.attr('checked')) {
				focusprop.attr(field.attr('id'), 'checked');
			} else {
				focusprop.removeAttr(field.attr('id'));
			}
		}
	});
}

function getPopupFieldslist(focusprop, tabid) {
	fieldslist = new Array();
	$ck('.inputbox', $ck('#' + tabid)).each(function(i, el) {
		if ($ck(el).attr('value') && $ck(el).attr('value') != 'default')
			fieldslist.push($ck(el).attr('id'));
	});
	return fieldslist.join(',');
}

function saveResponsivePopup() {
	$ck('.blocresolution').each(function(i, resolution) {
		attribute = $ck(resolution).attr('id');
		$ck('.ckbloc', resolution).each(function(j, responsivebloc) {
			responsivebloc = $ck(responsivebloc);
			responsiveblocid = responsivebloc.attr('ckid');
			$ck('#' + responsiveblocid).attr(attribute, responsivebloc.attr('ckmobile'));
		});
	});
	$ck('#popup_editionck').empty().hide();
}

function getdefaultwidth(nbmodules) {
	defaultwidths = new Array();
	defaultwidth = 100 / parseInt(nbmodules);
	for (i = 0; i < nbmodules; i++) {
		defaultwidths.push(defaultwidth);
	}
	return defaultwidths;
}

function saveModulesPopup() {
	var editionarea = $ck('#popup_editionck');
	var focus = $ck('.cssfocus');
	numberofmodules = $ck('#modulenumberselect').attr('value');
	focus.attr('numberofmodules', numberofmodules);
	var focusfieldslist = new Array();
	$ck('.modulemanagercontainer').each(function(i, modulesrow) {
		modulesrow = $ck(modulesrow);
		nbmodules = modulesrow.attr('nbmodules');
		moduleswidth = new Array();
		$ck('.modulewidthselect', modulesrow).each(function(j, module) {
			module = $ck(module);
			moduleswidth.push(parseFloat(module.attr('value')));
		});
		focus.attr('moduleswidth' + (i + 2), moduleswidth.join(','));
		focus.attr('isdisabledmodule' + (i + 2), modulesrow.hasClass('disabled'));
		focus.find('.flexiblemodule:eq(' + (i + 1) + ')').attr('isdisabled', modulesrow.hasClass('disabled'));

	});

	moduleswidth = focus.attr('moduleswidth' + numberofmodules) ? focus.attr('moduleswidth' + numberofmodules).split(',') : getdefaultwidth(numberofmodules);
	$ck('.flexiblemodule', focus).each(function(i, module) {
		module = $ck(module);
		module.css('width', parseFloat(moduleswidth[i]) + '%');
		focusfieldslist.push('moduleswidth' + (i + 2));
		focusfieldslist.push('isdisabledmodule' + (i + 2));
	});
	focusfieldslist.push('numberofmodules');
	focus.attr('paramslist', focusfieldslist.join(','));
	editionarea.empty().hide();
}

function saveMaincontentPopup() {
	var editionarea = $ck('#popup_editionck');
	var focus = $ck('.cssfocus');
	$ck('.maincontentmanager').each(function(i, module) {
		module = $ck(module);
		var target = module.attr('target');
		focus.attr('isdisabledmodule' + target, module.hasClass('disabled'));
		focus.find('.' + target).attr('isdisabled', module.hasClass('disabled'));
	});
	if ((focus.find('.maintop').attr('isdisabled') == 'true' && focus.find('.mainbottom').attr('isdisabled') == 'true')
			|| focus.find('.column2').attr('isdisabled') == 'true') {
		focus.find('.maincenter').attr('ishidden', 'true');
	} else {
		focus.find('.maincenter').attr('ishidden', 'false');
	}
	if (focus.find('.centertop').attr('isdisabled') == 'true'
			&& focus.find('.centerbottom').attr('isdisabled') == 'true') {
		focus.find('.content').attr('ishidden', 'true');
	} else {
		focus.find('.content').attr('ishidden', 'false');
	}
	if (focus.find('.column2').attr('isdisabled') == 'true') {
		focus.addClass('norightcol');
		focus.find('.center').attr('ishidden', 'true');
	} else {
		focus.removeClass('norightcol');
		focus.find('.center').attr('ishidden', 'false');
	}
	if (focus.find('.column1').attr('isdisabled') == 'true') {
		focus.addClass('noleftcol');
		focus.find('.main').attr('ishidden', 'true');
	} else {
		focus.removeClass('noleftcol');
		focus.find('.main').attr('ishidden', 'false');
	}
	focus.find('.column1').attr('blocwidth', $ck('#blocwidthselectleft').attr('value'));
	focus.find('.column2').attr('blocwidth', $ck('#blocwidthselectright').attr('value'));
	updateColumnsWidth();
	editionarea.empty().hide();
}

function updateColumnsWidth() {
	var focus = $ck('.cssfocus');
	var column1width = focus.find('.column1').attr('blocwidth');
	var mainwidth = focus.find('.column1').attr('isdisabled') == 'true' ? '100%' : (100 - parseFloat(column1width)) + '%';
	var column2width = focus.find('.column2').attr('blocwidth');
	var centerwidth = focus.find('.column2').attr('isdisabled') == 'true' ? '100%' : (100 - parseFloat(column2width)) + '%';
	focus.find('.column1').css('width', column1width);
	focus.find('.main').css('width', mainwidth);
	focus.find('.column2').css('width', column2width);
	focus.find('.center').css('width', centerwidth);
}

function getPreviewstylescss(blocid, editionarea) {
	if (!editionarea)
		editionarea = document.body;
	var focus = blocid ? $ck('#' + blocid) : $ck('.cssfocus');
	var fieldslist = new Array();
	$ck('.inputbox', editionarea).each(function(i, el) {
		if ($ck(el).attr('value'))
			fieldslist.push($ck(el).attr('id'));
	});
	fields = new Object();
	$ck('> .ckprops', focus).each(function(i, ckprops) {
		ckprops = $ck(ckprops);
		fieldslist = ckprops.attr('fieldslist') ? ckprops.attr('fieldslist').split(',') : Array();
		fieldslist.each(function(fieldname) {
			fields[fieldname] = ckprops.attr(fieldname);
		});
	});
	fields = JSON.stringify(fields);
	var myurl = "index.php?option=com_templateck&view=template&layout=ajaxrendercss&template=templatecreatorck&tmpl=component";
	$ck.ajax({
		type: "POST",
		url: myurl,
		data: {
			objclass: focus.prop('class'),
			objid: focus.prop('id'),
			action: 'preview',
			fields: fields
		}
	}).done(function(code) {
		$ck('> .ckstyle', focus).empty().append(code);
	}).fail(function() {
		alert(Joomla.JText._('CK_FAILED', 'Failed'));
	});
}

function loadTab_menustyles() {
	bloc = $ck('#tab_menustyles');
	if (bloc.html())
		return;
	var myurl = "index.php?option=com_templateck&view=template&layout=ajaxtabmenustyles&template=templatecreatorck&tmpl=component";
	$ck.ajax({
		type: "POST",
		url: myurl,
		data: {
			objclass: bloc.prop('class'),
			objid: bloc.prop('id')
		}
	}).done(function(code) {
		bloc.empty().append(code);
		fillEditionPopup('#' + $ck('.cssfocus').attr('id'));
	}).fail(function() {
		alert(Joomla.JText._('CK_FAILED', 'Failed'));
	});
}

/* ----------------------------------------------------------------------------------------------------------------------------------------
 TEMPLATE CREATION AND PREVIEW
 ---------------------------------------------------------------------------------------------------------------------------------------------*/

function getBlocks() {
	var blocs = new Array();
	var cssblocs = new Object();
	var i = 0;
	$ck('.ckbloc').each(function(j, bloc) {
		bloc = $ck(bloc);
		if (bloc.attr('isdisabled') != 'true') {
			var cssblocs = new Object();
			var fieldslist = new Array();
			cssblocs['class'] = bloc.attr('class');
			cssblocs['ckid'] = bloc.attr('id');
			if (bloc.attr('id') == "body" || bloc.attr('id') == "wrapper")
				cssblocs['ckid'] = bloc.attr('id');
			cssblocs['ckclass'] = bloc.attr('ckclass');
			cssblocs['ckmoduleposition'] = bloc.attr('ckmoduleposition');
			cssblocs['ckmodulestyle'] = bloc.attr('ckmodulestyle');
			cssblocs['ckresponsive1'] = bloc.attr('ckresponsive1');
			cssblocs['ckresponsive2'] = bloc.attr('ckresponsive2');
			cssblocs['ckresponsive3'] = bloc.attr('ckresponsive3');
			cssblocs['ckresponsive4'] = bloc.attr('ckresponsive4');
			cssblocs['isdisabled'] = bloc.attr('isdisabled');
			cssblocs['ishidden'] = bloc.attr('ishidden');
			if (bloc.attr('fieldslist'))
				fieldslist = bloc.attr('fieldslist').split(",");
			paramslist = bloc.attr('paramslist') ? bloc.attr('paramslist').split(",") : Array();
			$ck('> .ckprops', bloc).each(function(i, ckprops) {
				ckprops = $ck(ckprops);
				fieldslist = ckprops.attr('fieldslist') ? ckprops.attr('fieldslist').split(',') : Array();
				fieldslist.each(function(fieldname) {
					cssblocs[fieldname] = ckprops.attr(fieldname);
				});
			});
			paramslist.each(function(fieldname) {
				cssblocs[fieldname] = bloc.attr(fieldname);
			});
			blocs[i] = cssblocs;
			i++;
		}
	});

	return blocs;
}


/**
 *
 * Function create htmlcode and folder structure and begin the process
 */
function makeHtmlStep(task) {
	blocs = getBlocks();
	blocs = JSON.stringify(blocs);
	blocs = blocs.replace(/#/g, "|di|");
	var htmlcode = makeHtmlOutput();

	var myurl = "index.php?option=com_templateck&view=template&layout=ajaxindex&template=templatecreatorck&tmpl=component";
	$ck.ajax({
		type: "POST",
		url: myurl,
		data: {
			bodycode: htmlcode["body"],
			headcode: htmlcode["head"],
			joomlaversion: $ck('#joomlaversion').attr('value'),
			templatename: $ck('#name').attr('value'),
			creationdate: $ck('#creationDate').attr('value'),
			author: $ck('#author').attr('value'),
			authorEmail: $ck('#authorEmail').attr('value'),
			authorUrl: $ck('#authorUrl').attr('value'),
			copyright: $ck('#copyright').attr('value'),
			license: $ck('#license').attr('value'),
			version: $ck('#version').attr('value'),
			description: $ck('#description').attr('value'),
			blocs: blocs,
			makearchive: task
		}
	}).done(function(code) {
		$ck('#packagestep1').empty().append(code);
		$ck('#packagestep1').append(Joomla.JText._('CK_LOAD_SUCCESS_STEP1', 'Step 1 finished with success'));
		makeCssStep(task);
	}).fail(function() {
		$ck('#packagestep1').empty();
		$ck('#packagestep1').append(Joomla.JText._('CK_LOAD_FAILURE_STEP1', 'Step 1 encounter some errors'));
	});
}

/**
 *
 * Function to generate template.css file
 */
function makeCssStep(task) {
	blocs = getBlocks();
	blocs = JSON.stringify(blocs);
	blocs = blocs.replace(/#/g, "|di|");

	var myurl = "index.php?option=com_templateck&view=template&layout=ajaxtemplatecss&template=templatecreatorck&tmpl=component";
	$ck.ajax({
		type: "POST",
		url: myurl,
		data: {
			templatename: $ck('#name').attr('value'),
			joomlaversion: $ck('#joomlaversion').attr('value'),
			column1width: COLUMN1WIDTH,
			column2width: COLUMN2WIDTH,
			blocs: blocs,
			templateid: TEMPLATEID
		}
	}).done(function(code) {
		$ck('#packagestepcss').empty().append(code);
		$ck('#packagestepcss').append(Joomla.JText._('CK_LOAD_SUCCESS_STEP_CSS', 'Next step finished with success'));
		makeXmlStep(task);
	}).fail(function() {
		$ck('#packagestepcss').empty();
		$ck('#packagestepcss').append(Joomla.JText._('CK_LOAD_FAILURE_STEP_CSS', 'Next step encounter some errors'));
	});
}

/**
 *
 * Function to generate XML file
 */
function makeXmlStep(task) {
	var positions = [];
	$ck('.ckbloc').each(function(i, bloc) {
		bloc = $ck(bloc);
		if (bloc.attr('ckmoduleposition') && bloc.attr('isdisabled') != 'true')
			positions.push(bloc.attr('ckmoduleposition'));
	});

	var myurl = "index.php?option=com_templateck&view=template&layout=ajaxxml&template=templatecreatorck&tmpl=component";
	$ck.ajax({
		type: "POST",
		url: myurl,
		data: {
			templatename: $ck('#name').attr('value'),
			joomlaversion: $ck('#joomlaversion').attr('value'),
			creationdate: $ck('#creationDate').attr('value'),
			author: $ck('#author').attr('value'),
			authorEmail: $ck('#authorEmail').attr('value'),
			authorUrl: $ck('#authorUrl').attr('value'),
			copyright: $ck('#copyright').attr('value'),
			license: $ck('#license').attr('value'),
			version: $ck('#version').attr('value'),
			description: $ck('#description').attr('value'),
			positions: positions
		}
	}).done(function(code) {
		$ck('#packagestepxml').empty().append(code);
		$ck('#packagestepxml').append(Joomla.JText._('CK_LOAD_SUCCESS_STEP_XML', 'Next step finished with success'));
		if (task == 'package' || task == 'copy') {
			makeArchiveStep(task);
		} else {
			makePreviewStep();
		}
	}).fail(function() {
		$ck('#packagestepxml').empty();
		$ck('#packagestepxml').append(Joomla.JText._('CK_LOAD_FAILURE_STEP_XML', 'Next step encounter some errors'));
	});

}

/**
 *
 * Function to generate the preview button
 */

function makePreviewStep() {
	var myurl = "index.php?option=com_content&templatename=" + $ck('#name').attr('value') + "&template=templatecreatorck&tmpl=preview";
	var previewlink = '<p styles="padding:15px"><a class="ckpreview ckbuttonstyle" href="' + myurl + '" target="_blank">' + Joomla.JText._('CK_PREVIEW_TEMPLATE', 'Preview the template') + '</a></p>';
	$ck('.packagesteparchive').append(previewlink);
}

/**
 *
 * Function to generate the ZIP archive
 */

function makeArchiveStep(task) {
	var myurl = "index.php?option=com_templateck&view=template&layout=ajaxarchive&template=templatecreatorck&tmpl=component";
	$ck.ajax({
		type: "POST",
		url: myurl,
		data: {
			templatename: $ck('#name').attr('value'),
			saveintemplate: task
		}
	}).done(function(code) {
		$ck('.packagesteparchive').empty().append(code);
	}).fail(function() {
		$ck('.packagesteparchive').empty();
		$ck('.packagesteparchive').append(Joomla.JText._('CK_LOAD_FAILURE_STEP_ARCHIVE', 'Archive encounter some errors'));
	});
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
	iW = 0; // index for wrappers
	$ck('.ckbloc').each(function(i, bloc) {
		bloc = $ck(bloc);
		var retrievecode = '';
		// retrieve id for the block
		var blocid = '';
		if (bloc.attr("id")) {
			blocid = ' id="' + bloc.attr("id") + '"';
		}

		// retrieve id for the block
		var blocmoduleposition = '';
		if (bloc.attr("ckmoduleposition")) {
			blocmoduleposition = bloc.attr("ckmoduleposition");
		}

		// retrieve class for the bloc
		var blocclass = '';
		if (bloc.attr("ckclass")) {
			blocclass = ' class="' + bloc.attr("ckclass") + '"';
		} else {
			blocclass = '';
		}

		// retrieve style for the module
		var blocmodulestyle = ' style="xhtml"';
		if (bloc.attr("ckmodulestyle")) {
			blocmodulestyle = ' style="' + bloc.attr("ckmodulestyle") + '"';
		}

		// Begin the modules code construction
		// construct single module code
		if (bloc.hasClass('singlemodule')) {
			retrievecode = makeHtmlSingleModule(bloc, blocmoduleposition, blocid, blocclass, blocmodulestyle);
			code["body"] += retrievecode["body"];
		}

		// construct flexible module code
		if (bloc.hasClass('flexiblemodules')) {
			retrievecode = makeHtmlFlexibleModules(bloc, blocid, blocclass, j);
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
			customcode = $ck('div.customcont', bloc).html().replace(/#/g, "|di|");
			code["body"] += '|tab|<div' + blocid + blocclass + '>|rr|'
					+ '|tab||tab|<div class="inner">' + customcode + '</div>|rr|'
					+ '|tab|</div>|rr|';
		}

		// construct simple 3 cols component layout code
		if (bloc.hasClass('wrapper')) {
			retrievecode = makeWrapper(bloc, blocid, blocclass, iW);
			code["body"] += retrievecode["body"];
			code["head"] += retrievecode["head"];
			iW++;
		}

		// construct complex component layout code
		if (bloc.hasClass('maincontent')) {
			retrievecode = makeHtmlMaincontent(bloc, blocid, blocclass, blocmodulestyle, j);
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
 * Function to render a wrapper
 *
 */
function makeWrapper(bloc, blocid, blocclass, iW) {
	var code = new Array("head", "body");
	code["head"] = '';
	code["body"] = '';
	if (iW == 0) {
		code["body"] = '<div' + blocid + blocclass + '>|rr|'
				+ '|tab|<div class="' + $ck('.inner', bloc).attr('class') + '">|rr|';
	} else {
		code["body"] = '|tab|</div>|rr|'
				+ '</div>|rr|'
				+ '<div' + blocid + blocclass + '>|rr|'
				+ '|tab|<div class="' + $ck('.inner', bloc).attr('class') + '">|rr|';

	}
	return code;
}

/**
 * Function to render a single module
 *
 */
function makeHtmlSingleModule(bloc, blocmoduleposition, blocid, blocclass, blocmodulestyle) {
	var code = new Array("head", "body");
	code["head"] = '';
	code["body"] = '';

	code["body"] = '|tab|<?php if ($this->countModules(\'' + blocmoduleposition + '\')) : ?>|rr|'
			+ '|tab|<div' + blocid + blocclass + '>|rr|'
			+ '|tab||tab|<div class="inner clearfix">|rr|'
			+ '|tab||tab||tab|<jdoc:include type="modules" name="' + blocmoduleposition + '"' + blocmodulestyle + ' />|rr|'
			+ '|tab||tab|</div>|rr|'
			+ '|tab|</div>|rr|'
			+ '|tab|<?php endif; ?>|rr||rr|';
	return code;
}


/**
 * Function to render some flexible modules
 *
 */
function makeHtmlFlexibleModules(bloc, blocid, blocclass, j) {
	// initialisation
	bloc = $ck(bloc);
	var code = new Array("head", "body");
	code["head"] = '';
	code["body"] = '';

	code["body"] += '|tab|<?php if ($nbmodules' + j + ') : ?>|rr|'
			+ '|tab|<div' + blocid + blocclass + '>|rr|'
			+ '|tab||tab|<div class="inner clearfix <?php echo \'n\'.$nbmodules' + j + ' ?>">|rr|';

	code["head"] += '<?php|rr|'
			+ '$nbmodules' + j + ' = ';

	$ck('.flexiblemodule', bloc).each(function(i, module) {
		module = $ck(module);
		if (module.attr('isdisabled') != 'true') {
			if (i > 0)
				code["head"] += ' + ';
			// retrieve data for the block
			module.ckid = module.attr("id") ? ' id="' + module.attr("id") + '"' : '';
			module.classe = module.attr("ckclass") ? module.attr("ckclass") : '';
			module.jdocstyle = module.attr("ckmodulestyle") ? ' style="' + module.attr("ckmodulestyle") + '"' : ' style="xhtml"';
			module.jdocposition = module.attr("ckmoduleposition") ? module.attr("ckmoduleposition") : '';

			code["body"] += '|tab||tab||tab|<?php if ($this->countModules(\'' + module.jdocposition + '\')) : ?>|rr|'
					+ '|tab||tab||tab|<div' + module.ckid + ' class="flexiblemodule ' + module.classe + '">|rr|'
					+ '|tab||tab||tab||tab|<div class="inner clearfix">|rr|'
					+ '|tab||tab||tab||tab||tab|<jdoc:include type="modules" name="' + module.jdocposition + '"' + module.jdocstyle + ' />|rr|'
					+ '|tab||tab||tab||tab|</div>|rr|'
					+ '|tab||tab||tab|</div>|rr|'
					+ '|tab||tab||tab|<?php endif; ?>|rr|';

			code["head"] += '(bool)$this->countModules(\'' + module.jdocposition + '\')';
		}
	});
	code["body"] += '|tab||tab||tab|<div class="clr"></div>|rr|'
			+ '|tab||tab|</div>|rr|'
			+ '|tab|</div>|rr|'
			+ '|tab|<?php endif; ?>|rr||rr|';

	code["head"] += ';|rr|'
			+ '?>|rr||rr|';

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

	code["body"] += '|tab|<div' + blocid + blocclass + '>|rr|'
			+ '|tab||tab|<div class="inner clearfix">|rr|';

	$ck('.ckbloc', bloc).each(function(i, module) {
		module = $ck(module);
		// retrieve data for the block
		module.ckid = module.attr("id") ? ' id="' + module.attr("id") + '"' : '';
		module.classe = module.attr("ckclass") ? ' class="' + module.attr("ckclass") + '"' : ' class="logobloc"';
		module.jdocstyle = module.attr("ckmodulestyle") ? ' style="' + module.attr("ckmodulestyle") + '"' : ' style="xhtml"';
		module.jdocposition = module.attr("ckmoduleposition") ? module.attr("ckmoduleposition") : '';

		if (module.hasClass('bannerlogo')) {
			module.logoimage = $ck('img', module) ? $ck('img', module).attr('src').split("/").reverse()[0] : '';
			module.logowidth = $ck('.tab_blocstyles', module).attr("blocwidth") ? ' width="' + $ck('.tab_blocstyles', module).attr("blocwidth") + 'px"' : '';
			module.logoheight = $ck('.tab_blocstyles', module).attr("blocheight") ? ' height="' + $ck('.tab_blocstyles', module).attr("blocheight") + 'px"' : '';

			logodesc = $ck('> .inner > .bannerlogodesc', module);
			logodesccode = '';
			if (logodesc.length) {
				logodesccode = '|tab||tab||tab||tab||tab|<?php if ($this->params->get(\'logodescription\')) { ?>|rr|'
						+ '|tab||tab||tab||tab||tab|<div class="bannerlogodesc">|rr|'
						+ '|tab||tab||tab||tab||tab||tab|<div class="inner clearfix"><?php echo htmlspecialchars($this->params->get(\'logodescription\'));?></div>|rr|'
						+ '|tab||tab||tab||tab||tab|</div>|rr|'
						+ '|tab||tab||tab||tab||tab|<?php } ?>|rr|';
			}

			code["body"] += '|tab||tab||tab|<div' + module.ckid + module.classe + '>|rr|'
					+ '|tab||tab||tab||tab|<div class="inner clearfix">|rr|'
					+ '|tab||tab||tab||tab||tab|<?php if ($this->params->get(\'logolink\')) { ?>|rr|'
					+ '|tab||tab||tab||tab||tab|<a href="<?php echo htmlspecialchars($this->params->get(\'logolink\')); ?>">|rr|'
					+ '|tab||tab||tab||tab||tab|<?php } ?>|rr|'
					+ '|tab||tab||tab||tab||tab||tab|<img src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/images/' + module.logoimage + '"' + module.logowidth + module.logoheight + ' alt="<?php echo htmlspecialchars($this->params->get(\'logotitle\'));?>" />|rr|'
					+ '|tab||tab||tab||tab||tab|<?php if ($this->params->get(\'logolink\')) { ?>|rr|'
					+ '|tab||tab||tab||tab||tab|</a>|rr|'
					+ '|tab||tab||tab||tab||tab|<?php } ?>|rr|'
					+ logodesccode
					+ '|tab||tab||tab||tab|</div>|rr|'
					+ '|tab||tab||tab|</div>|rr|';


		} else if (!module.hasClass('bannerlogodesc')) {
			code["body"] += '|tab||tab||tab|<?php if ($this->countModules(\'' + module.jdocposition + '\')) : ?>|rr|'
					+ '|tab||tab||tab|<div' + module.ckid + module.classe + '>|rr|'
					+ '|tab||tab||tab||tab|<div class="inner clearfix">|rr|'
					+ '|tab||tab||tab||tab||tab|<jdoc:include type="modules" name="' + module.jdocposition + '"' + module.jdocstyle + ' />|rr|'
					+ '|tab||tab||tab||tab|</div>|rr|'
					+ '|tab||tab||tab|</div>|rr|'
					+ '|tab||tab||tab|<?php endif; ?>|rr|';
		}

	});
	code["body"] += '|tab||tab|</div>|rr|'
			+ '|tab|</div>|rr|';

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

	code["body"] = '|tab|<?php if ($this->countModules(\'' + blocmoduleposition + '\')) : ?>|rr|'
			+ '|tab|<div' + blocid + blocclass + '>|rr|'
			+ '|tab||tab|<div class="inner clearfix">|rr|'
			+ '|tab||tab||tab|<jdoc:include type="modules" name="' + blocmoduleposition + '" />|rr|'
			+ '|tab||tab|</div>|rr|'
			+ '|tab|</div>|rr|'
			+ '|tab|<?php endif; ?>|rr||rr|';
	return code;
}

/*
 * Function to render a complex component layout
 *
 */

function makeHtmlMaincontent(bloc, blocid, blocclass, j) {
	var code = new Array("head", "body");
	code["head"] = '';
	code["body"] = '';

	column1width = 0;
	column2width = 0;

	// begin the global container
	code["body"] += '|tab|<div' + blocid + blocclass + '>|rr|'
			+ '|tab||tab|<div class="inner clearfix">|rr|';
	column1enabled = 1;
	column1 = '';
	column2enabled = 1;
	column2 = '';
	$ck('.ckbloc', bloc).each(function(i, column) {
		column = $ck(column);

		column.ckid = column.attr("id") ? ' id="' + column.attr("id") + '"' : '';
		column.classe = column.attr("ckclass") ? column.attr("ckclass") : '';
		column.jdocstyle = column.attr("ckmodulestyle") ? ' style="' + column.attr("ckmodulestyle") + '"' : ' style="xhtml"';
		column.jdocposition = column.attr("ckmoduleposition") ? column.attr("ckmoduleposition") : '';

		// if the first big column
		if (column.hasClass('column1') && column.attr('isdisabled') != "true") {
			column1 = column.jdocposition;
			column1width = column.attr('blocwidth') ? column.attr('blocwidth') : '200';
			code["body"] += '|tab||tab|<?php if ($this->countModules(\'' + column1 + '\')) : ?>|rr|'
					+ '|tab||tab||tab|<div' + column.ckid + ' class="column column1' + column.classe + '">|rr|'
					+ '|tab||tab||tab||tab|<div class="inner clearfix">|rr|'
					+ '|tab||tab||tab||tab||tab|<jdoc:include type="modules" name="' + column1 + '"' + column.jdocstyle + ' />|rr|'
					+ '|tab||tab||tab||tab|</div>|rr|'
					+ '|tab||tab||tab|</div>|rr|'
					+ '|tab||tab||tab|<?php endif; ?>|rr|';
		} else if (column.hasClass('column1') && column.attr('isdisabled') == "true") {
			column1enabled = 0;
		}


		// if the main container column - look into to search for other blocks
		if (column.hasClass('main')) {
			if (column.attr('ishidden') != "true")
				code["body"] += '|tab||tab||tab|<div' + column.ckid + ' class="column main <?php echo $mainclass ?> ' + column.classe + '">|rr|'
						+ '|tab||tab||tab||tab|<div class="inner clearfix">|rr|';

			// look for sub columns
			$ck('.ckbloc', column).each(function(h, subcolumn) {
				subcolumn = $ck(subcolumn);

				subcolumn.ckid = subcolumn.attr("id") ? ' id="' + subcolumn.attr("id") + '"' : '';
				subcolumn.classe = subcolumn.attr("ckclass") ? subcolumn.attr("ckclass") : '';
				subcolumn.jdocstyle = subcolumn.attr("ckmodulestyle") ? ' style="' + subcolumn.attr("ckmodulestyle") + '"' : ' style="xhtml"';
				subcolumn.jdocposition = subcolumn.attr("ckmoduleposition") ? subcolumn.attr("ckmoduleposition") : '';

				if ((subcolumn.hasClass('maintop') || subcolumn.hasClass('mainbottom')) && subcolumn.attr('isdisabled') != "true") {
					subcolumn.classe = (subcolumn.classe) ? 'class="' + subcolumn.classe + '"' : '';
					code["body"] += '|tab||tab||tab||tab||tab|<?php if ($this->countModules(\'' + subcolumn.jdocposition + '\')) : ?>|rr|'
							+ '|tab||tab||tab||tab||tab|<div' + subcolumn.ckid + subcolumn.classe + '>|rr|'
							+ '|tab||tab||tab||tab||tab||tab|<div class="inner clearfix">|rr|'
							+ '|tab||tab||tab||tab||tab||tab||tab|<jdoc:include type="modules" name="' + subcolumn.jdocposition + '"' + subcolumn.jdocstyle + ' />|rr|'
							+ '|tab||tab||tab||tab||tab||tab|</div>|rr|'
							+ '|tab||tab||tab||tab||tab|</div>|rr|'
							+ '|tab||tab||tab||tab||tab|<?php endif; ?>|rr|';
				}

				if (subcolumn.hasClass('maincenter')) {
					// begin the center container
					if (subcolumn.attr('ishidden') != "true")
						code["body"] += '|tab||tab||tab||tab||tab|<div' + subcolumn.ckid + ' class="maincenter ' + column.classe + '">|rr|'
								+ '|tab||tab||tab||tab||tab||tab|<div class="inner clearfix">|rr|';

					$ck('.ckbloc', subcolumn).each(function(g, centercolumn) {
						centercolumn = $ck(centercolumn);

						centercolumn.ckid = centercolumn.attr("id") ? ' id="' + centercolumn.attr("id") + '"' : '';
						centercolumn.classe = centercolumn.attr("ckclass") ? centercolumn.attr("ckclass") : '';
						centercolumn.jdocstyle = centercolumn.attr("ckmodulestyle") ? ' style="' + centercolumn.attr("ckmodulestyle") + '"' : ' style="xhtml"';
						centercolumn.jdocposition = centercolumn.attr("ckmoduleposition") ? centercolumn.attr("ckmoduleposition") : '';

						if (centercolumn.hasClass('column2') && centercolumn.attr('isdisabled') != "true") {
							column2 = centercolumn.jdocposition;
							column2width = centercolumn.attr('blocwidth') ? centercolumn.attr('blocwidth') : '200';
							code["body"] += '|tab||tab||tab||tab||tab||tab||tab|<?php if ($this->countModules(\'' + column2 + '\')) : ?>|rr|'
									+ '|tab||tab||tab||tab||tab||tab||tab|<div' + centercolumn.ckid + ' class="column column2' + centercolumn.classe + '">|rr|'
									+ '|tab||tab||tab||tab||tab||tab||tab||tab|<div class="inner clearfix">|rr|'
									+ '|tab||tab||tab||tab||tab||tab||tab||tab||tab|<jdoc:include type="modules" name="' + column2 + '"' + centercolumn.jdocstyle + ' />|rr|'
									+ '|tab||tab||tab||tab||tab||tab||tab||tab|</div>|rr|'
									+ '|tab||tab||tab||tab||tab||tab||tab|</div>|rr|'
									+ '|tab||tab||tab||tab||tab||tab||tab|<?php endif; ?>|rr|';
						} else if (centercolumn.hasClass('column2') && centercolumn.attr('isdisabled') == "true") {
							column2enabled = 0;
						}

						if (centercolumn.hasClass('center')) {
							if (centercolumn.attr('ishidden') != "true")
								code["body"] += '|tab||tab||tab||tab||tab||tab||tab|<div' + centercolumn.ckid + ' class="column center ' + centercolumn.classe + '">|rr|'
										+ '|tab||tab||tab||tab||tab||tab||tab||tab|<div class="inner">|rr|';

							// look for sub blocks
							$ck('.ckbloc', centercolumn).each(function(f, centerbloc) {
								centerbloc = $ck(centerbloc);

								centerbloc.ckid = centerbloc.attr("id") ? ' id="' + centerbloc.attr("id") + '"' : '';
								centerbloc.classe = centerbloc.attr("ckclass") ? centerbloc.attr("ckclass") : '';
								centerbloc.jdocstyle = centerbloc.attr("ckmodulestyle") ? ' style="' + centerbloc.attr("ckmodulestyle") + '"' : ' style="xhtml"';
								centerbloc.jdocposition = centerbloc.attr("ckmoduleposition") ? centerbloc.attr("ckmoduleposition") : '';

								if ((centerbloc.hasClass('centertop') || centerbloc.hasClass('centerbottom')) && centerbloc.attr('isdisabled') != "true") {
									code["body"] += '|tab||tab||tab||tab||tab||tab||tab||tab||tab|<?php if ($this->countModules(\'' + centerbloc.jdocposition + '\')) : ?>|rr|'
											+ '|tab||tab||tab||tab||tab||tab||tab||tab||tab|<div' + centerbloc.ckid + ' class="' + centerbloc.classe + '">|rr|'
											+ '|tab||tab||tab||tab||tab||tab||tab||tab||tab||tab|<div class="inner clearfix">|rr|'
											+ '|tab||tab||tab||tab||tab||tab||tab||tab||tab||tab||tab|<jdoc:include type="modules" name="' + centerbloc.jdocposition + '"' + centerbloc.jdocstyle + ' />|rr|'
											+ '|tab||tab||tab||tab||tab||tab||tab||tab||tab||tab|</div>|rr|'
											+ '|tab||tab||tab||tab||tab||tab||tab||tab||tab|</div>|rr|'
											+ '|tab||tab||tab||tab||tab||tab||tab||tab||tab|<?php endif; ?>|rr|';
								}

								if (centerbloc.hasClass('content')) {
									if (centerbloc.attr('ishidden') != "true")
										code["body"] += '|tab||tab||tab||tab||tab||tab||tab||tab||tab|<div' + centerbloc.ckid + ' class="' + centerbloc.classe + '">|rr|'
												+ '|tab||tab||tab||tab||tab||tab||tab||tab||tab||tab|<div class="inner clearfix">|rr|';

									code["body"] += '|tab||tab||tab||tab||tab||tab||tab||tab||tab||tab||tab|<jdoc:include type="message" />|rr|'
											+ '|tab||tab||tab||tab||tab||tab||tab||tab||tab||tab||tab|<jdoc:include type="component" />|rr|';


									if (centerbloc.attr('ishidden') != "true")
										code["body"] += '|tab||tab||tab||tab||tab||tab||tab||tab||tab||tab|</div>|rr|'
									+'|tab||tab||tab||tab||tab||tab||tab||tab||tab|</div>|rr|';

								}
							});

							if (centercolumn.attr('ishidden') != "true")
								code["body"] += '|tab||tab||tab||tab||tab||tab||tab||tab|</div>|rr|'
										+ '|tab||tab||tab||tab||tab||tab||tab|</div>|rr|';

						}
					});

					// close the center container
					if (subcolumn.attr('ishidden') != "true")
						code["body"] += '|tab||tab||tab||tab||tab||tab||tab|<div class="clr"></div>|rr|'
								+ '|tab||tab||tab||tab||tab||tab|</div>|rr|'
								+ '|tab||tab||tab||tab||tab|</div>|rr|';
				}

			});

			// close main container column
			if (column.attr('ishidden') != "true")
				code["body"] += '|rr|'
						+ '|tab||tab||tab||tab|</div>|rr|'
						+ '|tab||tab||tab|</div>|rr|';
		}
	});


	// end floating and close the global container
	code["body"] += '|tab||tab||tab|<div class="clr"></div>|rr|'
			+ '|tab||tab|</div>|rr|'
			+ '|tab|</div>|rr|';

	code["head"] += '<?php|rr|'
			+ '$mainclass = "";|rr|';
	if (column1enabled == 1) {
		code["head"] += 'if (!$this->countModules(\'' + column1 + '\')) { $mainclass .= " noleft";}|rr|';
	} else {
		code["head"] += '$mainclass .= " noleft";|rr|';
	}
	if (column2enabled == 1) {
		code["head"] += 'if (!$this->countModules(\'' + column2 + '\')) { $mainclass .= " noright";}|rr|';
	} else {
		code["head"] += '$mainclass .= " noright";|rr|';
	}
	code["head"] += '$mainclass = trim($mainclass); ?>|rr||rr|';

	window['COLUMN1WIDTH'] = column1width;
	window['COLUMN2WIDTH'] = column2width;

	return code;
}