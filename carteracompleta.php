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
                    <div class="col-md-6 col-lg-2 col-xlg-3" data-toggle="modal" data-target="#Consulta">
                        <div class="card card-hover">
                            <div class="box bg-cyan text-center">
                                <h1 class="font-light text-white"><i class="mdi mdi-database"></i></h1>
                                <h6 class="text-white">Tornillos Águila <br><br></h6>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <div class="col-md-6 col-lg-2 col-xlg-3" data-toggle="modal" data-target="#Consulta1">
                        <div class="card card-hover">
                            <div class="box bg-cyan text-center">
                                <h1 class="font-light text-white"><i class="mdi mdi-database"></i></h1>
                                <h6 class="text-white">Águila Proveedora <br><br></h6>
                            </div>
                        </div>
                    </div> <!-- Column -->
                    <div class="col-md-6 col-lg-2 col-xlg-3" data-toggle="modal" data-target="#Consulta2">
                        <div class="card card-hover">
                            <div class="box bg-success text-center">
                                <h1 class="font-light text-white"><i class="mdi mdi-group"></i></h1>
                                <h6 class="text-white">Grupo Águila <br><br></h6>
                            </div>
                        </div>
                    </div> <!-- Column -->
                    <div class="col-md-6 col-lg-2 col-xlg-3" data-toggle="modal" data-target="#Consulta8">     <div class="card card-hover">
                            <div class="box bg-cyan text-center">
                                <h1 class="font-light text-white"><i class="mdi mdi-database"></i></h1>
                                <h6 class="text-white">Magu<br><br></h6>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <div class="col-md-6 col-lg-2 col-xlg-3" data-toggle="modal" data-target="#Consulta4">    <div class="card card-hover">
                            <div class="box bg-cyan text-center">
                                <h1 class="font-light text-white"><i class="mdi mdi-database"></i></h1>
                                <h6 class="text-white">Herramientas del bosque</h6>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <div class="col-md-6 col-lg-2 col-xlg-3" data-toggle="modal" data-target="#Consulta3">    <div class="card card-hover">
                            <div class="box bg-cyan text-center">
                                <h1 class="font-light text-white"><i class="mdi mdi-database"></i></h1>
                                <h6 class="text-white">Fresnillo<br><br></h6>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <div class="col-md-6 col-lg-2 col-xlg-3" data-toggle="modal" data-target="#Consulta6">  <div class="card card-hover">
                            <div class="box bg-cyan text-center">
                                <h1 class="font-light text-white"><i class="mdi mdi-database"></i></h1>
                                <h6 class="text-white">SR. Tornillo Vendimia <br><br>
                                </h6>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <div class="col-md-6 col-lg-2 col-xlg-3" data-toggle="modal" data-target="#Consulta7">   <div class="card card-hover">
                            <div class="box bg-cyan text-center">
                                <h1 class="font-light text-white"><i class="mdi mdi-database"></i></h1>
                                <h6 class="text-white">SR. Tornillo 20 Noviembre</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-2 col-xlg-3" data-toggle="modal" data-target="#Consulta5">    <div class="card card-hover">
                            <div class="box bg-cyan text-center">
                                <h1 class="font-light text-white"><i class="mdi mdi-database"></i></h1>
                                <h6 class="text-white">SR. Tornillo Morga<br><br></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-2 col-xlg-3" data-toggle="modal" data-target="#Consulta9">  <div class="card card-hover">
                            <div class="box bg-success text-center">
                                <h1 class="font-light text-white"><i class="mdi mdi-group"></i></h1>
                                <h6 class="text-white">Grupo SR. Tornillo<br><br></h6>
                            </div>
                        </div>
                    </div>  <div class="col-md-6 col-lg-4 col-xlg-3" onclick="$('#Resultado').html('<p></p>');">
                        <div class="card card-hover">
                            <div class="box bg-danger text-center">
                                <h1 class="font-light text-white"><i class="mdi mdi-eraser"></i></h1>
                                <h6 class="text-white">Limpiar<br><br></h6>
                            </div>
                        </div>
                    </div>
                </div>




                       
                            <div id="Resultado"></div>
         
        <!-- End Wrapper -->
         
         
        <!-- All Modals -->
         
        <?php include_once('main/modals/modalconsultaespecial.php');?> 
        <?php include_once('main/modals/modalconsultaespecial.1.php');?> 
        <?php include_once('main/modals/modalconsultaespecial.2.php');?> 
        <?php include_once('main/modals/modalconsultaespecial.3.php');?> 
        <?php include_once('main/modals/modalconsultaespecial.4.php');?> 
        <?php include_once('main/modals/modalconsultaespecial.5.php');?> 
        <?php include_once('main/modals/modalconsultaespecial.6.php');?> 
        <?php include_once('main/modals/modalconsultaespecial.7.php');?>
        <?php include_once('main/modals/modalconsultaespecial.8.php');?>  
         
        <!-- All Jquery -->
         
    
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
        
        <script src="js/index.js"></script>
        <script src="assets/libs/flot/excanvas.js"></script>
        <script src="assets/libs/flot/jquery.flot.js"></script>
        <script src="assets/libs/flot/jquery.flot.pie.js"></script>
        <script src="assets/libs/flot/jquery.flot.time.js"></script>
        <script src="assets/libs/flot/jquery.flot.stack.js"></script>
        <script src="assets/libs/flot/jquery.flot.crosshair.js"></script>
        <script src="assets/libs/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
        <script src="dist/js/pages/chart/chart-page-init.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
 
</body>

</html>