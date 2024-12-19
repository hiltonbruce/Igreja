<?php
  $igreja = (empty($_GET['igreja'])) ? 1 : intval($_GET['igreja']) ;
 ?>
 <script src="js/jquery-1.11.2.min.js"></script>
 <script src="js/jquery.easy-autocomplete.min.js" type="text/javascript" ></script>
<td colspan="3">
	<div class="col-xs-12"><label>Nome:</label>
	  <input type="text" id="inputOne" class="form-control" autofocus="autofocus" tabindex="<?php echo ++$ind;?>"
		   name="nome" placeholder="Nome, ...sobrenome ou partes deles para procurarmos, a partir de 2 caracteres!">
	</div>
</td>
<td>
	<div class="col-xs-12"><label>Rol: </label>
	  <input type="text" id="inputTwo" class="form-control" tabindex="<?php echo ++$ind;?>"
		   name="rol" placeholder="N&ordm; do Rol de membro">
		   <small>(Digite zero p/ anônmimo)</small>
	</div>
</td>
<script>
  var options = {

  url: function(phrase) {
  		return "models/AutocompleteEasy.php?q=" + phrase + "&igreja=" + "<?php echo $igreja;?>";
  	},

  getValue: "name",

  list: {

      onSelectItemEvent: function() {
          var selectedItemValue = $("#inputOne").getSelectedItemData().rol;
          $("#inputTwo").val(selectedItemValue).trigger("change");
      },
      onHideListEvent: function() {
      	$("#inputTwo").val(selectedItemValue).trigger("change");
    	},
  		showAnimation: {
  			type: "fade", //normal|slide|fade
  			time: 200,
  			callback: function() {}
  		},

  		hideAnimation: {
  			type: "slide", //normal|slide|fade
  			time: 200,
  			callback: function() {}
  		},
  		maxNumberOfElements: 10,
    },

   template: {
  		 type: "custom",
  		 method: function(value, item) {
  			 return  item.icon + " &bull; " + item.nome +' Rol: '+item.rol + item.razao + item.situacao_espiritual;
  		 }
  	 },
   // theme: "round"
  };

  $("#inputOne").easyAutocomplete(options);
</script>
