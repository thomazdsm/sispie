<html>
    <head>
        <title>Log Redirect</title>
    </head>
    <body>
        LOGIN
        <br>
        <?php 
            include_once $_SERVER["DOCUMENT_ROOT"] . "/SisPie/Class/Others/validacao.php";  echo "validacao";echo "<br>";
            include_once $_SERVER["DOCUMENT_ROOT"] . "/SisPie/Class/db.php";    echo "db";echo "<br>";
            include_once $_SERVER["DOCUMENT_ROOT"] . "/SisPie/Class/dbuser.php";    echo "dbuser";echo "<br>";
            include_once $_SERVER["DOCUMENT_ROOT"] . "/SisPie/Class/clsUsuario.php";    echo "clsUsuario";echo "<br>";
            include_once $_SERVER["DOCUMENT_ROOT"] . "/SisPie/Class/clsLog.php";    echo "clsLog";echo "<br>";

            session_start();

            include $_SERVER["DOCUMENT_ROOT"] . "/SisPie/Class/clsApply.php";
            $clsApply = new clsApply(); 

            echo 'teste ok';
            echo $email = $_POST['email'];
            echo $pass = $_POST['pass'];
            
            $objDB = new db();
                
            if ($objDB->connectDB()){
                $objDB->consulta = "SELECT * FROM neperge_db.administrador WHERE cpf = '".$pass."' AND email = '".$email."'";
                    
                $resultado = $objDB->executeSQL($objDB->consulta);
                if(!$resultado){
                    echo "Senha Incorreta ou Nao foi possivel realizar a consulta ao banco de dados: " . $objDB->consulta;
                    exit();
                }else{
                    $linha = mysql_fetch_assoc($resultado);			
                    if($linha['cpf'] == $pass){           
                        $_SESSION["idUsuario_PROF"] = $linha["id"];
                        $_SESSION["usuario_PROF"] = $linha["nome"];
                        $_SESSION["email_PROF"] = $linha["email"]; 
                        $_SESSION["cpf_PROF"] = $linha["cpf"]; 
                        $_SESSION["ip_PROF"] = $_SERVER['REMOTE_ADDR'];
                        $_SESSION["host_PROF"] = gethostbyaddr($_SESSION["ip_PROF"]);
                        $_SESSION["inicioSessao_PROF"] = time();					
                        $_SESSION["expiraSessao_PROF"] = 9000; //2,5 horas        
                        echo 'Usuário Correto<br>'. $objDB->consulta;

                        //$objLog = new clsLog();
                        //$objLog->setIDUsuario($linha["matricula"]);
                        //$objLog->setAcao( $linha["nome"]. " - Entrou no Sistema | ". $objDB->consulta);
                        //$objLog->insereLog();

                        echo 'LOGIN REALIZADO!';
                        header('Location: /SisPie/App/Admin/dashboard.php');	
                    }else{
                        echo 'Senha incorreta<br>'. $objDB->consulta;
                        //header('Location: /AAAGenerico/Aplicacao/Erro/erro.php');	
                    }		
                }
                
            }else{
                echo "Nao foi possivel conectar ao banco de dados.";
                //header('Location: /AAAGenerico/Aplicacao/Erro/erro.php');
            }
        ?>
        <a href="/SisPie/App/Admin/login.php">Voltar</a>
    </body>
</html>