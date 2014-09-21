<?PHP
/**
 * Joseilton Costa Bruce
 *
 * LICENÇA
 *
 * Please send an email
 * to hiltonbruce@gmail.com so we can send you a copy immediately.
 *
 * @category   Pessoal
 * @package
 * @subpackage
 * @copyright  Copyright (c) 2008-2009 Joseilton Costa Bruce (http://)
 * @license    http://
 * Insere dados no banco do forms/autodizimo.php na tabela:usuario
 */
controle ("tes");

if ($_POST["rol"]>'0' ) {
	if (!empty($_POST["nome"])) {
		$nome = $_POST["nome"];
		$mostrarNome =  $_POST["rol"].' &bull; '.$nome;
	}else {
		//Se for informado o rol, então traz o nome do banco
		$nomecont = new DBRecord('membro', $_POST["rol"], 'rol');
		$nome = $nomecont -> nome();
		$mostrarNome =  $nomecont -> rol().' &bull; '.$nome;
	}
	
	$eclesia = new DBRecord('eclesiastico', $_POST["rol"], 'rol');
	$congcontrib = $eclesia->congregacao();
} elseif (!empty($_POST["nome"]))  {
	$nome = $_POST["nome"];
	$mostrarNome =  'Congregado &bull; '.$nome;
} else {
	$nome = 'Anônimo';
	$mostrarNome =  'An&ocirc;nimo';
}
	$nome = trim($nome);
	$vlr = false;
	
$mostraLanc  =  '<fieldset><legend>Pre-Lançamento</legend>';
$mostraLanc .=  '<table class="table">';
$mostraLanc .=  '<thead><tr><th colspan="2">Contibuinte: <span class="badge">'.$mostrarNome.'</span></th></tr>';
$mostraLanc .=  '</thead><tbody><tr id="total"><td>Tipo de Entrada</td><td id="moeda">Valor</td></tr>';
if ($_POST['tipo']=='4') {
for ($i = 0; $i < 3; $i++) {
	//verifica se há algum campo algum campo com valor
		$campo = 'oferta'.$i;
		
		$vlrPost = strtr( str_replace(array('.'),array(''),$_POST["$campo"]), ',.','.,' );

		$valorBR = number_format($vlrPost, 2, ',', ' ');
		
		switch ($i) {
			case '0':
				if ($vlrPost>0) 
					$mostraLanc .= sprintf ("<tr id='lanc'><td>Ofertas EBD:</td><td id='moeda'><button class='btn btn-primary' tabindex='1'>R$ %s </button></td></tr>",$valorBR);
				
			break;
			case '1':
				if ($vlrPost>0)
					$mostraLanc .= sprintf ("<tr id='lanc'><td>Corpo de Prof. da EBD:</td><td id='moeda'><button class='btn btn-primary' tabindex='1'>R$ %s</button></td></tr>",$valorBR);
			
				break;
			case 2:
				if ($vlrPost>0)
					$mostraLanc .= sprintf ("<tr id='lanc'><td>Arrecadado pgto de Revistas:</td><td id='moeda'><button class='btn btn-primary' tabindex='1'>R$ %s</button></td></tr>",$valorBR);
			
				break;
			Default:
				if ($vlrPost>0)
					$mostraLanc .= sprintf ("<tr id='lanc'><td>Outras Arrecadações - Dep. de Ensino</td><td id='moeda'><button class='btn btn-primary' tabindex='1'>R$ %s</button></td></tr>",$valorBR);
			
			break;
		}
		
		if ($vlrPost>'0') {
			$vlr = true;
		}
	}
}else {
for ($i = 0; $i < 13; $i++) {
	//verifica se há algum campo algum campo com valor
		$campo = 'oferta'.$i;
		
		$vlrPost = strtr( str_replace(array('.'),array(''),$_POST["$campo"]), ',.','.,' );

		$valorBR = number_format($vlrPost, 2, ',', ' ');
		
		switch ($i) {
			case '0':
				if ($vlrPost>0) 
					$mostraLanc .= sprintf ("<tr id='lanc'><td>Dizimo:</td><td id='moeda'><button>R$ %s </button></td></tr>",$valorBR);
				
			break;
			case '1':
				if ($vlrPost>0)
					$mostraLanc .= sprintf ("<tr id='lanc'><td>Oferta:</td><td id='moeda'><button>R$ %s</button></td></tr>",$valorBR);
			
				break;
			case 2:
				if ($vlrPost>0)
					$mostraLanc .= sprintf ("<tr id='lanc'><td>Oferta Extra:</td><td id='moeda'><button>R$ %s</button></td></tr>",$valorBR);
			
				break;
			case 3:
				if ($vlrPost>0)
					$mostraLanc .= sprintf ("<tr id='lanc'><td>Voto:</td><td id='moeda'><button>R$ %s</button></td></tr>",$valorBR);
			
				break;
			case 4:
				if ($vlrPost>0)
					$mostraLanc .= sprintf ("<tr id='lanc'><td>Campanha:</td><td id='moeda'><button>R$ %s</button></td></tr>",$valorBR);
			
			break;
			case 5:
				if ($vlrPost>0)
					$mostraLanc .= sprintf ("<tr id='lanc'><td>Oferta p/ Missões:</td><td id='moeda'><button>R$ %s</button></td></tr>",$valorBR);
			
				break;
			case 6:
				if ($vlrPost>0)
					$mostraLanc .= sprintf ("<tr id='lanc'><td>Envelope p/ Missões:</td><td id='moeda'><button>R$ %s</button></td></tr>",$valorBR);
			
				break;
			case 7:
				if ($vlrPost>0)
					$mostraLanc .= sprintf ("<tr id='lanc'><td>Cofre p/ Missões:</td><td id='moeda'><button>R$ %s</button></td></tr>",$valorBR);
			
			break;
			case 8:
				if ($vlrPost>0)
					$mostraLanc .= sprintf ("<tr id='lanc'><td>Carn&ecirc;s p/ Missões:</td><td id='moeda'><button>R$ %s</button></td></tr>",$valorBR);
			
			break;
			case 9:
				if ($vlrPost>0)
					$mostraLanc .= sprintf ("<tr id='lanc'><td>Oferta Ora&ccedil;&atilde;o - Adulto:</td><td id='moeda'><button>R$ %s</button></td></tr>",$valorBR);
			
			break;
			case 10:
				if ($vlrPost>0)
					$mostraLanc .= sprintf ("<tr id='lanc'><td>Oferta Ora&ccedil;&atilde;o - Mocidade:</td><td id='moeda'><button>R$ %s</button></td></tr>",$valorBR);
			
			break;
			case 11:
				if ($vlrPost>0)
					$mostraLanc .= sprintf ("<tr id='lanc'><td>Oferta Ora&ccedil;&atilde;o - Infantil:</td><td id='moeda'><button>R$ %s</button></td></tr>",$valorBR);
			
			break;
			case 12:
				if ($vlrPost>0)
					$mostraLanc .= sprintf ("<tr id='lanc'><td>Voto Ora&ccedil;&atilde;o:</td><td id='moeda'><button>R$ %s</button></td></tr>",$valorBR);
			
			break;
		}
		
		if ($vlrPost>'0') {
			$vlr = true;
		}
	}
}
	
$mostraLanc .= '</tbody></table>';
$mostraLanc .=  '</fieldset>';
?>