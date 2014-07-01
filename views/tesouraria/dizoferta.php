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

	$vlr = false;
	
	$contribuinte = ($_POST['nome']=='') ? 'An&ocirc;nimo':$_POST['nome'];
	
echo '<fieldset><legend>Pre-Lançamento</legend>';
echo '<table>';
echo '<thead><tr><th colspan="2">Contibuinte: '.($_POST['nome']=='') ? 'An&ocirc;nimo':$_POST['nome'].'</th></tr>';
echo '<tbody><tr id="total"><td>Tipo de Entrada</td><td id="moeda">Valor</td></tr>';
if ($_POST['tipo']=='4') {
for ($i = 0; $i < 3; $i++) {
	//verifica se há algum campo algum campo com valor
		$campo = 'oferta'.$i;
		
		$vlrPost = strtr( str_replace(array('.'),array(''),$_POST["$campo"]), ',.','.,' );

		$valorBR = number_format($vlrPost, 2, ',', ' ');
		
		switch ($i) {
			case '0':
				if ($vlrPost>0) 
					printf ("<tr id='lanc'><td>Ofertas EBD:</td><td id='moeda'><button>R$ %s </button></td></tr>",$valorBR);
				
			break;
			case '1':
				if ($vlrPost>0)
					printf ("<tr id='lanc'><td>Corpo de Prof. da EBD:</td><td id='moeda'><button>R$ %s</button></td></tr>",$valorBR);
			
				break;
			case 2:
				if ($vlrPost>0)
					printf ("<tr id='lanc'><td>Arrecadado pgto de Revistas:</td><td id='moeda'><button>R$ %s</button></td></tr>",$valorBR);
			
				break;
			Default:
				if ($vlrPost>0)
					printf ("<tr id='lanc'><td>Outras Arrecadações - Dep. de Ensino</td><td id='moeda'><button>R$ %s</button></td></tr>",$valorBR);
			
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
					printf ("<tr id='lanc'><td>Dizimo:</td><td id='moeda'><button>R$ %s </button></td></tr>",$valorBR);
				
			break;
			case '1':
				if ($vlrPost>0)
					printf ("<tr id='lanc'><td>Oferta:</td><td id='moeda'><button>R$ %s</button></td></tr>",$valorBR);
			
				break;
			case 2:
				if ($vlrPost>0)
					printf ("<tr id='lanc'><td>Oferta Extra:</td><td id='moeda'><button>R$ %s</button></td></tr>",$valorBR);
			
				break;
			case 3:
				if ($vlrPost>0)
					printf ("<tr id='lanc'><td>Voto:</td><td id='moeda'><button>R$ %s</button></td></tr>",$valorBR);
			
				break;
			case 4:
				if ($vlrPost>0)
					printf ("<tr id='lanc'><td>Campanha:</td><td id='moeda'><button>R$ %s</button></td></tr>",$valorBR);
			
			break;
			case 5:
				if ($vlrPost>0)
					printf ("<tr id='lanc'><td>Oferta p/ Missões:</td><td id='moeda'><button>R$ %s</button></td></tr>",$valorBR);
			
				break;
			case 6:
				if ($vlrPost>0)
					printf ("<tr id='lanc'><td>Envelope p/ Missões:</td><td id='moeda'><button>R$ %s</button></td></tr>",$valorBR);
			
				break;
			case 7:
				if ($vlrPost>0)
					printf ("<tr id='lanc'><td>Cofre p/ Missões:</td><td id='moeda'><button>R$ %s</button></td></tr>",$valorBR);
			
			break;
			case 8:
				if ($vlrPost>0)
					printf ("<tr id='lanc'><td>Carn&ecirc;s p/ Missões:</td><td id='moeda'><button>R$ %s</button></td></tr>",$valorBR);
			
			break;
			case 9:
				if ($vlrPost>0)
					printf ("<tr id='lanc'><td>Oferta Ora&ccedil;&atilde;o - Adulto:</td><td id='moeda'><button>R$ %s</button></td></tr>",$valorBR);
			
			break;
			case 10:
				if ($vlrPost>0)
					printf ("<tr id='lanc'><td>Oferta Ora&ccedil;&atilde;o - Mocidade:</td><td id='moeda'><button>R$ %s</button></td></tr>",$valorBR);
			
			break;
			case 11:
				if ($vlrPost>0)
					printf ("<tr id='lanc'><td>Oferta Ora&ccedil;&atilde;o - Infantil:</td><td id='moeda'><button>R$ %s</button></td></tr>",$valorBR);
			
			break;
			case 12:
				if ($vlrPost>0)
					printf ("<tr id='lanc'><td>Voto Ora&ccedil;&atilde;o:</td><td id='moeda'><button>R$ %s</button></td></tr>",$valorBR);
			
			break;
		}
		
		if ($vlrPost>'0') {
			$vlr = true;
		}
	}
}
	
echo '</tbody></table>';
echo '</fieldset>';
?>