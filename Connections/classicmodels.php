<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_classicmodels = "localhost";
$database_classicmodels = "classicmodels";
$username_classicmodels = "root";
$password_classicmodels = "root";
$classicmodels = mysql_pconnect($hostname_classicmodels, $username_classicmodels, $password_classicmodels) or trigger_error(mysql_error(),E_USER_ERROR); 
?>