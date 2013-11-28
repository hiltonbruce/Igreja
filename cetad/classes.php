<?PHP
class cetad {

	function __construct (){
	
		$this->mes = (int) $_GET["mes"];
		//mês inicial para listagem
		
		if ($this->mes<1 || $this->mes>12){
		//Se não for atribuido qualquer mês inicial ou se estiver fora da faixa terá janeiro como início.
			$this->mes = "01";
		}
	}
	
	function caixa() {
	
	//$semana = date('W') + $_GET["proxima"];
	//if ($semana<10 && $semana>0) {$semana="0".$semana;}
		
	/*if ($semana < "1"){
		echo "<script> alert('Você já atingiu o Ano anterior!');</script>";
		echo "Você já atingiu o Ano anterior!";
	} elseif ($semana > "53") {
		echo "<script> alert('Você já atingiu o Ano seguinte!');</script>";
		echo "Você já atingiu o Ano seguinte!";
	}*/
		
		$sql_aluno = mysql_query ("SELECT p.id_aluno,m.nome,a.rol FROM cetad_pgto AS p, cetad_aluno AS a, membro AS m WHERE a.rol = m.rol AND a.id = p.id_aluno GROUP BY p.id_aluno ORDER BY m.nome") or die (mysql_error());
		
		while($this->nome=mysql_fetch_array($sql_aluno))
		{
			$inc++;
			$item++;
			
			if ($inc==1) { echo "<tr class='odd'>"; } else {echo "<tr class='dados'>"; $inc=0;}
			
			echo "<td>$item</td><td><a href='./?escolha=adm/dados_pessoais.php&bsc_rol={$this->nome["rol"]}'>{$this->nome["nome"]}</a></td>";
			
			for ($loop_mes = 1 ; $loop_mes < 13; $loop_mes ++){
			
				$this -> pgto = mysql_query ("SELECT pgto FROM cetad_pgto WHERE id_aluno = '{$this->nome ["id_aluno"]}' AND DATE_FORMAT(data_pgto,'%m')= $loop_mes ") or die (mysql_error());
				
				$this -> valor = mysql_fetch_array($this -> pgto);
		
				printf ("<td>%s</td>",number_format($this->valor["pgto"], 2, ',', '.'));
				$total_mes[$loop_mes] += $this->valor["pgto"];
				$total_ano += $this->valor["pgto"];
			}
			echo "</tr>";
			
			
		}
		echo "<tr><td colspan='2'>Totais</td>";
		for ($totais = 1 ; $totais < 13; $totais ++){
			printf ("<td>%s</td>",number_format($total_mes[$totais], 2, ',', '.'));
		}
		echo "</tr>";
		printf  ("Total de recebimentos no ano: R$ %s",number_format($total_ano, 2, ',', '.'));
	}
	
}

class List_curso {
	//Lista para formulário
	
	function __construct (){
		
		$this->indice = 1;
		$this->sql_lst = mysql_query("SELECT id,tipo from cetad_curso ORDER BY tipo");
		
	}

	function List_Curso() {
	
	//Mostra as linhas de select
	
	echo "<select name='curso' id='curso' class='' tabindex='{$this->indice}'>";		
	echo "<option value=''>-->> Escolha o Curso <<--</option>";
	
		while($this->col_lst = mysql_fetch_array($this->sql_lst)){
		
			echo "<option value='{$this->col_lst["id"]}'>".htmlspecialchars(stripcslashes($this->col_lst["tipo"]))."</option>";
		
		}
	echo "</select>";
	
	//Disconecta do Banco
	//$db->disconnect();
	}
	
	function List_Curso_pop() {
	
	//Mostra as linhas de select
		
		while($this->col_lst = mysql_fetch_array($this->sql_lst)){
		
			echo "<option value='./?escolha=cetad/pgto.php&menu=top_cetad&curso={$this->col_lst["id"]}'>".htmlspecialchars(stripcslashes($this->col_lst["tipo"]))."</option>";
		
		}
	
	//Disconecta do Banco
	//$db->disconnect();
	}	
}

class Aluno_Curso {
	//Lista para formulário
	
	function __construct (){
		
		$this->indice = 1;
		$this->sql_aluno = mysql_query("SELECT m.nome,a.id from membro AS m, cetad_aluno AS a WHERE m.rol = a.rol AND a.curso = '{$_GET["curso"]}' ORDER BY m.nome");
		$this->tipo_curso = new DBRecord ("cetad_curso",$_GET["curso"],"id");
		
	}

	function List_Aluno() {
	
	//Mostra as linhas de select
	
	echo "<h2>Curso: {$this->tipo_curso->tipo()}</h2>";
	echo " <label>Aluno: <select name='aluno' id='aluno' class='' tabindex='{$this->indice}'>";		
	echo "<option value=''>-->> Escolha o Aluno <<--</option>";
	
		while($this->col_aluno = mysql_fetch_array($this->sql_aluno)){
		
			echo "<option value='{$this->col_aluno["id"]}'>{$this->col_aluno["nome"]}</option>";
		
		}
	echo "</select> </label>";
	//Disconecta do Banco
	//$db->disconnect();
	}
}
?>