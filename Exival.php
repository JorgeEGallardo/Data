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
                    <div class="col-md-6 col-lg-4 col-xlg-3" data-toggle="modal" data-target="#ModalExival">
                        <div class="card card-hover">
                            <div class="box bg-success text-center">
                                <h1 class="font-light text-white"><i class="mdi mdi-database"></i></h1>
                                <h6 class="text-white">Exival</h6>
                            </div>
                        </div>
                    </div>  
                    <div class="col-md-6 col-lg-4 col-xlg-3" data-toggle="modal" data-target="#ModalExival2">
                        <div class="card card-hover">
                            <div class="box bg-success text-center">
                                <h1 class="font-light text-white"><i class="mdi mdi-database"></i></h1>
                                <h6 class="text-white">Exival por linea de árticulos</h6>
                            </div>
                        </div>
                    </div>  
                    <div class="col-md-6 col-lg-4 col-xlg-3" data-toggle="modal" data-target="#ModalExival3">
                        <div class="card card-hover">
                            <div class="box bg-success text-center">
                                <h1 class="font-light text-white"><i class="mdi mdi-database"></i></h1>
                                <h6 class="text-white">Exival por grupos</h6>
                            </div>
                        </div>
                    </div>  
                
                    <div class="col-md-6 col-lg-4 col-xlg-3" onclick="$('#Resultado').html('<p></p>');">
                        <div class="card card-hover">
                            <div class="box bg-danger text-center">
                                <h1 class="font-light text-white"><i class="mdi mdi-eraser"></i></h1>
                                <h6 class="text-white">Limpiar</h6>
                            </div>
                        </div>
                    </div>
                </div>




                       
                            <div id="Resultado"></div>
         
        <!-- End Wrapper -->
         
         
        <!-- All Modals -->
         
       <?php include_once('main/modals/modalexival.php');?>  
       <?php include_once('main/modals/modalexival2.php');?>  
       <?php include_once('main/modals/modalexival3.php');?>  
         
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