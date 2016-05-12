ALTER TABLE `eventos` DROP `tipo`, DROP `igreja`, DROP `setor`;

ALTER TABLE `agsercretaria` ADD `tipo` INT NOT NULL COMMENT '0-Desativo, 1-Data fixa, 2-frequência semanal, 3-frequência quinzenal, 4-frequência mensal, 5-frequência semestral, 6-frequência anual, 7-frequência bianual' AFTER `evento`;