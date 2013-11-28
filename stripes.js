// function for striping tables
// CREDIT FOR THIS SCRIPT: Matthew Pennell
// URL: http://www.thewatchmakerproject.com

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