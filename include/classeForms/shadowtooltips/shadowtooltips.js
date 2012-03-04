// JavaScript Document.
// cette classe d'objet est sympatique parce que elle est maintenant en objet

function showTooltip_init() {
	this.dhtmlgoodies_tooltip = false;
	this.dhtmlgoodies_tooltipShadow = false;
	this.dhtmlgoodies_shadowSize = 4;
	this.dhtmlgoodies_tooltipMaxWidth = 200;
	this.dhtmlgoodies_tooltipMinWidth = 100;
	this.dhtmlgoodies_iframe = false;
	this.tooltip_is_msie = (navigator.userAgent.indexOf('MSIE')>=0 && navigator.userAgent.indexOf('opera')==-1 && document.all)?true:false;
	this.tt_style        = 'shadowtooltips_tooltip';
	this.tt_style_shadow = 'shadowtooltips_tooltipShadow';
}

showTooltip_init.prototype.showTooltip = function (e,tooltipTxt) {
		
		var bodyWidth = Math.max(document.body.clientWidth,document.documentElement.clientWidth) - 20;
	
		if(!this.dhtmlgoodies_tooltip){
			this.dhtmlgoodies_tooltip = document.createElement('DIV');
			this.dhtmlgoodies_tooltip.id = this.tt_style;
			this.dhtmlgoodies_tooltipShadow = document.createElement('DIV');
			this.dhtmlgoodies_tooltipShadow.id = this.tt_style_shadow;
			
			document.body.appendChild(this.dhtmlgoodies_tooltip);
			document.body.appendChild(this.dhtmlgoodies_tooltipShadow);	
			
			if(this.tooltip_is_msie){
				this.dhtmlgoodies_iframe = document.createElement('IFRAME');
				this.dhtmlgoodies_iframe.frameborder='5';
				this.dhtmlgoodies_iframe.style.backgroundColor='#FFFFFF';
				this.dhtmlgoodies_iframe.src = '#'; 	
				this.dhtmlgoodies_iframe.style.zIndex = 100;
				this.dhtmlgoodies_iframe.style.position = 'absolute';
				document.body.appendChild(this.dhtmlgoodies_iframe);
			}
			
		}
		
		this.dhtmlgoodies_tooltip.style.display='block';
		// réactiver la ligne suivante pour avoir l'ombre
		// this.dhtmlgoodies_tooltipShadow.style.display='block';
		if(this.tooltip_is_msie) this.dhtmlgoodies_iframe.style.display='block';
		
		var st = Math.max(document.body.scrollTop,document.documentElement.scrollTop);
		if(navigator.userAgent.toLowerCase().indexOf('safari')>=0)st=0; 
		var leftPos = e.clientX + 10;
		
		this.dhtmlgoodies_tooltip.style.width = null;	// Reset style width if it's set 
		this.dhtmlgoodies_tooltip.innerHTML = tooltipTxt;
		this.dhtmlgoodies_tooltip.style.left = leftPos + 'px';
		this.dhtmlgoodies_tooltip.style.top = e.clientY + 10 + st + 'px';

		
		this.dhtmlgoodies_tooltipShadow.style.left =  leftPos + this.dhtmlgoodies_shadowSize + 'px';
		this.dhtmlgoodies_tooltipShadow.style.top = e.clientY + 10 + st + this.dhtmlgoodies_shadowSize + 'px';
		
		if(this.dhtmlgoodies_tooltip.offsetWidth>this.dhtmlgoodies_tooltipMaxWidth){	/* Exceeding max width of tooltip ? */
			this.dhtmlgoodies_tooltip.style.width = this.dhtmlgoodies_tooltipMaxWidth + 'px';
		}
		
		var tooltipWidth = this.dhtmlgoodies_tooltip.offsetWidth;		
		if(tooltipWidth<this.dhtmlgoodies_tooltipMinWidth) tooltipWidth = this.dhtmlgoodies_tooltipMinWidth;
		
		
		this.dhtmlgoodies_tooltip.style.width = tooltipWidth + 'px';
		this.dhtmlgoodies_tooltipShadow.style.width = this.dhtmlgoodies_tooltip.offsetWidth + 'px';
		this.dhtmlgoodies_tooltipShadow.style.height = this.dhtmlgoodies_tooltip.offsetHeight + 'px';		
		
		if((leftPos + tooltipWidth)>bodyWidth){
			this.dhtmlgoodies_tooltip.style.left = (this.dhtmlgoodies_tooltipShadow.style.left.replace('px','') - ((leftPos + tooltipWidth)-bodyWidth)) + 'px';
			this.dhtmlgoodies_tooltipShadow.style.left = (this.dhtmlgoodies_tooltipShadow.style.left.replace('px','') - ((leftPos + tooltipWidth)-bodyWidth) + this.dhtmlgoodies_shadowSize) + 'px';
		}
		
		if(this.tooltip_is_msie){
			this.dhtmlgoodies_iframe.style.left = this.dhtmlgoodies_tooltip.style.left;
			this.dhtmlgoodies_iframe.style.top = this.dhtmlgoodies_tooltip.style.top;
			this.dhtmlgoodies_iframe.style.width = this.dhtmlgoodies_tooltip.offsetWidth + 'px';
			this.dhtmlgoodies_iframe.style.height = this.dhtmlgoodies_tooltip.offsetHeight + 'px';
		
		}
				
	}
	
showTooltip_init.prototype.hideTooltip = function()
	{
		this.dhtmlgoodies_tooltip.style.display='none';
		this.dhtmlgoodies_tooltipShadow.style.display='none';		
		if(this.tooltip_is_msie) this.dhtmlgoodies_iframe.style.display='none';		
	}