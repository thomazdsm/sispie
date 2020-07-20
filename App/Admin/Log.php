
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" >
	<title>Login</title>
	
	<!-- CorreÃ§Ã£o bug IE -->
		<style type="text/css">
			input {
    			width: 115px;    
			}
			.ui-dialog-titlebar-close{
		    	display: none;
			}
		</style>
		<!-- Fim da CorreÃ§Ã£o -->		
</head>
<body >
<div id="divBody">
<?php
echo $userId = $_GET['userId'];
echo "<br>";
echo $appId = $_GET['appId'];

include_once $_SERVER["DOCUMENT_ROOT"] . "/Cecom/Funcoes/validacao.php";
echo "<br>";
echo "validacao";
include_once $_SERVER["DOCUMENT_ROOT"] . "/Cecom/Modelo/db.php";
echo "<br>";
echo "db";
include_once $_SERVER["DOCUMENT_ROOT"] . "/Cecom/Modelo/dbuser.php";
echo "<br>";
echo "dbuser";
include_once $_SERVER["DOCUMENT_ROOT"] . "/Cecom/Modelo/clsUsuario.php";
echo "<br>";
echo "clsUsuario";
include_once $_SERVER["DOCUMENT_ROOT"] . "/Cecom/Modelo/clsLog.php";
echo "<br>";
echo "clsLog";
//error_reporting(false);
session_start();
if(isset($_SERVER['HTTP_REFERER']) && isset($_GET['userId']) && isset($_GET['appId'])){
	echo $referrer = $_SERVER['HTTP_REFERER'];
	echo $userId = $_GET['userId'];
	echo $appId = $_GET['appId'];
}	
if(isset($referrer)){
	echo " Pegou ".$referrer." UsuarioId ".$userId;
	if (strrpos($referrer,$_SERVER['SERVER_NAME']) > -1){
		//echo " SERVIDOR ".$_SERVER['SERVER_NAME'];
		//echo " strpos ".strrpos($referrer,$_SERVER['SERVER_NAME']);
		
		//verifica se o acesso ao site foi atravÃ©s de algum link
		$location = "";
		if(isset($_GET["URL"])){
			$location = $_GET["URL"];
		}
		$objDB = new db();		
		if ($objDB->connectDB()){
			$sql = "  SELECT * FROM usuario WHERE data_exclusao IS NULL AND matricula = '$userId' ";
			$objDB->consulta = $sql;
			$resultado = $objDB->executeSQL($objDB->consulta);
			if(!$resultado){
				echo "Não foi possível conectar ao banco de dados.";
				echo exit();
			}else{
				if(mysql_num_rows($resultado) > 0){
					echo " > 0 ";
					$linha = mysql_fetch_assoc($resultado);
		
					//Autentica e registra a sessÃ£o
					$_SESSION["idUsuario_CEC"] = $linha["id"];
					$_SESSION["usuario_CEC"] = $linha["nome"];
					$_SESSION["matricula_CEC"] = $linha["matricula"];
					$_SESSION["email_CEC"] = $linha["email"];
					$_SESSION["ip_CEC"] = $_SERVER['REMOTE_ADDR'];
					$_SESSION["host_CEC"] = gethostbyaddr($_SESSION["ip_CEC"]);
					$_SESSION["inicioSessao_CEC"] = time();					
					$_SESSION["expiraSessao_CEC"] = 9000; //2,5 horas
					
					$_SESSION["appId"] = $_GET['appId'];
					
					///SETA ULTIMO LOGIN
					$sql = "UPDATE usuario SET dt = now() WHERE id = $linha[id]";
					$objDB->consulta = $sql;
					$resultado = $objDB->executeSQL($objDB->consulta);
					//UseracessDataAccess.Insert(DateTime.Now, Convert.ToInt32(ConfigurationManager.AppSettings["APP_ID"].ToString()), Convert.ToInt32(user), IP);
					//Response.Redirect("Default.aspx");
					//ECHO "AUTENTICADO";
					
					$objLog = new clsLog();
					$acao = "Entrou no Sistema Cecom";
					$objLog->setAcao($acao);
					$objLog->setIDUsuario($_SESSION["idUsuario_CEC"]);
					$objLog->insereLog();
					
					header("Location: principal.php");
					
				}else{
					echo " < 0 ";
					$objDBuser = new dbuser();	
					if ($objDBuser->connectDB()){
						$sql = " SELECT * FROM tbuser WHERE id = '$userId' ";
						$objDBuser->consulta = $sql;
						$resultado = $objDBuser->executeSQL($objDBuser->consulta);
						if(!$resultado){
							echo "Não foi possível conectar ao banco de dados.";
							echo exit();
						}else{
							if(mysql_num_rows($resultado) > 0){
								echo " > 0 ";
								$linha = mysql_fetch_assoc($resultado);
								
								$objUsuario = new clsUsuario();
								$objUsuario->setNome($linha["nome"]);
								$objUsuario->setMatricula($linha["id"]);
								$objUsuario->setSenha($linha["senha"]);
								$objUsuario->setEmail($linha["email"]);
								$objUsuario->setIDCargo(0);
								
								/*if($objUsuario->existeAtributo("NOME",$objUsuario->getNome(),-1)){
									echo "Este usu&aacute;rio j&aacute; est&aacute; registrado no banco de dados!";
									exit();
								}
								if($objUsuario->existeAtributo("MATRICULA",$objUsuario->getMatricula(),-1)){
									echo "Esta matr&iacute;cula j&aacute;¡ est&aacute; registrada no banco de dados!";
									exit();
								}
								
								if($objUsuario->existeAtributo("EMAIL",$objUsuario->getEmail(),-1)){
									echo "Esta e-mail j&aacute; est&aacute; registrado no banco de dados!";
									exit();
								}*/
								$res = $objUsuario->insereUsuarioPrimeiroAcesso();
								if($res)
								{
									echo " Entrou.. ";
									$sql = "  SELECT * FROM USUARIO WHERE matricula = '".$objUsuario->getMatricula()."' ";
									$objDB->consulta = $sql;
									$resultado = $objDB->executeSQL($objDB->consulta);
									if(!$resultado){
										echo "Não foi possível conectar ao banco de dados.";
										echo exit();
									}else{
										$linha = mysql_fetch_assoc($resultado);
										echo " Autenticando.. ";
										//Autentica e registra a sessÃ£o
										$_SESSION["idUsuario_CEC"] = $linha["id"];
										$_SESSION["usuario_CEC"] = $linha["nome"];
										$_SESSION["matricula_CEC"] = $linha["matricula"];
										$_SESSION["email_CEC"] = $linha["email"];
										$_SESSION["ip_CEC"] = $_SERVER['REMOTE_ADDR'];
										$_SESSION["host_CEC"] = gethostbyaddr($_SESSION["ip_CEC"]);
										$_SESSION["inicioSessao_CEC"] = time();					
										$_SESSION["expiraSessao_CEC"] = 9000; //2,5 horas
										$_SESSION["appId_CEC"] = $_GET['appId'];
										///SETA ULTIMO LOGIN
										$sql = "UPDATE usuario SET dt = now() WHERE id = $linha[id]";
										$objDB->consulta = $sql;
										$resultado = $objDB->executeSQL($objDB->consulta);
										//UseracessDataAccess.Insert(DateTime.Now, Convert.ToInt32(ConfigurationManager.AppSettings["APP_ID"].ToString()), Convert.ToInt32(user), IP);
										//Response.Redirect("Default.aspx");
										echo "AUTENTICADO";
										
										echo "SESSOES: " 
										.$_SESSION["idUsuario_CEC"]." " 
										.$_SESSION["usuario_CEC"]." "  
										.$_SESSION["matricula_CEC"]." "  
										.$_SESSION["email_CEC"]." "  
										.$_SESSION["ip_CEC"]." "  
										.$_SESSION["host_CEC"]." " 
										.$_SESSION["inicioSessao_CEC"]." "  					
										.$_SESSION["expiraSessao_CEC"]." "  
										.$_SESSION["appId_CEC"]." " ;
										
											$objLog = new clsLog();
											$acao = "Entrou 1º no Sistema Cecom";
											$objLog->setAcao($acao);
											$objLog->setIDUsuario($_SESSION["idUsuario_CEC"]);
											$objLog->insereLog();
										
										if(empty($_POST["URL"]))
										{
											header("Location: principal.php");
										}
										else
										{
											//header("Location: " . $_POST["URL"]);
											header("Location: principal.php");
										}
										exit();	
									}						
								}else{
									echo " NEGOU.. ";
								}
							}else{
								echo "Não foi possível buscar o usuario.";
								echo exit();
							}
						}
					}
				}
			}
		}
		else
		{
				echo "Não foi possível conectar ao banco de dados.";
				echo exit();
		}
	}
	else
	{
		header('Location: http://'.$_SERVER['SERVER_NAME'] .':8080/solucoes_vale/');
	}
}
else
{
	echo " VAZIO ".$referrer;
	header('Location: http://'.$_SERVER['SERVER_NAME'] .':8080/solucoes_vale/');
}


