<?php
class Sql extends PDO{

	/* informações de conexão */
	private $host = 'localhost';
	private $user = 'root'; 
	private $password = '';
	private $database = 'bdexemplomysqli';

	private $conexao;

	/* -------------------- PUBLIC METHODS ------------------------*/

	public function __construct(){//Ao iniciar a classe, já conecta com o banco de dados
		$this->conexao = new PDO("mysql:host=$this->host;dbname=$this->database", $this->user, $this->password);
	}

	public function query($rawQuery, $params = array()){
		$statement = $this->conexao->prepare($rawQuery); //Prepara o SQL para ser utilizado (rawQuery);		
		$this->setParams($statement, $params); //Realiza um bindParam nos dados passados como parametro;
		$statement->execute(); //Executa o statement;		
		return $statement;
	}

	public function select($rawQuery, $params = array()):array{
		$statement = $this->query($rawQuery, $params); //Chama classe query, que prepara o sql e ja executa o statement;
		return $statement->fetchAll(PDO::FETCH_ASSOC); //Obtem o fetchAll e retorna o resultado do select;
	}

	/* -------------------- PRIVATE METHODS ------------------------*/
	private function setParam($statement, $key, $value){ //Adiciona um unico parametro por vez;
		$statement->bindParam($key, $value); //Prepara os valores do SQL com os valores passados por parametros;
	}

	private function setParams($statement, $parameters = array()){//Adiciona um array de parametros em determinado statement;
		foreach ($parameters as $key => $value) {//percorre array de parametros;
			$this->setParam($statement, $key, $value);//Adiciona parametro ao campo do filtro da consulta;
		}
	}

}


?>