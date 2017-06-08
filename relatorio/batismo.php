<?php
require_once 'forms/tes/recMembro.php';

 ?>
 <script type="text/javascript">
 	new Autocomplete("estado", function() {
 		this.setValue = function( rol, nome, celular,detalhe ) {
 			$("#id_val2").val(rol);
 			$("#nome2").val(nome);
 			$("#acesso2").val(celular);
 			$("#rol2").val(celular);
 			$("#detalhe2").val(detalhe);
 		}
 		if ( this.isModified )
 			this.setValue("");
 		if ( this.value.length < 1 && this.isNotClick )
 			return ;
 			return "models/autocomplete.php?q=" + this.value;
 	});
 </script>
