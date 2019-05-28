<?php
  $igreja = (empty($_GET['igreja'])) ? 1 : intval($_GET['igreja']) ;
 ?>
<link href="css/easy-autocomplete.min.css" rel="stylesheet" type="text/css">
<link href="css/easy-autocomplete.themes.min.css" rel="stylesheet" type="text/css">
<script src="js/jquery-1.11.2.min.js"></script>
<script src="js/jquery.easy-autocomplete.min.js" type="text/javascript" ></script>

<div class="row">
  <div class="col-xs-9"><label>Nome:</label>
    <input type="text" id="inputOne" class="form-control" autofocus="autofocus" tabindex="<?php echo ++$ind;?>"
		 name="nome" placeholder="Nome, sobrenome ou partes deles para procurarmos, a partir de 2 caracteres!">
  </div>
  <div class="col-xs-3"><label>Rol:</label>
    <input type="text" id="inputTwo" class="form-control" tabindex="<?php echo ++$ind;?>"
		 name="rol" placeholder="N&ordm; do Rol de membro">
  </div>
</div>


		<!-- <input id="inputOne" placeholder="X-men character" class="form-control" /><br ><br ><br ><br ><br ><br ><br ><br ><br ><br ><br ><br >
		<input id="inputTwo" placeholder="Real name" class="form-control" /> -->

		<script>

		var options = {

    // url: "resources/xmen.json",
		// data:   [
    //   {"character": "Cyclops", "realName": "Scott Summers", "icon": "http://lorempixel.com/100/50/transport/2"},
    //   {"character": "Professor X", "realName": "Charles Francis Xavier", "icon": "http://lorempixel.com/100/50/transport/8"},
    //   {"character": "Mystique", "realName": "Raven Darkholme", "icon": "http://lorempixel.com/100/50/transport/10"},
    //   {"character": "MagnetoAg", "realName": "Max Eisenhardt", "icon": "http://lorempixel.com/100/50/transport/1"},
    //   {"character": "Storm", "realName": "Ororo Monroe", "icon": "http://lorempixel.com/100/50/transport/6"},
    //   {"character": "Hi­lton_", "realName": "Joseilton C Bruce", "icon": "http://lorempixel.com/100/50/transport/10"},
    //   {"character": "Wolverineag", "realName": "James Howlett", "icon": "http://lorempixel.com/100/50/transport/8"}],

		url: function(phrase) {
				return "models/AutocompleteEasy.php?q=" + phrase + "&igreja=" + "<?php echo $igreja;?>";
			},

    getValue: function(element) {
        return element.nome;
			},

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
					time: 400,
					callback: function() {}
				},

				hideAnimation: {
					type: "slide", //normal|slide|fade
					time: 400,
					callback: function() {}
				},
				maxNumberOfElements: 10,
				match: {
						enabled: false
					}
	    },

		 template: {
				 type: "custom",
				 method: function(value, item) {
					 return  (item.icon) + (item.nome) + " - " + (item.rol) + " - "+(item.razao);
				 }
			 },
		 theme: "round"
	};

	$("#inputOne").easyAutocomplete(options);

		</script>
