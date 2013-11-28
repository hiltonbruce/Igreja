<?PHP 
	if (isset($_SESSION["rol"])) {
?>

	<fieldset><legend>Matricular Estudante</legend><form name="form1" method="post" action="">
  <?PHP echo " Nome: {$_SESSION["membro"]}";?><label> Rol:<?PHP echo $_SESSION["rol"];?>
  </label>
  <label>Curso:
  		<?PHP
			$lista = new List_Curso;
			$lista -> List_Curso ();
		?>
  </label>
  <label>Mensalidade:
  <input name="mensal" type="text" id="mensal">
  </label>
  <label>Vencimento:
  <input name="vencimento" type="text" id="vencimento" size="2" maxlength="2">
  </label>
  <label><p>
  <input name="escolha" type="hidden" value="adm/cad_dados_pess.php" />
  <input name="tabela" type="hidden" id="tabela" value="cetad_aluno" />
  <input type="submit" name="Submit" value="Matricular ..." /></p>
  </label>
	</form></fieldset>

<?PHP
}
?>
<form action="" method="get">
    <input name="escolha" type="hidden" value="adm/rest_busca.php"/>
    Busca de Membros:
    <input name="nome" type="text" id="nome"/>
    <input type="image" src="img/lupa_32x32.png" height="16" width="16" name="Submit22" value="submit" alt="procurar" title="Click aqui para pesquisar Membro!" style="background:none"/>
    <input type="submit" name="Submit3" value="Procurar..." />
</form>

Fa&ccedil;a a busca de Membros confirme os dados e retorne atrav&eacute;s do Link &quot;CETAD&quot;
