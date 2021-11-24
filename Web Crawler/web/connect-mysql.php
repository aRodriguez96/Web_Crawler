<?php

DEFINE ('DB_USER', 'username');
DEFINE ('DB_PSWD', 'password');
DEFINE ('DB_HOST', 'ip');
DEFINE ('DB_NAME', 'name');


$dbcon = mysqli_connect(DB_HOST, DB_USER, DB_PSWD, DB_NAME);

?>