?>

<?php 
/*$indicesServer = array( 'PHP_SELF' , 
'argv' , 
'argc' , 
'GATEWAY_INTERFACE' , 
'SERVER_ADDR' , 
'SERVER_NAME' , 
'SERVER_SOFTWARE' , 
'SERVER_PROTOCOL' , 
'REQUEST_METHOD' , 
'REQUEST_TIME' , 
'REQUEST_TIME_FLOAT' , 
'QUERY_STRING' , 
'DOCUMENT_ROOT' , 
'HTTP_ACCEPT' , 
'HTTP_ACCEPT_CHARSET' , 
'HTTP_ACCEPT_ENCODING' , 
'HTTP_ACCEPT_LANGUAGE' , 
'HTTP_CONNECTION' , 
'HTTP_HOST' , 
'HTTP_REFERER' , 
'HTTP_USER_AGENT' , 
'HTTPS' , 
'REMOTE_ADDR' , 
'REMOTE_HOST' , 
'REMOTE_PORT' , 
'REMOTE_USER' , 
'REDIRECT_REMOTE_USER' , 
'SCRIPT_FILENAME' , 
'SERVER_ADMIN' , 
'SERVER_PORT' , 
'SERVER_SIGNATURE' , 
'PATH_TRANSLATED' , 
'SCRIPT_NAME' , 
'REQUEST_URI' , 
'PHP_AUTH_DIGEST' , 
'PHP_AUTH_USER' , 
'PHP_AUTH_PW' , 
'AUTH_TYPE' , 
'PATH_INFO' , 
'ORIG_PATH_INFO' ) ; 

echo '<table cellpadding="10">' ; 
foreach ( $indicesServer as $arg ) { 
if (isset( $_SERVER [ $arg ])) { 
echo '<tr><td>' . $arg . '</td><td>' . $_SERVER [ $arg ] . '</td></tr>' ; 
} 
else { 
echo '<tr><td>' . $arg . '</td><td>-</td></tr>' ; 
} 
} 
echo '</table>' ; 
*/
?>
</div>
</body>
</html>
