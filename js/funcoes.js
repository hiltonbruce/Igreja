// JavaScript Document

function lancarSubmenu(n){
	   window.open("adm/pesq_membro.php?"+n+"","janela1","width=400,height=700,scrollbars=YES,top=100");
	}

function lancarRecibo(n){
	   window.open("tesouraria/pesq_recibo.php?"+n+"","janela1","width=600,height=700,scrollbars=YES,top=100");
	}
	
function formatar(mascara, documento){
  var i = documento.value.length;
  var saida = mascara.substring(0,1);
  var texto = mascara.substring(i);
  
  if (texto.substring(0,1) != saida){
	documento.value += texto.substring(0,1);
  }
  
}

function textCounter(field, countfield, maxlimit) {
	if (field.value.length > maxlimit) // if too long...trim it!
		field.value = field.value.substring(0, maxlimit);
		// otherwise, update 'characters left' counter
	else 
		countfield.value = maxlimit - field.value.length;
}

var ancho=550;
function progreso_tecla(obj,max) {
  var progreso = document.getElementById("progreso");  
  if (obj.value.length < max) {
    progreso.style.backgroundColor = "#C2E6F7";    
    progreso.style.backgroundImage = "url(img/textarea.png)";    
    progreso.style.color = "#000000";
    var pos = ancho-parseInt((ancho*parseInt(obj.value.length))/max);
    progreso.style.backgroundPosition = "-"+pos+"px 0px";
  } else {
    progreso.style.backgroundColor = "#CC0000";    
    progreso.style.backgroundImage = "url()";    
    progreso.style.color = "#FFFFFF";
  } 
  progreso.innerHTML = "("+obj.value.length+" / "+max+")";
}

function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}

window.setTimeout('PMA_focusInput()', 500);

$(document).ready(function(){

	new Autocomplete("campo_estado", function() {
		this.setValue = function( rol, nome, celular ) {
			$("#id_val").val(rol);
			$("#estado_val").val(nome);
			$("#sigla_val").val(celular);
		}
		if ( this.isModified )
			this.setValue("");
		if ( this.value.length < 1 && this.isNotClick )
			return ;
		return "models/autocomplete.php?q=" + this.value;
	});

});