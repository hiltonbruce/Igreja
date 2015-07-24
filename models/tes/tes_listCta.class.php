<?PHP
class tes_listCta {

    protected $campo_retorno;
    protected $texto_field;

    function __construct ( $campo_retorno= "", $texto_field=""){

        $this->tabela = 'contas';//
        $this->campo_retorno = $campo_retorno;//Campo que serï¿½ retornado
        $this->texto_field = $texto_field;//O nome que serï¿½ relaciondo ao campo de retorno para envio pelo form
        $this->query = "SELECT * from {$this->tabela} ";

        $this->sql_lst = mysql_query($this->query.' WHERE acesso="0" ORDER BY codigo');
    }

    function List_Selec_pop ($link,$id){
    //Lista Select para uso com javascrip popup
    //Mostra as linhas de select
    $linha1='';
    $linhas .="<option value='./?$link{$this->col_lst["id"]}'>Todas</option>";

        while($this->col_lst = mysql_fetch_array($this->sql_lst))
        {
            if ($this->col_lst["id"]==$id) {
                $linha1  = "<option value='./?$link{$this->col_lst["id"]}'>".$this->col_lst['codigo'].' &bull; '.$this->col_lst[$this->campo_retorno]."</option>";
                $cod = $this->col_lst['codigo'];
            }
             $linhas .="<option value='./?$link{$this->col_lst["id"]}'>".$this->col_lst['codigo'].' &bull; '.$this->col_lst[$this->campo_retorno]."</option>";
        }

        return array($linha1.$linhas,$cod);
    }
}

?>
