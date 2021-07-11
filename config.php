<?php

define('DB_SERVER', 'localhost');
define('DB_EMAIL',' root');
define('DB_PASSWORD', '');
define('DB_NAME', 'login');


$con = mysqli_connect(DB_SERVER,DB_EMAIL,DB_PASSWORD,DB_NAME);

if($con == false){
    dir('Error:cannot connect');
}
?>