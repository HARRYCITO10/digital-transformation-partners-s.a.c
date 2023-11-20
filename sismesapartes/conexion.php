<?php

$servidor="localhost";
$db="dbmesapartes";
$user="root";
$password="";

try {
    $conexion = new PDO("mysql:host=$servidor;dbname=$db",$user,$password);
    
} catch (Exception $ex) {
    echo $ex->getMessage();
  
}



?>