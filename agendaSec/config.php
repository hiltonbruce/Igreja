<?php
/*******************************************************
* config.php -
* 	Arquivo de configuração para o WESPA Calendário v0.2
* 	Autor: WESPA Digital <info@wespa.com.br>
*
* 	Configuration directives set with php's define()
* 	function.  Usage: define("CONSTANT-ID",
*	"scalar_value")
*
* Para perguntas ou comentários, visite:
* 	http://www.wespa.com.br
*******************************************************/

/*******************************************************
***** Configurações do Banco de Dados MySQL ***********

define("DB_NAME", "assembleia");				// nome do banco de dados
define("DB_USER", "root");				// nome de usuário no banco de dados
define("DB_PASS", "x9735pla");				// senha do banco de dados
define("DB_HOST", "localhost");			// servidor de banco de dados
*******************************************************/

// Prefixo adicionado aos nomes de tabelas. Não autere após
// a instalação inicial.
define("DB_TABLE_PREFIX", "agenda");

/*******************************************************
************** Opções Idiomáticas *********************
*******************************************************/

define("LANGUAGE_CODE", "pt");

/*******************************************************
********* Opções Visuais do WESPA Calendário ************
*******************************************************/

// Define o número máximo de eventos a serem visualizados
// no dia, na tabela do mês.
define("MAX_TITLES_DISPLAYED", 10);

// Limite de caracteres para o título. Ajuste este evento
// quando os títulos forem muito grandes e precise de
// mais espaço para exibilos no calendário.
define("TITLE_CHAR_LIMIT", 100);

// Nome do modelo.  e.g. "default" se o arquivo
// que contém o modelo visual for "default.php".
define("TEMPLATE_NAME", "default");

// Especifica o dia em que começa a semana no
// WESPA Calendário.  O valor deve ser numérico
// e é um intervalo 0-6.  Zero indica que a semana
// começa no Domingo, 1 indica que é na Segunda-feira,
// 2 Terça-feira, 3 Quarta-feira... Para a maioria dos
// usuários se utiliza zero.
define("WEEK_START", 1);

// Especifica o formato de exibição da hora.
// Está disponível dois formatos: "12hr" exibe
// horas 1-12 com um am/pm, e "24hr" exibe
// horas 00-23 sem am/pm.
define("TIME_DISPLAY_FORMAT", "24hr");

define("CURR_TIME_OFFSET", 0);
?>
