<?php
	if (isset($_POST['cpf']) && isset($_POST['senha']))
{
	//se o usuário acabou de tentar efetuar login
	$cpf = $_POST['cpf'];
	$senha = md5($_POST['senha']);
	
	$query = "select * from usuario "
			."where cpf='$cpf'"
			." and senha='$senha' ";
 $result = mysql_query($query) or die (mysql_error());
 if (mysql_num_rows($result)>0)
	{
		// se o usuário estiver no banco de dados, registra o id do usuário
		
		$col = mysql_fetch_array($result);

		$_SESSION['nivel']=$col["nivel"];
		$_SESSION['valid_user'] = $col["cpf"];
		$_POST["rol"] = $col["cpf"];
		$_SESSION['cargo']= $col["cargo"];
		$_SESSION['nome']=$col["nome"];
		$_SESSION['computador'] = $_SERVER["REMOTE_ADDR"];
		$_SESSION["setor"] = $col["setor"];
		//echo "<h1>{$col["rol"]} - {$_SESSION['nivel']}</h1>";
		
		 if ( strstr($_SERVER["HTTP_USER_AGENT"], "MSIE") ) 
			 {  
			//se for IE  
				echo "<script> alert('Aconselhamos fortemente que você feche o Internet Explorer e abra o sistema com o Mozilla Firefox!');alert('Bem vindo aos nossos Sistemas!'); location.href='./?escolha=adm/cadastro_membro.php'; </script>";
			 } 
			  
				$hora=date('H');
				
				if ($hora>"18")
					{	
						$sauda="Boa Noite! ";
					}elseif ($hora>"12") {
						
						$sauda="Boa Tarde! ";
							
					}else{
						$sauda="Bom Dia! ";
					}
							
		if ($_SESSION['setor']=='2') {
			echo "<script> alert('".$sauda.$_SESSION['nome']." . $quant_aniv'); location.href='./?escolha=tesouraria/agenda.php&menu=top_tesouraria';</script>";
		}else {		
			$aniv = new aniversario();
			if ($aniv->qt_dia()>1){
					$quant_aniv = "Hoje temos ".$aniv->qt_dia()." aniversariantes!";
				}elseif ($aniv->qt_dia()==1) {
					$quant_aniv = "Hoje temos apenas um aniversariante!";
				}else {
					$quant_aniv = "Hoje não temos aniversariantes!";
				}			
			echo "<script> alert('".$sauda.$_SESSION['nome']." . $quant_aniv'); location.href='./?escolha=aniv/aniversario.php&menu=top_aniv';</script>";
		}
		  
	}	
}

	if (isset($_SESSION['valid_user']))
	{
		echo "<br><h4> Nome: ".$_SESSION['nome']."<br/> Cargo: ".$_SESSION['cargo']."<br/> CPF: ".$_SESSION['valid_user']."</h4>".
				"Computador: ".$_SESSION['computador'];
		echo "<h4><a href='logout.php'>Sair</a></h4><h4><a href='./?escolha=alt_senha.php'>Trocar Senha</a></h4>";
		
		
		//Verifica se a senha foi alterada após inicialização caso contrário chama página de aletração
		$senha_crip = md5($_SESSION["valid_user"]);
		$query_senha = "select * from usuario "
		."where cpf='{$_SESSION["valid_user"]}'"
		." and senha='$senha_crip' ";
 		$result_senh = mysql_query($query_senha) or die (mysql_error());
 		
 		if (mysql_num_rows($result_senh)>0){
 			
 			echo "Desculpe-nos, porém você só poderá continuar no sistema após alterar sua senha atual!";
 			$_GET ["escolha"] = "alt_senha.php";
 		}
		
		
	}
	else
	{
		if (isset($cpf))
		{
			// se o usuário tentar efetuar o login e falhar
			echo "<script> alert('Usuário desconhecido ou senha incorreta!');</script>";
		}
	// o usuário não tentou efetuar o login ainda ou saiu
		
		
		// fornece um formulário para efetuar o login	
?>
<fieldset>
<legend>Entrar</legend>
<div align="left">

  <form name="" method="post" action="">
  		
		<p><label>CPF:</label>
		<input name="cpf" type="text" id="cpf" size="15" autofocus="autofocus" OnKeyPress="formatar('###.###.###-##', this);" tabindex="<?php echo ++$ind;?>" maxlength="14">
		</p>
		<p><label>Senha:</label>
		<input name="senha" type="password" id="senha" size="15" tabindex="<?php echo ++$ind;?>">
		</p>
		<p>
	  	<input type="submit" name="Submit" value="logar" tabindex="3" />
	  	</p>
  </form>
</div>
</fieldset>
<?php
	}
?>
