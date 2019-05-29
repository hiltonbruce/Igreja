<?php
  $igreja = (empty($_GET['igreja'])) ? 1 : intval($_GET['igreja']) ;
 ?>
<link href="css/easy-autocomplete.min.css" rel="stylesheet" type="text/css">
<link href="css/easy-autocomplete.themes.min.css" rel="stylesheet" type="text/css">
<!-- <link href='//fonts.googleapis.com/css?family=Roboto:400,300,300italic,400italic,600,600italic&amp;subset=latin,cyrillic-ext,greek-ext,latin-ext,cyrillic' rel='stylesheet' type='text/css'> -->
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
		<script>

		var options = {

		url: function(phrase) {
				return "models/AutocompleteEasy.php?q=" + phrase + "&igreja=" + "<?php echo $igreja;?>";
			},

    getValue: "nome",

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
					 return  item.icon + " &bull; " + value + " - " + item.rol + " - " + item.razao;
				 }
			 },
		 theme: "round"
	};

	$("#inputOne").easyAutocomplete(options);

		</script>
