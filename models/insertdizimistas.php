<?php

controle ('admin_user');

$dados = mysql_query ("SELECT m.rol AS rol, m.nome AS nome, e.congregacao AS igreja FROM membro AS m, eclesiastico AS e WHERE m.rol = e.rol AND e.situacao_espiritual<'3'");

while ($row = mysql_fetch_array($dados)) {
	print 'Rol: '.$row['rol'].' - '.$row['nome'].' - '.$row['igreja'].'<br/>';
   $inserir = mysql_query ("INSERT INTO dizimistas VALUES (NULL, '{$row['rol']}', '{$row['nome']}', '{$row['igreja']}', NOW(), 'Joseilton')");
}

