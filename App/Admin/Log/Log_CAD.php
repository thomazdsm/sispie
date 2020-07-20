<html>
<head>
</head>
<body>
PRIMEIRO ACESSO
<?php 
    include_once $_SERVER["DOCUMENT_ROOT"] . "/AAAGenerico/Modelo/db.php";
    include $_SERVER["DOCUMENT_ROOT"] . "/AAAGenerico/Modelo/clsMapeamento.php";
    $clsMapeamento = new clsMapeamento();

    echo $mat = $_POST['mat'];echo '<br>';
    echo $nome = $_POST['nome'];echo '<br>';
    echo $pass = $_POST['password'];echo '<br>';
    echo $mail = $_POST['mail'];echo '<br>';
    echo $dir = $_POST['dir'];echo '<br>';
    echo $empresa = $_POST['empresa'];echo '<br>'; 

    echo $matricula = $clsMapeamento->getUsuario($mat,'matricula');echo '<br>';

    if(!$matricula){
        $clsMapeamento->setmat($mat);
        $clsMapeamento->setnome($nome);
		$clsMapeamento->setpass($pass);
		$clsMapeamento->setmail($mail);
		$clsMapeamento->setdir_usr($dir);
		$clsMapeamento->setemp_usr($empresa);
        $clsMapeamento->cadastrarUsuario();echo '<br>';

    }else{
        echo 'Usuário já Cadastrado';echo '<br>';
    }
?>
<a href="/AAAGenerico/login.php">Voltar</a>
</body>
</html>