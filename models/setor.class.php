<?php
class setor {
	protected $ind;
	
	function __construct($ind=''){
		echo	"<select name='setor' id='setor' class='' tabindex='$ind'>";
			echo "<option value=''>-->> Qual Setor <<--</option>";
				for ($i=1; $i<11; $i++)
				{
					echo "<option value=$i >Setor $i</option>";
				}
		echo "</select>";
	}
}