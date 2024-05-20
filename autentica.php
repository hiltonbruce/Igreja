<?php
	if (isset($_POST['cpf']) && isset($_POST['senha']))
{
	//se o usuï¿½rio acabou de tentar efetuar login
	$cpf = $_POST['cpf'];
	$senha = md5($_POST['senha']);
	$query = 'select u.*,s.alias from usuario AS u, setores AS s '
			.'where cpf="'.$cpf.'" AND u.setor=s.id '
			.'and senha="'.$senha.'" AND situacao="1"';
 $result = mysql_query($query) or die (mysql_error());
 if (mysql_num_rows($result)>0)
	{
		// se o usuï¿½rio estiver no banco de dados, registra o id do usuï¿½rio
		$col = mysql_fetch_array($result);
		$_SESSION['nivel'] = $col["nivel"];
		$_SESSION['valid_user'] = $col["cpf"];
		$_POST["rol"] = $col["cpf"];
		$_SESSION['cargo'] = $col["alias"];
		$_SESSION['nome'] = $col["nome"];
		$nomeUsuario = explode(' ', $col["nome"]);
		$_SESSION['username'] = $nomeUsuario['0'].'_'.$nomeUsuario['1'];
		$_SESSION['computador'] = $_SERVER["REMOTE_ADDR"];
		$_SESSION["setor"] = $col["setor"];
		$_SESSION["perfil"] = $col["perfil"];
		//echo "<h1>{$col["rol"]} - {$_SESSION['nivel']}</h1>";
		 if ( strstr($_SERVER["HTTP_USER_AGENT"], "MSIE") )
			 {
			//se for IE
				echo "<script> alert('Aconselhamos fortemente que você feche o Internet Explorer e abra o sistema com o Mozilla Firefox!');alert('Bem vindo aos nossos Sistemas!'); location.href='./?escolha=adm/cadastro_membro.php'; </script>";
			 }
				$hora = date('H');
				if ($hora > "18")
					{
						$sauda = "Boa Noite! ";
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
			echo "<script> alert('".$sauda.$_SESSION['nome']." . $quant_aniv'); location.href='./?escolha=controller/secretaria.php&sec=2';</script>";
		}
	}
}
	if (isset($_SESSION['valid_user']))
	{
		require_once 'chat/samplea.php';
		//Verifica se a senha foi alterada apï¿½s inicializaï¿½ï¿½o caso contrï¿½rio chama pï¿½gina de aletraï¿½ï¿½o
		$senha_crip = md5($_SESSION["valid_user"]);
		$query_senha = "select * from usuario "
		."where cpf='{$_SESSION["valid_user"]}'"
		." and senha='$senha_crip' ";
 		$result_senh = mysql_query($query_senha) or die (mysql_error());
 		if (mysql_num_rows($result_senh)>'0'){
 			echo "Desculpe-nos, por&eacute;m voc&ecirc; s&oacute; poder&aacute; continuar no sistema ap&oacute;s alterar sua senha atual!";
 			$_GET ["escolha"] = "alt_senha.php";
 		}
	}
	else
	{
		if (isset($cpf)){
			// se o usuï¿½rio tentar efetuar o login e falhar
			echo "<script> alert('Usuário desconhecido ou senha incorreta!');</script>";
		}
	// o usuï¿½rio nï¿½o tentou efetuar o login ainda ou saiu
	// fornece um formulï¿½rio para efetuar o login
	if (empty($ind)){ $ind = 0;}
?>
	
	<!-- <p>&nbsp;</p> -->
<div class="login-box-body">
	<p class="login-box-msg">Fa&ccedil;a o login para iniciar a sess&atilde;o!</p>
	
	
	<!-- <p>&nbsp;</p> -->
  <form name="" method="post" action="">
      <div class="form-group has-feedback">
		  <label for="" class="text-left">CPF</label>
	<input name="cpf" type="text" id="cpf" autofocus="autofocus"
	required='required' class="form-control" tabindex="<?php echo ++$ind;?>" placeholder='CPF' >
        <span class="glyphicon glyphicon-tags form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
		  <label for="" class="text-left">Senha</label>
	<input name="senha" type="password" id="senha" required='required'
	class="form-control" tabindex="<?php echo ++$ind;?>" placeholder='Senha' >
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
	
      <!-- <p>&nbsp;</p> -->
		<div class="row">
			<div class="col-xs-8">
			<div class="checkbox icheck">
				<label>
				&nbsp;
				</label>
			</div>
			</div>
			<!-- /.col -->
			<div class="col-xs-4">
				<input type="submit" name="Submit" value="logar" class='btn btn-primary' tabindex="<?php echo ++$ind;?>" />
			</div>
			<!-- /.col -->
      </div>
	</form>


    <!-- <div class="social-auth-links text-center">
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> &nbsp;</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> &nbsp;</a>
    </div> -->
    <!-- /.social-auth-links -->

    <!-- <a href="#">&nbsp;</a><br> -->


</div>
<?php
	}
?>

