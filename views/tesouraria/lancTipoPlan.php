<strong><?php echo $titTabela;?></strong>
<table id="horario"  class="table table-bordered">
		<colgroup>
				<col id="Acesso">
				<col id="Historico">
				<col id="Igreja">
				<col id="Valor">
			</colgroup>
			<?php
				echo $nivel1;
			?>
		<tfoot>
			<?php
				echo '<tr id="total">';
				echo '<td colspan="3" id="moeda" ></td><td><button class="btn btn-primary">Lan&ccedil;ar!</button></td></tr>';

			?>
		</tfoot>
	</table>
</div>
<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript">
//<![CDATA[

	$(document).ready(function() {
		var mais = '<a href="#"><img src="img/mais.gif" alt="Revelar/ocultar cidades" class="maismenos" /></a>'
			$('table#horario tbody tr:not(.sub):even').addClass('impar');
			$('table#horario tbody tr:not(.sub)').hide();
			$('.sub th').css({borderBottom: '1px solid #333'}).prepend(mais);
				$('img', $('.sub th'))
					.click(function(event){
						event.preventDefault();
						if (($(this).attr('src')) == 'img/menos.gif'){
						$(this).attr('src', 'img/mais.gif')
						.parents()
						.siblings('tr').hide();
						} else {
						$(this).attr('src', 'img/menos.gif')
						.parents().siblings('tr').show();
						};
				});
		});
// ]]>
</script>
