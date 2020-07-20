<?php
  include $_SERVER["DOCUMENT_ROOT"] . "/SisPie/Class/clsApply.php";
  $clsApply = new clsApply();
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Residencia Pedagógica - Inscrição</title>

  <!-- Custom fonts for this template-->
  <link href="/SisPie/src/Admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="/SisPie/src/Admin/css/sb-admin-2.css" rel="stylesheet">
  <script type="text/javascript">
    function cidade_campus(remetente,destinatario,tabela){      
      $('select[name='+destinatario+']').html('<option value="sda">Aguarde....</option>');
      $.ajax({
        type: 'POST',
        url: '../../Ajax/cidade_campus.php?tabela='+tabela+'&remetente='+remetente,
        data: 'cidade='+document.getElementById(remetente).value,
        //beforeSend: function(){ alert('enviando');},
        success: 
          function(resposta){  
            $('select[name='+destinatario+']').html(resposta);
          }
      } );
    }
  </script>

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
      <!-- Main Content -->
      <div id="content">
        <!-- Begin Page Content -->
        <div class="container-fluid">
          <!-- Page Heading -->
          <div class="text-center" style="margin:30px;">
            <h1 class="h3 mb-0 text-gray-800">Inscrição no Programa Residencia Pedagógica</h1>
            <!--a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a-->
          </div>
          <!-- Formulário -->
          <form action="grava.php" method="post" enctype="multipart/form-data">
            <!-- Content Row -->
            <div class="row">  

              <!-- DADOS PESSOAIS -->                                 
              <div class="blockquote col-lg-12" style="border-color: #D3D3D3; background-color: #FFF;">
                <div class="col-sm-5" style="margin-bottom:15px;float:left;">
                  <label class="bold" for="nome_completo" >Nome:</label>
                  <input type="text" class="form-control" id="nome_completo" name="nome_completo" style="color:#000; font-size:14px;font-family:Arial,sans-serif;" value="<?php ?>" required>
                </div>
                <div class="col-sm-5" style="margin-bottom:15px;float:left;">
                  <label class="bold" for="nome_social" >Nome Social:</label>
                  <input type="text" class="form-control" id="nome_social" name="nome_social" style="color:#000; font-size:14px;font-family:Arial,sans-serif;" value="<?php ?>">
                </div>
                <div class="col-sm-2" style="margin-bottom:15px;float:left;">
                  <label class="bold" for="dt_birth" >Data de Nascimento:</label>
                  <input type="date" class="form-control" id="dt_birth" name="dt_birth" style="color:#000; font-size:14px;font-family:Arial,sans-serif;" value="<?php ?>" required>
                </div>
                <div class="col-sm-2" style="margin-bottom:15px;float:left;">
                  <label class="bold" for="cpf" >CPF</label>
                  <input type="text" class="form-control" id="cpf" name="cpf" style="color:#000; font-size:14px;font-family:Arial,sans-serif;" value="<?php ?>" required>
                </div>
                <div class="col-sm-2" style="margin-bottom:15px;float:left;">
                  <label class="bold" for="rg" >RG</label>
                  <input type="text" class="form-control" id="rg" name="rg" style="color:#000; font-size:14px;font-family:Arial,sans-serif;" value="<?php ?>" required>
                </div>
                <div class="col-sm-2" style="margin-bottom:15px;float:left;">
                  <label class="bold" for="expedidor" >Orgão Expedidor</label>
                  <input type="text" class="form-control" id="expedidor" name="expedidor" style="color:#000; font-size:14px;font-family:Arial,sans-serif;" value="<?php ?>" required>
                </div>
                <div class="col-sm-1" style="margin-bottom:15px;float:left;">
                  <label class="bold" for="uf" >UF</label>
                  <select class="form-control" name="uf" id="uf" style="outline:none;" required>
                    <option value="">UF...</option>
                    <?php
                      $objDB = new db();
                      if ($objDB->connectDB()){
                        $objDB->consulta = "SELECT * FROM neperge_db.estado order by id";
                        $resultado = $objDB->executeSQL($objDB->consulta);
                        if(!$resultado){
                          echo "Nao foi possivel realizar a consulta ao banco de dados: " . $objDB->consulta;
                          exit();
                        }else{
                          while ($linha = mysql_fetch_assoc($resultado)){
                            echo "<option value='" . $linha['UF'] . "' $selected>" . $linha['UF'];
                          }
                        }
                        
                      }else{
                        echo "Nao foi possivel conectar ao banco de dados.";
                      }
                    ?>
                  </select>
                </div>                
                <div class="col-sm-5" style="margin-bottom:15px;float:left;">
                  <label class="bold" for="anexo_identidade" >Anexar Identidade</label>
                  <input type="file" class="form-control" name="anexo_identidade" id="anexo_identidade" required>
                </div>
                <div class="col-sm-2" style="margin-bottom:15px;float:left;">
                  <label class="bold" for="cep" >CEP</label>
                  <input type="text" class="form-control" id="cep" name="cep" style="color:#000; font-size:14px;font-family:Arial,sans-serif;" value="<?php ?>" required>
                </div>
                <div class="col-sm-6" style="margin-bottom:15px;float:left;">
                  <label class="bold" for="endereco" >Endereço Residencial</label>
                  <input type="text" class="form-control" id="endereco" name="endereco" style="color:#000; font-size:14px;font-family:Arial,sans-serif;" value="<?php ?>" required>
                </div>
                <div class="col-sm-2" style="margin-bottom:15px;float:left;">
                  <label class="bold" for="cidade" >Cidade</label>
                  <input type="text" class="form-control" id="cidade" name="cidade" style="color:#000; font-size:14px;font-family:Arial,sans-serif;" value="<?php ?>" required>
                </div>
                <div class="col-sm-2" style="margin-bottom:15px;float:left;">
                  <label class="bold" for="estado" >Estado</label>
                  <select class="form-control" name="estado" id="estado" style="outline:none;" required>
                    <option value="">Estado...</option>
                    <?php
                      $objDB = new db();
                      if ($objDB->connectDB()){
                        $objDB->consulta = "SELECT * FROM neperge_db.estado order by id";
                        $resultado = $objDB->executeSQL($objDB->consulta);
                        if(!$resultado){
                          echo "Nao foi possivel realizar a consulta ao banco de dados: " . $objDB->consulta;
                          exit();
                        }else{
                          while ($linha = mysql_fetch_assoc($resultado)){
                            echo "<option value='" . $linha['estado'] . "' $selected>" . $linha['estado'];
                          }
                        }
                        
                      }else{
                        echo "Nao foi possivel conectar ao banco de dados.";
                      }
                    ?>
                  </select>
                </div>
                <div class="col-sm-8" style="margin-bottom:15px;float:left;">
                  <label class="bold" for="email" >Email</label>
                  <input type="mail" class="form-control" id="email" name="email" style="color:#000; font-size:14px;font-family:Arial,sans-serif;" value="<?php ?>" required>
                </div>
                <div class="col-sm-2" style="margin-bottom:15px;float:left;">
                  <label class="bold" for="telefone" >Telefone:</label>
                  <input type="text" class="form-control phone-ddd-mask" id="telefone" name="telefone" style="color:#000; font-size:14px;font-family:Arial,sans-serif;" value="<?php ?>" required>
                </div>
              </div>   

              
              <!-- DADOS DO CURSO -->  
              <div class="blockquote col-lg-12" style="border-color: #D3D3D3; background-color: #FFF;">
                <div class="col-sm-4" style="margin-bottom:15px;float:left;">
                  <label class="bold" for="campus" >Campus</label>
                  <select class="form-control" name="campus" id="campus" style="outline:none;" onchange="cidade_campus('campus','curso','curso')" required>
                    <option value="">Campus...</option>
                    <?php
                      $objDB = new db();
                      if ($objDB->connectDB()){
                        $objDB->consulta = "SELECT * FROM neperge_db.campus order by id";
                        $resultado = $objDB->executeSQL($objDB->consulta);
                        if(!$resultado){
                          echo "Nao foi possivel realizar a consulta ao banco de dados: " . $objDB->consulta;
                          exit();
                        }else{
                          while ($linha = mysql_fetch_assoc($resultado)){
                            $cidade = $clsApply->NomeCidade($linha['id_cidade']);
                            echo "<option value='" . $cidade . "' $selected>" . $cidade;
                          }
                        }
                        
                      }else{
                        echo "Nao foi possivel conectar ao banco de dados.";
                      }
                    ?>
                  </select>
                </div>
                <div class="col-sm-4" style="margin-bottom:15px;float:left;">
                  <label class="bold" for="curso" >Curso</label>
                  <select class="form-control" name="curso" id="curso" style="outline:none;" required>
                    <option value="">Selecione um Campus...</option>
                  </select>
                </div>
                <div class="col-sm-2" style="margin-bottom:15px;float:left;">
                  <label class="bold" for="matricula" >Matrícula</label>
                  <input type="text" class="form-control" id="matricula" name="matricula" style="color:#000; font-size:14px;font-family:Arial,sans-serif;" value="<?php ?>" required>
                </div>
                <div class="col-sm-2" style="margin-bottom:15px;float:left;">
                  <label class="bold" for="ingresso" >Ano de Ingresso</label>
                  <input type="number" class="form-control" id="ingresso" name="ingresso" style="color:#000; font-size:14px;font-family:Arial,sans-serif;" value="<?php ?>" required>
                </div>
                <div class="col-sm-8" style="margin-bottom:15px;float:left;">
                  <label class="bold" for="link_lattes" >Endereço Currículo Lattes</label>
                  <input type="text" class="form-control" id="link_lattes" name="link_lattes" style="color:#000; font-size:14px;font-family:Arial,sans-serif;" value="<?php ?>" required>
                </div>
                <div class="col-sm-8" style="margin-bottom:15px;float:left;">
                  <label class="bold" for="link_freire" >Endereço Currículo Plataforma Paulo Freire</label>
                  <input type="text" class="form-control" id="link_freire" name="link_freire" style="color:#000; font-size:14px;font-family:Arial,sans-serif;" value="<?php ?>" required>
                </div>                          
                <div class="col-sm-8" style="margin-bottom:15px;float:left;">
                  <label class="bold" for="anexo_historico" >Anexar Histórico: </label>
                  <input type="file" class="form-control" name="anexo_historico" id="anexo_historico" required>
                </div>                         
                <div class="col-sm-4" style="margin-bottom:15px;float:left;">
                  <label class="bold" for="cr" >Coeficiente de Rendimento: </label>
                  <input type="text" class="form-control" name="cr" id="cr" required>
                </div>
              </div>
                  
              <!-- DADOS DO BANCO -->  
              <div class="blockquote col-lg-12" style="border-color: #D3D3D3; background-color: #FFF;">
                <div class="col-sm-2" style="margin-bottom:15px;float:left;">
                  <label class="bold" for="banco" >Banco</label>
                  <input type="text" class="form-control" id="banco" name="banco" style="color:#000; font-size:14px;font-family:Arial,sans-serif;" value="<?php ?>">
                </div>
                <div class="col-sm-2" style="margin-bottom:15px;float:left;">
                  <label class="bold" for="agencia" >Nº Agencia</label>
                  <input type="text" class="form-control" id="agencia" name="agencia" style="color:#000; font-size:14px;font-family:Arial,sans-serif;" value="<?php ?>">
                </div>
                <div class="col-sm-2" style="margin-bottom:15px;float:left;">
                  <label class="bold" for="corrente" >Nº C/ Corrente</label>
                  <input type="text" class="form-control" id="corrente" name="corrente" style="color:#000; font-size:14px;font-family:Arial,sans-serif;" value="<?php ?>">
                </div>
              </div>

              <!-- TERMOS DE COMPROMISSO -->
              
              <div class="blockquote col-lg-12" style="border-color: #D3D3D3; background-color: #FFF;">
                <h1>Aceite do Estudante</h1>
				
                <div class="col-sm-12" style="margin-bottom:15px;float:left;">
					<p style="color:#000;align:justify;">
						Aceito, para todos os fins e consequências de direito, as normas e condições gerais para concessão de bolsas estabelecidas no EDITAL N° /2018-PROEN.<br>
						Declaro estar ciente que o não cumprimento do desenho institucional do Programa enseja na devolução das bolsas recebidas, conforme Art.18 da Portaria nº 45/2018-CAPES que regulamenta o Programa Residência Pedagógica.
					</p>
				  <label class="bold" for="concorda" >Aceita as Confições?</label><br>
                  <input type="checkbox" name="concorda" id="concorda" value="S" required> Sim
                </div>
                <input class="btn btn-primary btn-user btn-block text-white" style="width:200px;float:right" type="submit" value="Realizar Inscrição"></input>
              </div>
            </div>
            <!-- End of Content Row -->
          </form>
          <!-- Fim do Formulário -->
        </div>
        <!-- /.container-fluid -->
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

  <!-- Bootstrap core JavaScript-->
  <script src="/SisPie/src/Admin/vendor/jquery/jquery.min.js"></script>
  <script src="/SisPie/src/Admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="/SisPie/src/Admin/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="/SisPie/src/Admin/js/sb-admin-2.js"></script>

  <!-- Page level plugins -->
  <script src="/SisPie/src/Admin/vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="/SisPie/src/Admin/js/demo/chart-area-demo.js"></script>
  <script src="/SisPie/src/Admin/js/demo/chart-pie-demo.js"></script>

</body>

</html>
