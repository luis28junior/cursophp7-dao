<?php
require_once ('config.php');

/*
$sql = new Sql();

$usuarios = $sql->select('SELECT * FROM user');
echo json_encode($usuarios);

*/

// ---------------- instancia o usuario
//$user = new Usuario();
// ---------------- busca um determinado usuario
//$user->loadById(7);

//$list = Usuario::Search('hotmail.com');
//echo json_encode($list);

$user = new Usuario();
$user->login("luis1@hotmail.com", "123");
echo  $user;


 ?>