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
            O Registro <span style="color:red"><?php echo $id_oco;?></span> não se aplica ao modulo <span style="color:red"><?php echo $nome_mod;?></span> ou é inexistente! Redirecionando para página inicial...
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
