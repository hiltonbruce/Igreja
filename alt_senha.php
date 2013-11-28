<?php
session_start();
	
	if (isset($_POST['senha_atual']) && isset($_POST['confirma']))
	{
		//se o usuário acabou de tentar efetuar login
		$pass = md5($_POST['senha_atual']);
		
		$query = "SELECT * FROM usuario "
				."WHERE cpf = '{$_SESSION["valid_user"]}'"
				." AND senha='$pass'";
				
		 $result = mysql_query($query) or die (mysql_error());
		 if (mysql_num_rows($result)>0)
			{
				if ($_POST['confirma']==$_POST['confirma2'])
				{
				$alt_senha=mysql_query ("update usuario set senha='".md5($_POST["confirma"])."' where cpf='{$_SESSION["valid_user"]}'");
				}
				else
				{
				echo "<script> alert('Confimação de Senha não Confere. Tente outra vez!');</script>";
				}
			}else{
			echo "<script> alert('Senha atual incorreta!');</script>";
			}	
	}

	if ($alt_senha)
	{
		echo "<script> alert('Senha Alterada com Sucesso!'); location.href='./';</script>";
	}
	// o usuário não tentou efetuar o login ainda ou saiu
		
	// fornece um formulário para efetuar o login	
?>
<fieldset>
<legend>Alterar Senha</legend>
<div align="left">
<form id="form1" name="form1" method="post" action="">
  <label></label>
  <label>Nova Senha:
  <input name="confirma" type="password" id="confirma" />
  </label>
  <label>Confirme Nova Senha:
  <input name="confirma2" type="password" id="confirma2" />
  </label>
  <label>Senha Atual:
  <input name="senha_atual" type="password" id="senha_atual" />
  </label>
  <br><p>
    <input type="submit" name="Submit" value="OK!" />
  </p>
</form>
</div>
</fieldset>
