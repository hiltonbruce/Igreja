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

//function for striping tables
//CREDIT FOR THIS SCRIPT: Matthew Pennell
//URL: http://www.thewatchmakerproject.com

var Event = {
	add: function(obj,type,fn) {
		if (obj.attachEvent) {
			obj['e'+type+fn] = fn;
			obj[type+fn] = function() { obj['e'+type+fn](window.event); }
			obj.attachEvent('on'+type,obj[type+fn]);
		} else
		obj.addEventListener(type,fn,false);
	},
	remove: function(obj,type,fn) {
		if (obj.detachEvent) {
			obj.detachEvent('on'+type,obj[type+fn]);
			obj[type+fn] = null;
		} else
		obj.removeEventListener(type,fn,false);
	}
}

function $() {
	var elements = new Array();
	for (var i=0;i<arguments.length;i++) {
		var element = arguments[i];
		if (typeof element == 'string') element = document.getElementById(element);
		if (arguments.length == 1) return element;
		elements.push(element);
	}
	return elements;
}

String.prototype.trim = function() {
	return this.replace(/^\s+|\s+$/,"");
}

function addClassName(el,className) {
	removeClassName(el,className);
	el.className = (el.className + " " + className).trim();
}

function removeClassName(el,className) {
	el.className = el.className.replace(className,"").trim();
}

var ZebraTable = {
	bgcolor: '',
	classname: '',
	stripe: function(el) {
		if (!$(el)) return;
		var rows = $(el).getElementsByTagName('tr');
		for (var i=1,len=rows.length;i<len;i++) {
			if (i % 2 == 0) rows[i].className = 'alt';
			Event.add(rows[i],'mouseover',function() { ZebraTable.mouseover(this); });
			Event.add(rows[i],'mouseout',function() { ZebraTable.mouseout(this); });
		}
	},
	mouseover: function(row) {
		this.bgcolor = row.style.backgroundColor;
		this.classname = row.className;
		addClassName(row,'over');
	},
	mouseout: function(row) {
		removeClassName(row,'over');
		addClassName(row,this.classname);
		row.style.backgroundColor = this.bgcolor;
	}
}

window.onload = function() {
	ZebraTable.stripe('stripedTable1');
}
