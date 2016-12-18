<?php
require("config.php");
require("./lang/lang.admin." . LANGUAGE_CODE . ".php");

mysql_connect(DB_HOST, DB_USER, DB_PASS) or die(mysql_error());
mysql_select_db(DB_NAME) or die(mysql_error());

mysql_query("CREATE TABLE " . DB_TABLE_PREFIX . "mssgs (
  id mediumint(5) unsigned NOT NULL auto_increment,
  uid tinyint(3) unsigned NOT NULL default '0',
  m tinyint(2) NOT NULL default '0',
  d tinyint(2) NOT NULL default '0',
  y smallint(4) NOT NULL default '0',
  start_time time NOT NULL default '00:00:00',
  end_time time NOT NULL default '00:00:00',
  title varchar(50) NOT NULL default '',
  text text NOT NULL,
  PRIMARY KEY  (id)
) ENGINE=InnoDB") or die(mysql_error());

mysql_query("create index id on " . DB_TABLE_PREFIX . "mssgs (id)");
mysql_query("create index m on " . DB_TABLE_PREFIX . "mssgs (m)");
mysql_query("create index y on " . DB_TABLE_PREFIX . "mssgs (y)");

mysql_query("CREATE TABLE " . DB_TABLE_PREFIX . "users (
  uid smallint(6) NOT NULL auto_increment,
  username char(15) NOT NULL default '',
  password char(32) NOT NULL default '',
  fname char(20) NOT NULL default '',
  lname char(30) NOT NULL default '0',
  userlevel tinyint(2) NOT NULL default '0',
  email char(40) default NULL,
  PRIMARY KEY  (uid)
) ENGINE=InnoDB") or die(mysql_error());

mysql_query("create index uid on " . DB_TABLE_PREFIX . "mssgs (uid)");

mysql_query("INSERT INTO " . DB_TABLE_PREFIX . "users 
	VALUES (
	'', 'admin', 'admin', 'default', 'user', 2, ''
	)") or die (mysql_error());

echo $lang['successfulinstall'];
?>