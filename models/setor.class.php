<?php
class setor {
	protected $ind;

	function __construct($ind='',$comp=''){
		echo	"<select name='setor' id='setor' class='form-control' $comp tabindex='$ind'>";
			echo "<option value=''>-->> Escolha o Setor <<--</option>";
				for ($i=1; $i<= SECTOR_QUANT ; $i++)
				{
					echo '<option value='.$i.' >Setor '.nRomano($i).'</option>';
				}
		echo "</select>";
	}
}
