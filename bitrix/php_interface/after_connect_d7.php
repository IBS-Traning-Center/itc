<?php
/* Ansible managed */
$connection = \Bitrix\Main\Application::getConnection();

$connection->queryExecute("SET NAMES 'utf8'");
$connection->queryExecute("SET collation_connection = 'utf8_unicode_ci'");
$connection->queryExecute("SET innodb_strict_mode=0");
$connection->queryExecute("SET sql_mode=''");