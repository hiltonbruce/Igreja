<?PHP
require_once("DB.php");
$db = &DB::connect($dns, array());
if (PEAR::isError($db)) {
    die($db->getMessage());
    exit;
}


class DBRecord
{
    /*Exemplo de funcionamento desta classe:
	$rec = new DBRecord ("tabela","op��o","campo"); Aqui ser� selecionado a informa��o do campo da tabela autor igual a op�ao
	print $rec->Name()."\n"; Imprime o valor na tela
	$rec->Name = "Novo Nome"; Aqui � atribuido a esta vari�vel um valor para UpDate
	$rec->Update(); � feita a chamada do m�todo q realiza a atualiza��o no Banco
  */
    var $h;
    var $table;
    var $id;
    var $campo;

    public function DBRecord($table, $id, $campo)
    {
        global $db;
        if (empty($campo)) {
            $campo = "rol";
        }
        $res = $db->query("SELECT * from $table WHERE $campo=?", array($id));
        $res->fetchInto($row, DB_FETCHMODE_ASSOC);
        // var_dump($res );
        $this->{'h'} = $row;
        $this->{'table'} = $table;
        $this->{'id'} = $id;
        $this->campo = $campo;
    }

    public function __call($method, $args)
    {
        //echo "CALL";
        return $this->{'h'}[$method];
    }

    public function cad_organica($ind)
    {
        //Lista subordinado � do script igreja/cad_organica
        $lin = mysql_query("SELECT * from {$this->{'table'}} ORDER BY id_igreja,codigo ");
        $coluna = 0;
        $id_igreja = 0;
        while ($line = mysql_fetch_array($lin)) {
            if (strlen($line[2]) == 4) // Altera a cor de fundo nas contas
                $fd_tab = "bgcolor='#00CCFF'";
            elseif (strlen($line[2]) == 1)
                $fd_tab = "bgcolor='#FFFFCC'";
            elseif (strlen($line[2]) == 13 || strlen($line[1]) == 7) // Altera a cor de fundo nas contas
                $fd_tab = "bgcolor='#00FFFF'";
            elseif (strlen($line[2]) == 7)
                $fd_tab = "bgcolor='#00FFFF'";
            else
                $fd_tab = "";
            if ($id_igreja > 1 && $id_igreja == $line[1]) {
                // </tbody></table>
?>
                <table width="565" border="1" summary="Lista Unidades Oranicas da Igreja.">
                    <caption>
                    </caption>
                    <thead>
                        <tr>
                            <th colspan="2" scope="col">Unidades da Congrega&ccedil;&atilde;o<?php echo " - $id_igreja - line[1]" . $line[1]; ?></th>
                        </tr>Informado
                    </thead>
                    <tfoot>
                        <tr>
                            <td colspan="2"><a href="#">Ocultar/Exibir Unidades - Congre&ccedil;&atilde;o</a></td>
                        </tr>
                    </tfoot>
                    <tbody>
                    <?PHP } elseif ($line[1] == "1" && $id_igreja == 0) {
                    ?>
                        <table width="565" id="" border="1" summary="Lista Unidades Oranicas da Igreja.">
                            <caption>
                            </caption>
                            <thead>
                                <tr>
                                    <th colspan="2" scope="col">Unidades da Sede</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <td colspan="2"><a href="#">Ocultar/Exibir Unidades - SEDE <?php echo " - $id_igreja - line[1]" . $line[1]; ?></a></td>
                                </tr>
                            </tfoot>
                            <tbody>
                <?PHP
                }
                echo "<tr>";
                ++$coluna;
                ++$ind;
                if ((strlen($line[1]) <= 13 && strlen($line[1]) <> 7) || $line[1] == "1.09.00")
                    print("<td title= '$line[4]' $fd_tab >$line[2]</td><td $fd_tab ><input name='subordinado' type='radio' value='$line[2]' tabindex='++$ind;'/>$line[4]</td>");
                else
                    print("<td title= '$line[5]'> $line[4]</td><td>$line[4]</td>");
                echo "</tr>";
                if ($line[1] != $id_igreja) {
                    $id_igreja = $line[1];
                }
                //if ($coluna > 1)  {echo "</tr>";$coluna = 0;echo "<tr>";}
            }
            //echo "</tr>";
            echo "</tbody></table>";
            return $ind;
        }

        public function __get($id)
        {
            //print "Getting $id\n";
            return $this->{'h'}[$id];
        }

        public function __set($id, $value)
        {
            //echo "__set";
            $this->{'h'}[$id] = $value;
        }

        public function Update()
        {
            global $db;
            $fields = array();
            $values = array();
            foreach (array_keys($this->{'h'}) as $key) {
                if ($key != "id") {
                    $fields[] = $key . " = ?";
                    $values[] = $this->{'h'}[$key];
                }
            }
            $fields = join(",", $fields);
            $values[] = $this->{'id'};
            if ($this->campo != '') {
                $sql = "UPDATE {$this->{'table'}} SET $fields WHERE {$this->campo} = ?";
            } else {
                $sql = "UPDATE {$this->{'table'}} SET $fields WHERE rol = ?";
            }
            //echo "$sql";
            $sth = $db->prepare($sql);
            //echo "$sth";
            //   echo var_dump($values);
            $db->execute($sth, $values);
        }
        public function UpdateID()
        {
            global $db;
            $fields = array();
            $values = array();
            foreach (array_keys($this->{'h'}) as $key) {
                if ($key != "id") {
                    $fields[] = $key . " = ?";
                    $values[] = $this->{'h'}[$key];
                }
            }
            $fields = join(",", $fields);
            $values[] = $this->{'id'};
            $sql = "UPDATE {$this->{'table'}} SET $fields WHERE id = ?";
            //echo "$sql";
            $sth = $db->prepare($sql);
            //echo "$sth";
            $db->execute($sth, $values);
        }
        public function Insert()
        {
            global $db;
            $fields = array();
            $values = array();
            foreach (array_keys($this->{'h'}) as $key) {
                $fields[] = " ?";
                $chave[] = $key;
                $values[] = $this->{'h'}[$key];
                echo "$key = {$this->{'h'}[$key]}<br/>";
            }
            $fields = join(",", $fields);
            $chave = join(",", $chave);
            $values[] = $this->{'id'};
            //echo "Valores= {$this->{'id'}}";
            $sql = "INSERT INTO  {$this->{'table'}} $chave VALUES $fields";
            //echo "$sql";
            $sth = $db->prepare($sql);
            //echo "$sth<br/>$fields";
            $db->execute($sth, $values);
        }
        /*
     function __destruct() {
	  echo "$sth \n";
	  //echo "$sql";
     }
     */
    }

                ?>