<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<script language="JavaScript" type="text/javascript">

 function retiraAcento(obj)
 {
   palavra = String.fromCharCode(event.keyCode);

  var caracteresInvalidos = 'àèìòùâêîôûäëïöüáéíóúãõÀÈÌÒÙÂÊÎÔÛÄËÏÖÜÁÉÍÓÚÃÕ';
  var caracteresValidos =   'aeiouaeiouaeiouaeiouaoAEIOUAEIOUAEIOUAEIOUAO';
  var acento = "´`^¨~";
  if(acento.indexOf(palavra)!= -1)
  {
    window.event.keyCode = 0;
  }

 if (caracteresInvalidos.indexOf(palavra) == -1)
  {
       if (caracteresValidos.indexOf(palavra) != -1) {
         window.event.keyCode = 0;
         obj.value = obj.value + palavra;
       }
  }
  else
  {
           window.event.keyCode = 0;
           nova = caracteresValidos.charAt(caracteresInvalidos.indexOf(palavra));
           obj.value =  obj.value + nova;
  }

 }
</script>
<title>Untitled Document</title>
</head>

<body>

Agora o codigo HTML

<form id="verifica" method="post" action="" >
  <p>
    <input type="text" name="txtlogin" id="txtlogin" onKeyPress="javascript:retiraAcento(this);">
  </p>

</form>
</body>
</html>
