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

//$user = new Usuario();
//$user->login("luis1@hotmail.com", "123"); //Login
//echo $user;


//--------- INSERE NOVO REGISTRO -----------------
/*
$aluno = new Usuario('Jose2', 'jose@hotmail.com', '12345');
$aluno->insert();
echo  $aluno;

*/



$prof = new Usuario();
$prof->loadById(9);
$prof->update('Teste 123', 'teste@teste.com.br', '1234');

echo $prof;

 ?>