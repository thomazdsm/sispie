<?php
  include $_SERVER["DOCUMENT_ROOT"] . "/SisPie/Class/Others/verificacao.php";
  if (!sessaoAtiva())
  {
    header('Location: http://'.$_SERVER['SERVER_NAME'] .'/SisPie/');
  }

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

  <title>SisPie - Dashboard</title>

  <!-- Custom fonts for this template-->
  <link href="/SisPie/src/Admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="/SisPie/src/Admin/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <?php
      include $_SERVER["DOCUMENT_ROOT"] . "/SisPie/App/CommonPages/sidebar.php";
    ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
      <!-- Main Content -->
      <div id="content">
        <!-- Begin Page Content -->
        <div class="container-fluid">
          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4" style="margin:20px;">
            <h1 class="h3 mb-0 text-gray-800"><?php echo $_SESSION['usuario_PROF'].' - ' . $_SESSION['idUsuario_PROF'];?></h1>
            <!--a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a-->
          </div>
          <!-- Content Row -->
          <div class="row">
            <div class="col-lg-12">
              <!-- Begin Page Content -->
              <div class="container-fluid">
                <!-- Page Heading -->
                <h1 class="h3 mb-2 text-gray-800">Cabeçalho</h1>
                <p class="mb-4">Texto descritivo...</p>
                
                <!-- DataTales LISTA DE CURSOS -->
                <div class="card shadow mb-4">
                  <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Lista de Cursos</h6>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <?php
                        $objDB = new db();
                  
                        if ($objDB->connectDB()){
                          $htmlTabela = "";
                          $htmlTabela .= '
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                              <thead>
                                <tr>
                                  <th>Nome</th>
                                  <th>Tipo</th>
                                  <th>Campus</th>
                                  <th>Município</th>
                                  <th>Qnt. Inscritos</th>
                                </tr>
                              </thead>
                              <tfoot>
                                <tr>
                                  <th>Nome</th>
                                  <th>Tipo</th>
                                  <th>Campus</th>
                                  <th>Município</th>
                                  <th>Qnt. Inscritos</th>
                                </tr>
                              </tfoot>';

                          $objDB->consulta = "SELECT * FROM neperge_db.curso WHERE id_responsavel = '". $_SESSION['idUsuario_PROF'] ."' ORDER BY curso";

                          $resultado = $objDB->executeSQL($objDB->consulta);
                          if(!$resultado)
                          {
                            echo "N&atilde;o foi poss&iacute;vel realizar a consulta ao banco de dados: " . $resultado .$objDB->consulta;
                            exit();
                          }else{
                            $htmlTabela .= "<tbody>";
                            if(mysql_num_rows($resultado) > 0){
                              while ($linha = mysql_fetch_assoc($resultado)){
                                $htmlTabela .= "<tr>";
                                $htmlTabela .= "<td>". $linha['curso'] ."</td>";
                                $htmlTabela .= "<td>". $linha['tipo'] ."</td>";

                                $campus = $clsApply->NomeCampus($linha['id_campus']);
                                $htmlTabela .= "<td>". $campus ."</td>";

                                $id_cidade = $clsApply->IdMunicipioCampus($linha['id_campus']);
                                $municipio = $clsApply->NomeCidade($linha['id_campus']);
                                $htmlTabela .= "<td>". $municipio ."</td>";

                                $qnt_inscrios = $clsApply->CountInscritos($linha['curso']);
                                $htmlTabela .= "<td>". $qnt_inscrios ."</td>";
                                $htmlTabela .= "</tr>";
                              }
                            }else{
                              $htmlTabela .= "<tr>";
                                $htmlTabela .= "<td><b>Sem Registros Encontrados</b></td>";	
                              $htmlTabela .= "</tr>";
                            }
                            $htmlTabela .= "</tbody></table>";

                            //EXPORTE DA TABELA -- NECESSÁRIO QUE ELA ESTEJA POR COMPLETO DENTO DO $htmlTabela!!!!!
                            //unset($_SESSION["tabelaFERRXLS"]);
                            //$_SESSION["tabelaFERRXLS"] = $htmlTabela;
                            echo $htmlTabela;
                          } 
                        }
                      ?>                      
                    </div>
                  </div>
                </div>
              </div>

              <!-- Begin Page Content -->
              <div class="container-fluid">              
                <!-- DataTales LISTA DE INSCRITOS -->
                <div class="card shadow mb-4">
                  <div class="card-header py-3">
                    <div class="d-sm-flex align-items-center" style="float:left;">                        
                      <span style=" color: #000; font-family: Verdana;font-size: 18px;" >Lista de Inscritos</span >
                    </div>
                    <div class="d-sm-flex align-items-center" style="float:right;">
                      <span style=" color: #000; font-family: Verdana;font-size: 18px;" ><a href="/SisPie/App/Admin/exportarXLS.php" target="_blank"><i class="fas fa-file-download"></i> Exportar Excel</a></span>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <?php
                        $objDB = new db();
                  
                        if ($objDB->connectDB()){
                          $htmlTabela = "";
                          $htmlTabela .= '
                            <table class="table table-bordered" id="dataTable1" width="100%" cellspacing="0">
                              <thead>
                                <tr>
                                  <th>Nome</th>
                                  <th>Curso</th>
                                  <th>Campus</th>
                                  <th>Coeficiente</th>
                                  <th>Matrícula</th>
                                  <th>Identidade</th>
                                  <th>Histórico</th>
                                </tr>
                              </thead>
                              <tfoot>
                                <tr>
                                  <th>Nome</th>
                                  <th>Curso</th>
                                  <th>Campus</th>
                                  <th>Coeficiente</th>
                                  <th>Matrícula</th>
                                  <th>Identidade</th>
                                  <th>Histórico</th>
                                </tr>
                              </tfoot>';

                          $objDB->consulta = "SELECT * FROM neperge_db.res_pedagogica ORDER BY nome_completo";

                          $resultado = $objDB->executeSQL($objDB->consulta);
                          if(!$resultado)
                          {
                            echo "N&atilde;o foi poss&iacute;vel realizar a consulta ao banco de dados: " . $resultado .$objDB->consulta;
                            exit();
                          }else{
                            $htmlTabela .= "<tbody>";
                            if(mysql_num_rows($resultado) > 0){
                              while ($linha = mysql_fetch_assoc($resultado)){
                                if($clsApply->CheckCurso($linha['curso'],$_SESSION['idUsuario_PROF']) == 'OK'){
                                  $htmlTabela .= "<tr>";
                                    $htmlTabela .= "<td>". $linha['nome_completo'] ."</td>";
                                    $htmlTabela .= "<td>". $linha['curso'] ."</td>";
                                    $htmlTabela .= "<td>". $linha['campus'] ."</td>";
                                    $htmlTabela .= "<td>". $linha['cr'] ."</td>";
                                    $htmlTabela .= "<td>". $linha['matricula'] ."</td>";
                                    if(empty($linha['anexo_identidade'])){
                                      $link_identidade = '#';
                                    }else{
                                      $link_identidade = "/SisPie/App/ResidenciaPedagogica/identidade/".$linha['anexo_identidade']."";
                                    }
                                    if(empty($linha['anexo_historico'])){
                                      $link_historico = '#';
                                    }else{
                                      $link_historico = "/SisPie/App/ResidenciaPedagogica/historico/".$linha['anexo_historico']."";
                                    }
                                    $htmlTabela .= "<td class='text-center'><a href='".$link_identidade."' style='color:#000;' target='t_blank'><i class='far fa-id-badge'></i></a></td>";
                                    $htmlTabela .= "<td class='text-center'><a href='".$link_historico."' style='color:#000;' target='t_blank'><i class='far fa-file-alt'></i></a></td>";
                                  $htmlTabela .= "</tr>";
                                }
                              }
                            }else{
                              $htmlTabela .= "<tr>";
                                $htmlTabela .= "<td><b>Sem Registros Encontrados</b></td>";	
                              $htmlTabela .= "</tr>";
                            }
                            $htmlTabela .= "</tbody></table>";

                            //EXPORTE DA TABELA -- NECESSÁRIO QUE ELA ESTEJA POR COMPLETO DENTO DO $htmlTabela!!!!!
                            unset($_SESSION["tabelaFERRXLS1"]);
                            $_SESSION["tabelaFERRXLS1"] = $htmlTabela;
                            echo $htmlTabela;
                          } 
                        }
                      ?>                      
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.container-fluid -->
              <?php/*
                 $diretorio = getcwd().'/SisPie/App/ResidenciaPedagogica/identidade/';

                 // Instancia a Classe Zip
                 $zip = new ZipArchive();
                  // Cria o Arquivo Zip, caso não consiga exibe mensagem de erro e finaliza script
                  if($zip->open('nome_arquivo_zip.zip', ZIPARCHIVE::CREATE) == TRUE)
                  {
                   // Insere os arquivos que devem conter no arquivo zip
                   $zip->addFile($diretorio.'ID-1-111.txt','ID-1-111.txt');
                   $zip->addFile($diretorio.'ID-1-123.txt','ID-1-123.txt');

                   echo 'Arquivo criado com sucesso.';
                  }
                  else
                  {
                   exit('O Arquivo não pode ser criado.');
                  }

                  // Fecha arquivo Zip aberto
                  $zip->close();*/
              ?>
              <!--a href="/SisPie/App/ResidenciaPedagogica/identidade/nome_arquivo_zip.zip" download>Click Aqui!</a-->
            </div>
          </div>
          <!-- End of Content Row -->
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

  <!-- Page level plugins -->
  <script src="/SisPie/src/Admin/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="/SisPie/src/Admin/vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="/SisPie/src/Admin/js/demo/datatables-demo.js"></script>
</body>

</html>
