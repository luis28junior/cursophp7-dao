<?php
require_once ('config.php');

/*
$sql = new Sql();

$usuarios = $sql->select('SELECT * FROM user');
echo json_encode($usuarios);

*/


$user = new Usuario();
$user->loadById(7);
echo $user;

 ?>