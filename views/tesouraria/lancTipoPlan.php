<strong><?php echo $titTabela;?></strong>

			<?php
				echo $nivel1;
			?>

<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript">
//<![CDATA[

	$(document).ready(function() {
		var mais = '<a href="#"><img src="img/mais.gif" alt="Revelar/ocultar" class="maismenos" /></a>'
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
					$(this).parents('tbody').siblings('tbody')
					.children('tr:not(tr.sub)').hide()
					$('.maismenos').attr('src', 'img/mais.gif')
					$(this).attr('src', 'img/menos.gif')
					.parents().siblings('tr').show();
					};
			});
		});
// ]]>
</script>
