<div class="row">
  <div class="col-xs-9"><label>Conta:</label>
    <input type="text" id="inputCta" class="form-control" autofocus="autofocus" tabindex="<?php echo ++$ind;?>"
		 name="conta" placeholder="Busca a partir de 2 caracteres!" value="<?php echo $nomeCred; ?>">
  </div>
  <div class="col-xs-3"><label>C�digo de Acesso:</label>
    <input type="text" id="inputCta2" class="form-control" tabindex="<?php echo ++$ind;?>"
		 name="acessoDebitar" placeholder="Planop de Contas - Acesso" value="<?php echo $cred; ?>">
  </div>
</div>

<script>
  var options = {

  url: function(phrase) {
  		return "models/completeEasyCta.php?q=" + phrase ;
  	},

  getValue: "name",

  list: {

      onSelectItemEvent: function() {
          var selectedItemValue = $("#inputCta").getSelectedItemData().acesso;
          $("#inputCta2").val(selectedItemValue).trigger("change");
      },
      onHideListEvent: function() {
      	$("#inputCta2").val(selectedItemValue).trigger("change");
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
  			 return  item.codigo+'&bull;'+item.titulo+' &bull; Saldo: '+item.saldo;
  		 }
  	 },
   // theme: "round"
  };

  $("#inputCta").easyAutocomplete(options);
</script>
