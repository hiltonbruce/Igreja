

<div class="row">
  <div class="col-xs-9"><label>Nome:</label>
    <input type="text" id="inputOne" class="form-control" autofocus="autofocus" tabindex="<?php echo ++$ind;?>"
		 name="nome" placeholder="Nome, ...sobrenome ou partes deles para procurarmos, a partir de 2 caracteres!"
		 value="<?=$nome?>">
  </div>
  <div class="col-xs-3"><label>Rol:</label>
    <input type="text" id="inputTwo" class="form-control" tabindex="<?php echo ++$ind;?>"
		 name="rol" placeholder="N&ordm; do Rol de membro" value="<?=$rol?>">
  </div>
</div>
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
  			 return  item.icon + " &bull; " + item.nome+' Rol: '+item.rol + item.razao + item.situacao_espiritual;
  		 }
  	 },
   // theme: "round"
  };

  $("#inputOne").easyAutocomplete(options);
</script>
