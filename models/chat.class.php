<?php
class chat {

	private $status;

	function chat ($status){

		$this->login = $_SESSION['username'];
		$this->tempo = intval($_SERVER["REQUEST_TIME"]);
		$this->status= intval($status);

	}

	function incluir() {
		//disponibiliza o usu�rio na lista

		if ($this->login!=''){
			$sql = "SELECT * FROM login WHERE nome='{$this->login}'";
			$result = mysql_query($sql);
			$dadresult = mysql_fetch_array($result);
			//echo "<h1> {$dadresult['nome']}</h1>";
				if ($dadresult['nome']!='') {
					//Atualiza o login se j� existir
					$atualiza = "UPDATE login SET tempo='{$this->tempo}', status='' WHERE nome='".$this->login."' LIMIT 1";
					$query = mysql_query($atualiza);
				} else {
					//Inseri o login na tabela
					$inserir = "INSERT INTO login (nome,tempo,status) VALUES ('{$this->login}','{$this->tempo}','')";
					$query = mysql_query($inserir);
				}
		}
	}

	function  status(){

	}

	function online() {

			$ativo = $this->tempo - 180;
			$ausente = $ativo - 300;
			$offline = $ausente - 240000;
			$logado = "SELECT * FROM login WHERE status='0' AND nome<>'{$_SESSION['username']}' AND tempo > '$offline' ORDER BY tempo DESC ";
			$result = mysql_query($logado) or die(mysql_error());
			while ($dadresult = mysql_fetch_array($result)) {
				//$lista .= $dadresult['nome'];
				//echo 'banco '.$dadresult['tempo'].' <---> Atual - 180: '.$ativo.'<br />';
				if ($ativo < $dadresult['tempo'] ) {
					?>
						<a href="javascript:void(0)" title="Ativo" onclick="javascript:chatWith('<?php echo $dadresult['nome'] ;?>')">
						<img src='img/ativo.png' alt="Logo Ativo" width="12" height="12" align="bottom" /> <?php echo $dadresult['nome'] ;?></a>
						<br />
					<?php
				}elseif ($ausente < $dadresult['tempo'] ) {
					?>
						<a href="javascript:void(0)" title="Ausente a mais de 5 minutos" onclick="javascript:chatWith('<?php echo $dadresult['nome'] ;?>')">
						<img src='img/ausente.png' alt="Logo Ativo" width="12" height="12" align="bottom" /> <?php echo $dadresult['nome'] ;?></a>
						<br />
					<?php
				}elseif ($offline < $dadresult['tempo'] ) {
					?>
						<a href="javascript:void(0)" title="Offline... Deixe seu recado!" onclick="javascript:chatWith('<?php echo $dadresult['nome'] ;?>')">
						<img src='img/2934_16x16.png' alt="Logo Ativo" width="12" height="12" align="bottom" /> <?php echo $dadresult['nome'] ;?></a>
						<br />
					<?php

				}else {
					echo 'Sem usu&aacute;rios <br />';
				}
			}

	}
}
