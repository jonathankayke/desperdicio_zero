<?php
$hostname_conn  =   "localhost";
$database_conn  =   "desperdicio_zero";
$username_conn  =   "desperdicio_zero";
$password_conn  =   "1234";
$charset_conn   =   "utf8";

$conn_alimentos =   new mysqli($hostname_conn, $username_conn, $password_conn, $database_conn);

mysqli_set_charset($conn_alimentos,$charset_conn);


?>