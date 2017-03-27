<?php 
class Usuario{

	private $id;
	private $name;
	private $email;
	private $senha;
	private $dtcadastro;

	public function getId():int{
		return $this->Id;
	}

	public function setId($value){
		$this->Id = $value;
	}

	public function getName():string{
		return $this->name;
	}

	public function setName($value){
		$this->name = $value;
	}

	public function getEmail():string{
		return $this->email;
	}

	public function setEmail($value){
		$this->email = $value;
	}

	public function getSenha():string{
		return $this->senha;
	}

	public function setSenha($value){
		$this->senha = $value;
	}

	public function getDtcadastro(){
		return $this->dtcadastro;
	}

	public function setDtcadastro($value){
		$this->dtcadastro = $value;
	}

	public function loadById($id){
		$sql = new Sql();
		$results = $sql->select("SELECT * FROM user WHERE id = :ID", array("ID"=>$id));

		if(isset($results[0])){

			$row = $results[0];
			$this->setId($row['id']);
			$this->setName($row['name']);
			$this->setEmail($row['email']);
			$this->setSenha($row['pass']);
			$this->setDtcadastro(new DateTime($row['dtcadastro']));

		}

	}

	public function __toString(){
		return json_encode(array(
			"id"=>$this->getId(),
			"name"=>$this->getName(),
			"email"=>$this->getEmail(),
			"senha"=>$this->getSenha(),
			"dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s")
			));
	}

}

?>