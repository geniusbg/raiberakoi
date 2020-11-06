/**
 * copyright	Copyright (C) 2010 Cedric KEIFLIN alias ced1870 & Ghazal
 * http://www.joomlack.fr
 * license		GNU/GPL
 * Tooltipgc version 3
**/


var tooltipClass = new Class({
	Implements: Options,
					
	options: {  
		largeur : '150',
		opacite : 0.8,
		dureemootools : 300,
		mootransition: 'linear',
		offsetx: '0',
		offsety: '0',
		dureebulle : 500
	},
	
	initialize: function(els,options) {
		this.setOptions(options); //enregistre les options utilisateur
		var dureemootools = this.options.dureemootools;
		var dureebulle = this.options.dureebulle;
		var opacite = parseFloat(this.options.opacite);
		var matransition = this.options.mootransition;
		var offsetx = this.options.offsetx;
		var offsety = this.options.offsety;

		els.each(function(el) {
			el.tooltip = el.getElement('span.tooltipgc_tooltip');
			
			el.opacite = opacite;
			el.matransition = matransition;
			el.dureemootools = dureemootools;
			el.dureebulle = dureebulle;
			el.offsetx = offsetx;
			el.offsety = offsety;
			
			el.getParamsTooltipgc();
			
			if (el.tooltip.clientWidth != 0) el.tooltipwidth = el.tooltip.clientWidth;
			el.tooltipheight = el.tooltip.clientHeight;
			
			el.createFxTooltipgc();
				
			el.addEvent('mouseover',function() {	
				this.showTooltipgc();
			});
				
			el.addEvent('mouseleave',function() {
				this.hideTooltipgc(el.dureebulle); 						
			});
		});

	}
});

tooltipClass.implement(new Options);

	Element.implement({
		getParamsTooltipgc: function() {
			
			this.offsety = parseInt(this.tooltip.getStyle('margin-top').replace("px",""));
			el = this;
			if (this.getProperty('rel')) {
				var params = this.getProperty('rel').split('|');
				params.each( function(param) {
					if (param.indexOf('w=') != -1) largeur = param.replace("w=", "");
					if (param.indexOf('mood=') != -1) el.dureemootools = param.replace("mood=", "");
					if (param.indexOf('tipd=') != -1) el.dureebulle = param.replace("tipd=", "");
					if (param.indexOf('offsetx=') != -1) el.offsetx = parseInt(param.replace("offsetx=", ""));
					if (param.indexOf('offsety=') != -1) el.offsety = parseInt(param.replace("offsety=", ""));
				});
			}

			if (el.offsetx) el.tooltip.setStyle('margin-left', el.offsetx);	
			
		},
	
		createFxTooltipgc: function(dureemootools) {
			// cree les fonctions mootools
			this.FxTooltipgc = new Fx.Tween(this.tooltip, {property:'width', transition: this.matransition, duration:this.dureemootools, wait : false});
			this.offsetTooltipgc = new Fx.Tween(this.tooltip, {property:'margin-top', transition: this.matransition, duration:this.dureemootools, wait : false});
			this.opacityTooltipgc = new Fx.Tween(this.tooltip, {property:'opacity', transition: this.matransition, duration:this.dureemootools, wait : false});
			
			// fixe les valeurs par defaut
				this.FxTooltipgc.set(0);
				this.opacityTooltipgc.set(0);
			this.tooltip.setStyle('left','-999em');
			this.tooltip.setStyle('margin-top',-this.tooltipheight);
			
			
			animComp = function(){
					if (this.status == 'hide')
					{
						this.tooltip.setStyle('left', '-999em');
						this.hidding = 0;
					}
					this.showing = 0;
					this.tooltip.setStyle('overflow', '');				
					
				}
			this.opacityTooltipgc.addEvent ('onComplete', animComp.bind(this));
		},
		
		showTooltipgc: function() {
			this.status = 'show';
			this.addClass('sfhover');
			this.animTooltipgc();
		},
		
		removeClassTooltipgc: function() {
			this.removeClass('sfhover');
			this.animTooltipgc();
		},
		
		hideTooltipgc: function(timeout) {
			this.status = 'hide';
			
			clearTimeout (this.timeout);
			if (timeout) {	
				this.timeout = setTimeout (this.removeClassTooltipgc.bind(this), timeout);
			}else{
				this.removeClass('sfhover');
			}
		},
		
		animTooltipgc: function() {
			if ((this.status == 'hide' && this.tooltip.style.left != 'auto') || (this.status == 'show' && this.tooltip.style.left == 'auto' && !this.hidding) ) return;
					
				this.tooltip.setStyle('overflow', 'hidden');
				if (this.status == 'show') {
					this.hidding = 0;
				}
				if (this.status == 'hide')
				{
					this.hidding = 1;
					this.showing = 0;
						this.FxTooltipgc.cancel();
						this.opacityTooltipgc.start(0);


				} else {
					
					this.showing = 1;
					this.tooltip.setStyle('left', 'auto');
						this.FxTooltipgc.cancel();
						this.FxTooltipgc.start(0,this.tooltipwidth);
						this.opacityTooltipgc.start(0,this.opacite);
						this.offsetTooltipgc.start(this.offsety,-this.tooltipheight+this.offsety);
				}
		}
		
	});
	
	

