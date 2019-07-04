<?php
  $igreja = (empty($_GET['igreja'])) ? 1 : intval($_GET['igreja']) ;
 ?>

<form method="get" name="autocompletar" action="">
<div class="row">
  </div>
  <div class="col-xs-12"><label>Nome:</label>
    <input type="text" id="inputThree" class="form-control input-sm"
    name="nome" placeholder="Partes dos nomesde membros para procurarmos">
  </div>
  <div class="col-xs-4"><label>Rol:</label>
    <input type="text" id="inputFour" class="form-control input-sm"
		 name="recebeu" placeholder="N&ordm; do Rol" required="required" >
  </div>
  <div class="col-xs-2">
		<input type="hidden" name="escolha" value="tesouraria/rec_alterar.php" /> <!-- indica o script que receber� os dados -->
		<input type="hidden" name="menu" value="top_tesouraria" />
		<label>&nbsp;</label>
	<input type="submit" class="btn btn-primary btn-sm" name="listar" value="Listar dados...">
</div>
</form>
<script>
  var options = {

  url: function(phrase) {
  		return "models/tes/AutocompleteEasyRec.php?q=" + phrase + "&igreja=" + "<?php echo $igreja;?>";
  	},

  getValue: "name",

  list: {

      onSelectItemEvent: function() {
          var selectedItemValue = $("#inputThree").getSelectedItemData().rol;
          $("#inputFour").val(selectedItemValue).trigger("change");
      },
      onHideListEvent: function() {
      	$("#inputFour").val(selectedItemValue).trigger("change");
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
  			 return  item.icon + " &bull; " + item.nome + item.razao + item.situacao_espiritual;
  		 }
  	 }
  };

  $("#inputThree").easyAutocomplete(options);
</script>
