<?php 
class Usuario{

	private $id;
	private $name;
	private $email;
	private $senha;
	private $dtcadastro;

	public function getId():string{
		return $this->id;
	}

	public function setId($value){
		$this->id = $value;
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

	public function __construct($name = '', $email = '', $pass = ''){
		$this->setName($name);
		$this->setEmail($email);
		$this->setSenha($pass);
	}

	public function loadById($id){
		$sql = new Sql();
		$results = $sql->select("SELECT * FROM user WHERE id = :ID", array("ID"=>$id));

		if(isset($results[0])){
			$this->setData($results[0]);
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


	public static function search($email){
		$sql = new Sql();
		return $sql->select ("select * from user where email like :EMAIL order by name", array('EMAIL'=> '%'. $email . '%'));
	}

	public static function getList(){
		$sql = new Sql();		
		return $sql->select('SELECT * FROM user Order by id');
	}


	public function login($user, $pass) {
		$sql = new Sql();
		$results = $sql->select("SELECT * FROM user WHERE email = :EMAIL and pass = :SENHA", 
			array("EMAIL"=>$user,
				"SENHA"=>$pass));

		if(isset($results[0])){
			$this->setData($results[0]);
		}else {
			throw new Exception("Login e/ ou Senha Inválidos", 1);
			
		}
	}

	public function setData($data){
		$this->setId($data['id']);
		$this->setName($data['name']);
		$this->setEmail($data['email']);
		$this->setSenha($data['pass']);
		$this->setDtcadastro(new DateTime($data['dtcadastro']));
	}

	public function insert(){
		$sql = new Sql();
		$results = $sql->select("CALL sp_usuarios_insert(:NAME, :EMAIL, :SENHA)", array(
			'NAME'=>$this->getName(),
			'EMAIL'=>$this->getEmail(),
			'SENHA'=>$this->getSenha()));

		if(isset($results)){
			$this->setData($results[0]);
		}
	}

	public function update($name, $login, $pass){
		$this->setName($name);
		$this->setEmail($login);
		$this->setSenha($pass);

		var_dump($this);


		$sql = new Sql();
		$sql->query("UPDATE user SET ( name = :NOME, email = :EMAIL, pass = :SENHA WHERE id = :ID)", array(
			'NOME'=>$this->getName(),
			'EMAIL'=>$this->getEmail(),
			'SENHA'=>$this->getSenha(),
			'ID'=>$this->getId()));
	}

	public function delete(){
		$sql = new Sql();
		$sql->query("DELETE FROM user WHERE id = :ID", array("ID"=>$this->getId()));

		$this->setId(0);
		$this->setName("");
		$this->setEmail("");
		$this->setSenha("");
		$this->setDtcadastro(new DateTime());
	}
}

?>