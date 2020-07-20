<?php

    include $_SERVER["DOCUMENT_ROOT"] . "/SisPie/Class/Others/verificacao.php";

	//include $_SERVER["DOCUMENT_ROOT"] . "/SisPie/Class/Others/retornoValores.php";
	
	$tabela=$_GET['tabela'];
	$remetente=$_GET['remetente'];
	$cidade=$_POST['cidade'];  //--> nome da cidade
    //$where=1;
    
	$objDB = new db();
    $objDB->consulta = "SELECT * FROM neperge_db.cidade WHERE cidade like '$cidade' ORDER BY cidade";
    if ($objDB->connectDB()){

		$resultado = $objDB->executeSQL($objDB->consulta);
		
		if(!$resultado){
			echo "Nao foi possivel realizar a consulta ao banco de dados: " . $resultado;
			exit();
		}else{
			while ($linha = mysql_fetch_assoc($resultado)){						
				$N_cidade = $linha['id'];
			}	
		}
	}else{
		echo "Nao foi possivel conectar ao banco de dados.";
		exit();
    }
    
    //$N_cidade = 8;

	$objDB = new db();
	$objDB->consulta = "SELECT * FROM neperge_db.curso WHERE id_campus like '$N_cidade' ORDER BY curso";

	if ($objDB->connectDB()){

		$resultado = $objDB->executeSQL($objDB->consulta);
		
		if(!$resultado){
			echo "Nao foi possivel realizar a consulta ao banco de dados: " . $resultado;
			exit();
		}else{
			echo'<option value="">Selecione o Curso...</option>';
			while ($linha = mysql_fetch_assoc($resultado)){						
				echo "<option value='" . $linha['curso']. "'>" . $linha['curso'];
			}	
		}
	}else{
		echo "Nao foi possivel conectar ao banco de dados.";
		exit();
	}

?>