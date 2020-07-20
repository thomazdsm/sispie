<html>
<head>
	<meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
</head>
<body>
<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/SisPie/Class/Others/verificacao.php";
session_start(); 
if (!sessaoAtiva())
{
	header('Location: http://'.$_SERVER['SERVER_NAME'] .':/SisPie/');
}
else
{
	if (isset($_SESSION["tabelaFERRXLS1"]))
	{ 
		$htmlTabela = $_SESSION["tabelaFERRXLS1"];
		
		//formata a imagem para o excel
		$htmlTabela = str_replace("logo_vale.jpg","logo_vale_xls.jpg",$htmlTabela);
		
		header("Content-type: application/vnd.ms-excel");     
		header("Content-type: application/force-download");     
		header("Content-Disposition: attachment; filename=Relatorio_Inscritos.xls");     
		header("Pragma: no-cache"); 
		header("Expires: 0");
		
		echo $htmlTabela;
		exit();
	}
	else
	{
		echo "N&atilde;o foi poss&iacute;vel exportar os dados para o Excel.";
		exit();
	}
}
?>   
</body>
</html>