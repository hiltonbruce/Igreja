<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Máscara para campos monetários com jquery + maskMoney</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <script type="text/javascript" src="js/jquery-2.1.1.min.js" ></script>
    <script type="text/javascript" src="js/jquery.maskMoney.js" ></script>
</head>
<body>
  <input type="text" id="currency" />
</body>
<script>
  $(function() {
    $('#currency').maskMoney();
  })
</script></html>
