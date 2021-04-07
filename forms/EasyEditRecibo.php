<?php
$igreja = (empty($_GET['igreja'])) ? 1 : intval($_GET['igreja']);
?>
<script src="js/jquery-1.11.2.min.js"></script>
<script src="js/jquery.easy-autocomplete.min.js" type="text/javascript"></script>


<form id="form1" name="form1" method="post" action="">
    <div class="row">
        <div class="col-xs-4">
            <input type="hidden" name="escolha" value="sistema/atualizar_sistema.php"> <!-- indica o script que receber? os dados -->
            <input type="hidden" name="tabela" value="tes_recibo">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="hidden" name="campo" value="recebeu">
            <label>Nome do Beneficiado:</label>
        </div>
        <div class="col-xs-2">
            &nbsp;           
        </div>
        <div class="col-xs-2">
            <label>Rol:</label>
        </div>
        <div class="col-xs-2">
            &nbsp;
        </div>

    </div>
    <div class="row">
        <div class="col-xs-4">
            <input type="text" id="inputOne" class="form-control" autofocus="autofocus" tabindex="<?php echo ++$ind; ?>" 
            name="nomerecebeu" value="<?php echo $recebeu; ?>">
        </div>
        <div class="col-xs-2">
            &nbsp;           
        </div>
        <div class="col-xs-2">
            <input type="text" id="inputTwo" class="form-control" tabindex="<?php echo ++$ind; ?>" 
            value="<?php echo $rec_alterar->recebeu(); ?>" name="recebeu" placeholder="N&ordm; do Rol de membro">
        </div>
        <div class="col-xs-2">
            <input type="submit" class="btn btn-primary btn-sm" name="Submit" value="Alterar..." tabindex="3">
        </div>
    </div>
</form>

<script>
    var options = {

        url: function(phrase) {
            return "models/AutocompleteEasy.php?q=" + phrase + "&igreja=" + "<?php echo $igreja; ?>";
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
                return item.icon + " &bull; " + item.nome + ' Rol: ' + item.rol + item.razao + item.situacao_espiritual;
            }
        },
        // theme: "round"
    };

    $("#inputOne").easyAutocomplete(options);
</script>