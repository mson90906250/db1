<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_cdb1 = "localhost";
$database_cdb1 = "db1";
$username_cdb1 = "admin";
$password_cdb1 = "123456";
$cdb1 = mysql_pconnect($hostname_cdb1, $username_cdb1, $password_cdb1) or trigger_error(mysql_error(),E_USER_ERROR); 
mysql_query("SET NAMES UTF8");
?>