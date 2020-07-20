<?php
    include $_SERVER["DOCUMENT_ROOT"] . "/SisPie/Class/clsApply.php";

    $clsApply = new clsApply();
    $objDB = new db();


    //$id = $_POST['id']);
    $nome_completo = strtoupper($_POST['nome_completo']);
    $nome_social = $_POST['nome_social'];
    $dt_birth = $_POST['dt_birth'];
    $cpf = $_POST['cpf'];

    //CHECK DE CPF
    $objDB = new db();
    $objDB->consulta = "SELECT * FROM neperge_db.res_pedagogica WHERE cpf = '".$cpf."'";

    if ($objDB->connectDB()){

      $resultado = $objDB->executeSQL($objDB->consulta);

      if(!$resultado){
        echo "Nao foi possivel realizar a consulta ao banco de dados: " . $resultado;
        exit();
      }else{
        if ($linha = mysql_fetch_assoc($resultado)){						
          $check_CPF = 'FAIL';
        }else{	
          $check_CPF = 'OK';        
        }
      }
    }else{
      echo "Nao foi possivel conectar ao banco de dados.";
      exit();
    }
    //echo $check_CPF;

    $rg = $_POST['rg'];
    $expedidor = $_POST['expedidor'];
    $uf = $_POST['uf'];
    //$anexo_identidade = $_POST['anexo_identidade'];
    $cep = $_POST['cep'];
    $endereco = $_POST['endereco'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $curso = $_POST['curso'];
    $campus = $_POST['campus'];
    $matricula = $_POST['matricula'];
    $cr = $_POST['cr'];
    $ingresso = $_POST['ingresso'];
    $link_lattes = $_POST['link_lattes'];
    $link_freire = $_POST['link_freire'];
    //$anexo_historico = $_POST['anexo_historico'];
    $banco = $_POST['banco'];
    $agencia = $_POST['agencia'];
    $corrente = $_POST['corrente'];
    $concorda = $_POST['concorda'];
    $dt_cad = $_POST['dt_cad'];


    //echo "TRATAMENTO DO ANEXO - identidade";echo '<br>';

    if($id != NULL){
        $sequencia = $id;
    }else{            
        $sequencia = $objDB->getSequenceID("id","res_pedagogica");
    }

    $target_dir = "identidade/";

    $file_prev = $target_dir . basename($_FILES["anexo_identidade"]["name"]);
    $imageFileType = strtolower(pathinfo($_FILES["anexo_identidade"]["name"],PATHINFO_EXTENSION));

    $aux = 	'ID-'. $sequencia .'-'. $cpf .'.' . $imageFileType . '';
    $_FILES["anexo_identidade"]["name"] = $aux;
    $identidade = $_FILES["anexo_identidade"]["name"];	

    
    $target_file = $target_dir . basename($_FILES["anexo_identidade"]["name"]);

    
    
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["anexo_identidade"]["tmp_name"]);
        if($check !== false) {
            //echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            //echo "File is not an image.";
            $uploadOk = 0;
        }
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        //echo "Arquivo já existe!";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "pdf" ) {
        //echo "Desculpa, apenas arquivos PDF, JPG, JPEG, PNG & GIF são aceitos.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        //echo "Upload de arquivo não concluído!";
        // if everything is ok, try to upload file
        } else {
        if (move_uploaded_file($_FILES["anexo_identidade"]["tmp_name"], $target_file)) {
            //echo "<br>O arquivo ". basename( $_FILES["anexo_identidade"]["name"]). " foi carregado.<br>";
        } else {
            //echo "Sorry, there was an error uploading your file.";
        }
    }

    //echo "TRATAMENTO DO ANEXO - anexo_historico";echo '<br>';

    $target_dir1 = "historico/";

    $file_prev1 = $target_dir1 . basename($_FILES["anexo_historico"]["name"]);
    $imageFileType1 = strtolower(pathinfo($_FILES["anexo_historico"]["name"],PATHINFO_EXTENSION));

    $aux = 	'HST-'. $sequencia .'-'. $cpf .'.' . $imageFileType1 . '';
    $_FILES["anexo_historico"]["name"] = $aux;
    $historico = $_FILES["anexo_historico"]["name"];

    
    $target_file1 = $target_dir1 . basename($_FILES["anexo_historico"]["name"]);

    
    
    $uploadOk_1 = 1;
    $imageFileType1 = strtolower(pathinfo($target_file1,PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["anexo_historico"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk_1 = 1;
        } else {
            echo "File is not an image.";
            $uploadOk_1 = 0;
        }
    }

    // Check if file already exists
    if (file_exists($target_file1)) {
        //echo "Sorry, file already exists.";
        $uploadOk_1 = 0;
    }


    // Allow certain file formats
    if($imageFileType1 != "jpg" && $imageFileType1 != "png" && $imageFileType1 != "jpeg" && $imageFileType1 != "gif" && $imageFileType1 != "pdf" ) {
        //echo "Desculpa, apenas arquivos PDF, JPG, JPEG, PNG & GIF são aceitos.";
        $uploadOk_1 = 0;
    }

    // Check if $uploadOk_1 is set to 0 by an error
    if ($uploadOk_1 == 0) {
        //echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
        if (move_uploaded_file($_FILES["anexo_historico"]["tmp_name"], $target_file1)) {
            //echo "O Arquivo ". basename( $_FILES["anexo_historico"]["name"]). " foi carregado.";
        } else {
            //echo "Sorry, there was an error uploading your file.";
        }
    }


    //$clsApply->setid($id);
    $clsApply->setnome_completo($nome_completo);
    $clsApply->setnome_social($nome_social);
    $clsApply->setdt_birth($dt_birth);
    $clsApply->setcpf($cpf);
    $clsApply->setrg($rg);
    $clsApply->setexpedidor($expedidor);
    $clsApply->setuf($uf);
    $clsApply->setcep($cep);
    $clsApply->setendereco($endereco);
    $clsApply->setcidade($cidade);
    $clsApply->setestado($estado);
    $clsApply->setemail($email);
    $clsApply->settelefone($telefone);
    $clsApply->setcurso($curso);
    $clsApply->setcampus($campus);
    $clsApply->setmatricula($matricula);
    $clsApply->setcr($cr);
    $clsApply->setingresso($ingresso);
    $clsApply->setlink_lattes($link_lattes);
    $clsApply->setlink_freire($link_freire);
    $clsApply->setbanco($banco);
    $clsApply->setagencia($agencia);
    $clsApply->setcorrente($corrente);
    $clsApply->setconcorda($concorda);
    $clsApply->setanexo_identidade($identidade);
    $clsApply->setanexo_historico($historico);
    $clsApply->setdt_cad($dt_cad);

	if($uploadOk == 0 || $uploadOk_1 == 0){
		$check_CPF = 'FAIL';
	}

    //echo $clsApply->insertRP();
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="deion" content="">
  <meta name="author" content="">

  <title>Residencia Pedagógica - Inscrição</title>

  <!-- Custom fonts for this template-->
  <link href="/SisPie/src/Admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="/SisPie/src/Admin/css/sb-admin-2.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
      <!-- Main Content -->
      <div id="content">
        <!-- Begin Page Content -->
        <div class="blockquote text-center" style="border-color: #007E7A; background-color: #FFF;width:100%;">
            <span style="color:red"><?php echo $clsApply->insertRP($check_CPF);?></span> ao realizar a inscrição! Redirecionando para página inicial...
            <p id="demo" class="text-center"></p>
            <div class="progress mb-4" id="progress"></div>

            <script>
            // Set the date we're counting down to
            var hr_final = new Date().getTime();
            var countDownDate = Math.floor((hr_final % (1000 * 60)) / 1000) + 10;
            
            // Get today's date and time
            var hr_now = new Date().getTime();
            var now = Math.floor((hr_now % (1000 * 60)) / 1000);
            porcentagem = 0;

            // Update the count down every 1 second
            var x = setInterval(function() {


                // Find the distance between now and the count down date
                var seconds = countDownDate - now;

                // Display the result in the element with id="demo"
                if(seconds >= 0){
                    document.getElementById("progress").innerHTML = '<div class="progress-bar progress-bar" role="progressbar" style="width: '+ porcentagem * 10 +'%" aria-valuenow="'+ porcentagem * 10 +'" aria-valuemin="0" aria-valuemax="100"><span style="text-color:#000"></span></div>';
                    porcentagem = porcentagem + 1;
                    now = now + 1;
                }
                document.getElementById("demo").innerHTML = seconds + "s ";

                // If the count down is finished, write some text
                if (seconds <= 0) {
                    clearInterval(x);
                    location.href='/SisPie/';
                }
            }, 1000);
            </script>
        </div>
      </div>
      <!-- End of Main Content -->
      <!-- Footer -->      
      <?php
        include $_SERVER["DOCUMENT_ROOT"] . "/SisPie/App/CommonPages/footer.php";
      ?>
      <!-- End of Footer -->
    </div>
    <!-- End of Content Wrapper -->
  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.html">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core Java-->
  <script src="/SisPie/src/Admin/vendor/jquery/jquery.min.js"></>
  <script src="/SisPie/src/Admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></>

  <!-- Core plugin Java-->
  <script src="/SisPie/src/Admin/vendor/jquery-easing/jquery.easing.min.js"></>

  <!-- Custom s for all pages-->
  <script src="/SisPie/src/Admin/js/sb-admin-2.js"></>

  <!-- Page level plugins -->
  <script src="/SisPie/src/Admin/vendor/chart.js/Chart.min.js"></>

  <!-- Page level custom s -->
  <script src="/SisPie/src/Admin/js/demo/chart-area-demo.js"></>
  <script src="/SisPie/src/Admin/js/demo/chart-pie-demo.js"></>

</body>

</html>