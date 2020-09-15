<?php
  $igreja = (empty($_GET['igreja'])) ? 1 : intval($_GET['igreja']) ;
 ?>
 <script src="js/jquery-1.11.2.min.js"></script>
 <script src="js/jquery.easy-autocomplete.min.js" type="text/javascript" ></script>

<div class="row">
  <div class="col-xs-9"><label>Nome do Pai:</label>
    <input type="text" id="inputOne" class="form-control" autofocus="autofocus" tabindex="<?php echo ++$ind;?>"
		 name="name="pai" placeholder="Nome, ...sobrenome ou partes deles para procurarmos, a partir de 2 caracteres!">
  </div>
  <div class="col-xs-3"><label>Rol do Pai:</label>
    <input type="text" id="inputTwo" class="form-control" tabindex="<?php echo ++$ind;?>"
		 name="rol_pai" placeholder="N&ordm; do Rol de membro">
  </div>
  <div class="col-xs-9"><label>Nome da Mãe:</label>
    <input type="text" id="inputMae" class="form-control" autofocus="autofocus" tabindex="<?php echo ++$ind;?>"
		 name="mae" placeholder="Nome, ...sobrenome ou partes deles para procurarmos, a partir de 2 caracteres!">
  </div>
  <div class="col-xs-3"><label>Rol da Mãe:</label>
    <input type="text" id="inputMaeTwo" class="form-control" tabindex="<?php echo ++$ind;?>"
		 name="rol_mae" placeholder="N&ordm; do Rol de membro">
  </div>
</div>
<script>
  var options = {

  url: function(phrase) {
  		return "models/AutocompleteEasy.php?q=" + phrase + "&sexo=M";
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

var options2 = {

url: function(phrase) {
        return "models/AutocompleteEasy.php?q=" + phrase + "&sexo=F";
    },

getValue: "name",

list: {

    onSelectItemEvent: function() {
        var selectedItemValue = $("#inputMae").getSelectedItemData().rol;
        $("#inputMaeTwo").val(selectedItemValue).trigger("change");
    },
    onHideListEvent: function() {
        $("#inputMaeTwo").val(selectedItemValue).trigger("change");
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
  $("#inputMae").easyAutocomplete(options2);
</script>
