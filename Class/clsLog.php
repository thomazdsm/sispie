<?php
include_once "db.php";

class clsLog extends db{
	private $id;
	private $acao;
	private $idUsuario;
	private $ip;
	private $host;
	
	function setAcao($acao){
		$this->acao = $acao;
	}

	function setIDUsuario($idUsuario){
		$this->idUsuario = $idUsuario;
	}
	
	function insereLog(){
		$objDB = new db();
		
		$ip = $_SESSION["ip_GENERICO"];
		$host = $_SESSION["host_GENERICO"];
	
		if ($objDB->connectDB()){
			$sequencia = $objDB->getSequence("log");
			$objDB->consulta = 'INSERT INTO log VALUES(' . $sequencia . ',"' . $this->acao . '",NOW(),' . $this->idUsuario.',"' . $ip . '","' . $host . '")';
			$resultado = $objDB->executeSQL($objDB->consulta);
			//echo $objDB->consulta;
		}	
	}
}
?>