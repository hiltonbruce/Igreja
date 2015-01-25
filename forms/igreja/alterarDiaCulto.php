<td>
     <?php
          if ($_GET['campo']!='cultos') {

               $frase  = $igreja->cultos();
               $numDias = array(1, 2, 3, 4, 5, 6, 7);
               $nomeDias   = array('Segundas','Ter&ccedil;as','Quartas','Quintas','Sextas','S&aacute;bados','Domingos' );
               $diasDeCulto = str_replace($numDias, $nomeDias, $frase);
               $diasDeCulto = ($diasDeCulto=='') ? 'Adicione os dias de Culto... Aqui!':$diasDeCulto;
              echo '<p><a href="./?escolha='.$tab_edit.'cultos">&nbsp;'.$diasDeCulto.'&nbsp;</a></p>';
          }else {

          list($culto1,$culto2,$culto3,$culto4) = explode('-', $igreja->cultos());
          $mak ='mak'.$culto1;
          $$mak = ($culto1>0) ? 'checked="checked"' : '' ;
          $mak ='mak'.$culto2;
          $$mak = ($culto2>0) ? 'checked="checked"' : '' ;
          $mak ='mak'.$culto3;
          $$mak = ($culto3>0) ? 'checked="checked"' : '' ;
          $mak ='mak'.$culto4;
          $$mak = ($culto4>0) ? 'checked="checked"' : '' ;
     ?>
     <form method='post' action='' id='culto'>
          <label class="checkbox">
               <input type="checkbox" autofocus='autofocus' id="dia" name="culto1" <?php echo $mak7;?> value="7" tabindex = "<?php echo ++$ind; ?>" >Domingo</label></td>
          <td><label class="checkbox">
               <input type="checkbox" id="dia" name="culto2" <?php echo $mak1;?> value="1" tabindex = "<?php echo ++$ind; ?>" >Segunda</label></td>
          <td><label class="checkbox">
               <input type="checkbox" id="dia" name="culto3" <?php echo $mak2;?> value="2" tabindex = "<?php echo ++$ind; ?>" >Ter&ccedil;a</label></td>
          <td><label class="checkbox">
               <input type="checkbox" id="dia" name="culto4" <?php echo $mak3;?> value="3" tabindex = "<?php echo ++$ind; ?>" >Quarta</label></td>
          <td><label class="checkbox">
               <input type="checkbox" id="dia" name="culto5" <?php echo $mak4;?> value="4" tabindex = "<?php echo ++$ind; ?>" >Quinta</label></td>
          <td><label class="checkbox">
               <input type="checkbox" id="dia" name="culto6" <?php echo $mak5;?> value="5" tabindex = "<?php echo ++$ind; ?>" >Sexta</label></td>
          <td><label class="checkbox">
               <input type="checkbox" id="dia" name="culto7" <?php echo $mak6;?> value="6" tabindex = "<?php echo ++$ind; ?>" >S&aacute;bado</label></td>
          <td><label class="checkbox">
          <td><input name='escolha' type='hidden' value='sistema/atualizar_rol.php' />
          <input name='tabela' type='hidden' value='igreja' />
          <input name='id' type='hidden' value='<?php echo $igreja->rol();?>' />
          <input name='campo' type='hidden' value='cultos' />
          <input type='submit' class='btn btn-primary btn-sm' name='Submit' value='Alterar' tabindex='{++$ind}' />
     </form>
     <?php
     }
     ?>
</td>
