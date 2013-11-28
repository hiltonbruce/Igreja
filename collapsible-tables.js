	var cssNode = document.createElement('link');
	cssNode.setAttribute('rel', 'stylesheet');
	cssNode.setAttribute('type', 'text/css');
	cssNode.setAttribute('href', 'js-override.css');
	document.getElementsByTagName('head')[0].appendChild(cssNode);


function toggle(toggler) {
	if(document.getElementById) {
	imageSwitch = toggler;
	targetElement = toggler.parentNode.parentNode.parentNode.nextSibling;
	
	if(targetElement.className == undefined) {
	targetElement = toggler.parentNode.parentNode.parentNode.nextSibling.nextSibling;
	}	


if (navigator.userAgent.indexOf('IE')!= -1)
	{
	var displaySetting = "block";
	}
	else
	{
	var displaySetting = "table-row-group";
	}
	

if (targetElement.style.display == displaySetting)
	{
	targetElement.style.display = "none";
	imageSwitch.style.backgroundImage = "url(down-arrow.gif)";
	}
	else
	{
	targetElement.style.display = displaySetting;
	imageSwitch.style.backgroundImage = "url(up-arrow.gif)";
	}
	}
}
