<?php 
include('config/servicio2.php');
$conn=ibase_connect($servicedini.":".$rutadini."DASHBOARD.FDB",$usuariodini, $basedecode);	
$QueryExival = "SELECT VALOR FROM EXIVAL WHERE BD = '$empresadini[1]';";  
$Exival = ibase_query($conn, $QueryExival);
while ($RowExival = ibase_fetch_object($Exival)) {
$ExivalV = $RowExival->VALOR;
}  
?>

    <?php include "header/head.php"?>
         
           
         
         
          
         
        <aside class="left-sidebar" data-sidebarbg="skin5">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <?php include("main/navbar.php")?>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
         
           
         
         
        <!-- Page wrapper  -->
         
        <div class="page-wrapper">
             
            <!-- Bread crumb and right sidebar toggle -->
             
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Empresas</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                 
                <!-- Ajax/Js Cards  -->
                 
                <div class="row">
                    <!-- Column -->
                    <?php 
                    for ($i=0; $i < count($empresadini); $i++) { 
                        $empresa = str_replace(".FDB","",$empresadini[$i]);
                    ?>
                    <div class="col-md-3 col-lg-3 col-xlg-3" onClick="consulta('<?php echo $i;?>')">
                        <div class="card card-hover">
                            <div class="box bg-success text-center">
                                <h1 class="font-light text-white"><i class="mdi mdi-database"></i></h1>
                                <h6 class="text-white"><?php echo $empresa;?></h6>
                            </div>
                        </div>
                    </div>
                    <?php  
                
                }?>
                  
                <div class="col-md-12">


                <div id="Resultado">
                </div>

                    <!-----

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-md-flex align-items-center">
                                        <div>
                                            <h4 class="card-title">Analisís general</h4>
                                            <h5 class="card-subtitle">Ventas</h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                     <canvas id="chartVentas" width="800" height="450"></canvas>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>--->

                </div>
                 
                <!-- End Wrapper -->
                 
                 
                <!-- All Modals -->
                 
                 
                <!-- All Jquery -->
                 
                <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
                <script src="assets/libs/jquery/dist/jquery.min.js"></script>
                <!-- Bootstrap tether Core JavaScript -->
                <script src="assets/libs/popper.js/dist/umd/popper.min.js"></script>
                <script src="assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
                <script src="assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
                <script src="assets/extra-libs/sparkline/sparkline.js"></script>
                <!--Wave Effects -->
                <script src="dist/js/waves.js"></script>
                <!--Menu sidebar -->
                <script src="dist/js/sidebarmenu.js"></script>
                <!--Custom JavaScript -->
                <script src="dist/js/custom.min.js"></script>
                <!--This page JavaScript -->
                <!-- <script src="dist/js/pages/dashboards/dashboard1.js"></script> -->
                <!-- Charts js Files -->

                <script src="js/dashboard.js"></script>
                <script src="assets/libs/flot/excanvas.js"></script>
                <script src="assets/libs/flot/jquery.flot.js"></script>
                <script src="assets/libs/flot/jquery.flot.pie.js"></script>
                <script src="assets/libs/flot/jquery.flot.time.js"></script>
                <script src="assets/libs/flot/jquery.flot.stack.js"></script>
                <script src="assets/libs/flot/jquery.flot.crosshair.js"></script>
                <script src="assets/libs/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
                <script src="dist/js/pages/chart/chart-page-init.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
                    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
                    crossorigin="anonymous"></script>
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
                    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
                    crossorigin="anonymous"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
                
</body>

</html>