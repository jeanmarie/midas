// JavaScript Document




/* DECLARATION D'UNE DUREE DE VIE POUR LA PAGE 


	1) En fin de page d�finir le compte a rebours
	
	toto = new AutoRedirection('diapo_type2.php',10,'toto');
		- l'url de branchement
		- la dur�e en seconde de la temporisation
		- le nom de l'objet "lui-m�me"
		
	toto.AutoRedirection_idcounter('COOL_REDIRECT'); 
		- l'id de la zone a modifier : <div id="COOL_REDIRECT">xxx</div>
	toto.AutoRedirection_init(); ";	

	2) Sur �v�nement on peut :
		- stoper d�finitivement le compte � rebours
			 <a href="javascript:toto.AutoRedirection_stop()">stop it </a>

		- red�marrer le compte � rebours depuis le d�but			 
			 <a href="javascript:toto.AutoRedirection_start()">restart it </a>

		- mettre le compte � rebours en pause puis le red�marrer
			 <a href="javascript:toto.AutoRedirection_pause()">pause/restart</a>		

*/




function AutoRedirection(_url,_ttl,_objname) {
	this.ttl = _ttl;
	this.url = _url;
	this.objname   = _objname;
	this.activated = true;
	this.paused    = false;
	this.idVisuTimer = '';
	
	this.AutoRedirection_init = function() {
		var cTicks = this.ttl;
		var url    = this.url;
		var evalfct = this.objname+'.AutoRedirection_stopit()';
		var obj = MM_findObj(this.idVisuTimer)
		if( cTicks ) {
			if (obj) obj.innerHTML = cTicks;
			--cTicks;
		}
		var timer = setInterval(function()
			{
				valret = eval(evalfct);
				switch (valret) {
					case 0:
			        	clearInterval(timer);
						break;

					case 2:
						if( cTicks ) {
							if (obj) obj.innerHTML = cTicks;
							--cTicks;
						} else {
				        	clearInterval(timer);					
							location = url;	  
						}
						break;
				}
			}, 1000 );
	}
	
	this.AutoRedirection_stopit = function() {
		if (this.paused && this.activated) return 1;
		if (!this.activated) return 0;
		return 2;
	}


	this.AutoRedirection_idcounter = function(_idVisuTimer) {
		this.idVisuTimer = _idVisuTimer;
	}
	
	
	this.AutoRedirection_stop = function() {
		this.activated = false;
	}

	this.AutoRedirection_start = function() {
		this.paused = false;
		this.activated = true;
		this.AutoRedirection_init();
	}

	this.AutoRedirection_pause = function() {
		this.paused = !this.paused;
		if (!this.paused) this.activated = true;
	}

}

