<?php
    $selec  = '<option>Filtrar Semana...</option>';
    $selec1 = '<option value="1">1&ordf; Semana</option>';
    $selec2 = '<option value="2">2&ordf; Semana</option>';
    $selec3 = '<option value="3">3&ordf; Semana</option>';
    $selec4 = '<option value="4">4&ordf; Semana</option>';
    $selec5 = '<option value="5">5&ordf; Semana</option>';
    if ($i>'0') {
         $seqSelec  = 'selec'.$i; //Primeira opção da sequência
    } else {
        $seqSelec  = '';
    }
    $corpSelec = $$seqSelec.$selec.$selec1.$selec2.$selec3.$selec4.$selec5.'</select>';
    $ent01 = '<label>'.$i.'&ordf; Entrada</label>';
    $ent01 = '<select name="semana" class="form-control" tabindex="'.++$ind.'"  >'.$corpSelec;
?>
