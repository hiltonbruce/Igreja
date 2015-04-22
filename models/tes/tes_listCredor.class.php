<?php
/**
*
*/
class tes_listCredor extends List_sele
{

    function List_Selec ($seq,$item,$required){

        $linha1  =  "<select name='{$this->texto_field}' id='{$this->texto_field}' $required tabindex='$seq'>";
        if ($item<1) {
            $linha1 .=  "<option value=''>-->> Escolha <<--</option>";
        }else {
            $linhas =  "<option value='0'>-->> Todas <<--</option>";
        }

        $linhas .= '';

           while($this->col_lst = mysql_fetch_array($this->sql_lst))
           {
            $credor = $this->col_lst['cnpj_cpf'].' - '.$this->col_lst[$this->campo_retorno];
            if ($this->col_lst["rol"]=='') {
                if ($item==$this->col_lst["id"]) {
                    $linha1 .=  "<option value='".$credor."'>".$this->col_lst[$this->campo_retorno]."</option>";
                }
                $linhas .= "<option value='".$credor."'>".$this->col_lst[$this->campo_retorno]."</option>";
            }else {
                if ($item==$this->col_lst["rol"]) {
                    $linha1 .=  "<option value='".$credor."'>".$this->col_lst[$this->campo_retorno]."</option>";
                }
                $linhas .= "<option value='".$credor."'>".$this->col_lst[$this->campo_retorno]."</option>";
            }
           }
        $linha3 = "</select>";

      return $linha1.$linhas.$linha3 ;
    }
}

?>
