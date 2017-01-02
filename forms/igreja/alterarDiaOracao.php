     <?php
          if ($_GET['campo']!='oracao') {
               $frase  = $igreja->oracao();
               $numDias = array(1, 2, 3, 4, 5, 6, 7);
               $nomeDias   = array('Todos os Domingos','Todas as Segundas','Todas as Ter&ccedil;as',
                    'Todas as Quartas','Todas as Quintas','Todas as Sextas','Todos os S&aacute;bados' );
               $diasDeOracao = str_replace($numDias, $nomeDias, $frase);
               $diasDeOracao = ($diasDeOracao=='') ? 'Adicione o dia do Circulo de Ora&ccedil;&atilde;o... Aqui!':$diasDeOracao;
              echo '<p><a href="./?escolha='.$tab_edit.'oracao">&nbsp;'.$diasDeOracao.'&nbsp;</a></p>';
          }else {
          list($Oracao1,$Oracao2,$Oracao3,$Oracao4) = explode('-', $igreja->oracao());
          $mak ='mak'.$Oracao1;
          $$mak = ($Oracao1>0) ? 'checked="checked"' : '' ;
          $mak ='mak'.$Oracao2;
          $$mak = ($Oracao2>0) ? 'checked="checked"' : '' ;
          $mak ='mak'.$Oracao3;
          $$mak = ($Oracao3>0) ? 'checked="checked"' : '' ;
          $mak ='mak'.$Oracao4;
          $$mak = ($Oracao4>0) ? 'checked="checked"' : '' ;
     ?>
     <form method='post' action='' id='Oracao' class=''><p>
          <label class="radio-inline">
          <input type="radio" id="dia" name="oracao" <?php echo $mak2;?> value="2" tabindex = "<?php echo ++$ind; ?>" >Segunda</label>
          <label class="radio-inline">
          <input type="radio" id="dia" name="oracao" <?php echo $mak3;?> value="3" tabindex = "<?php echo ++$ind; ?>" >Ter&ccedil;a</label>
          <label class="radio-inline">
          <input type="radio" id="dia" name="oracao" <?php echo $mak4;?> value="4" tabindex = "<?php echo ++$ind; ?>" >Quarta</label>
          <label class="radio-inline">
          <input type="radio" id="dia" name="oracao" <?php echo $mak5;?> value="5" tabindex = "<?php echo ++$ind; ?>" >Quinta</label>
          <label class="radio-inline">
          <input type="radio" id="dia" name="oracao" <?php echo $mak6;?> value="6" tabindex = "<?php echo ++$ind; ?>" >Sexta</label>
          <label class="radio-inline">
          <input type="radio" id="dia" name="oracao" <?php echo $mak7;?> value="7" tabindex = "<?php echo ++$ind; ?>" >S&aacute;bado</label>
          <input name='escolha' type='hidden' value='sistema/atualizar_rol.php' />
          <input name='tabela' type='hidden' value='igreja' />
          <input name='id' type='hidden' value='<?php echo $igreja->rol();?>' />
          <input name='campo' type='hidden' value='oracao' />
          <input type='submit' class='btn btn-primary btn-sm' name='Submit' value='Alterar' tabindex='{++$ind}' /></p>
     </form>
     <?php
     }
     ?>
