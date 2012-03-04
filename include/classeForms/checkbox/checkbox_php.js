
function ActiverChampSurCoche() { 
		args=ActiverChampSurCoche.arguments 
		objcoche = eval('obj'+args[0]+'.obj_coche'); 
		for(i=1;i<args.length;i++) { 
			obj=MM_findObj(args[i]) 
			if (obj){ obj.disabled=!objcoche; } 
		} 
} 


function ActiverCocheSurCoche() { 
		args=ActiverCocheSurCoche.arguments 
		objcoche = eval('obj'+args[0]+'.obj_coche'); 
		for(i=1;i<args.length;i++) { 
			if (objcoche) {
				eval('obj'+args[i]+'.ogc_enable()');
			} else {
				eval('obj'+args[i]+'.ogc_disable()'); 
			}
		} 
} 

function DesactiverChampSurCoche() { 
		args=DesactiverChampSurCoche.arguments 
		objcoche = eval('obj'+args[0]+'.obj_coche'); 
		for(i=1;i<args.length;i++) { 
			obj=MM_findObj(args[i]) 
			if (obj){ obj.disabled=objcoche } 
		} 
} 

function DesactiverCocheSurCoche() { 
		args=DesactiverCocheSurCoche.arguments 
		objcoche = eval('obj'+args[0]+'.obj_coche'); 
		for(i=1;i<args.length;i++) { 
			if (!objcoche) {
				eval('obj'+args[i]+'.ogc_enable()');
			} else {
				eval('obj'+args[i]+'.ogc_disable()'); 
			}
		} 
} 