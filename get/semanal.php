<?php
$jsons = array(
    "{label: 'Inventarios', borderColor: 'green',  backgroundColor: 'orange',  fill: false,  data: [ 1,2,3,4,5,6,7 ],yAxisID: 'y-axis-1'}",
    "{label: 'Ventas',    borderColor: 'green',    backgroundColor: 'orange',    fill: false,    data: [        2,9,3,4,2,6,7    ],    yAxisID: 'y-axis-1'}",
    "{label: 'CXC',    borderColor: 'green',    backgroundColor: 'orange',    fill: false,    data: [        3,9,3,4,2,6,7    ],    yAxisID: 'y-axis-1'}",
    "{label: 'Recuperacion',    borderColor: 'green',    backgroundColor: 'orange',    fill: false,    data: [        4,9,3,4,2,6,7    ],    yAxisID: 'y-axis-1'}",
    "{label: 'Compras',    borderColor: 'green',    backgroundColor: 'orange',    fill: false,    data: [        5,9,3,4,2,6,7    ],    yAxisID: 'y-axis-1'}",
    "{label: 'Proveedores',    borderColor: 'green',    backgroundColor: 'orange',    fill: false,    data: [        6,9,3,4,2,6,7    ],    yAxisID: 'y-axis-1'}"
);
$string = "";
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Page Title</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
</head>
<div class="col-md-12">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title m-b-0">Empresa</h5>
        </div>
        <table class="table">
            <thead>
                <tr>

                    <th scope="col">Grafica</th>
                    <th scope="col">Elemento</th>
                    <th scope="col">Valor</th>
                    <th scope="col">Fecha</th>
                </tr>
            </thead>
            <tbody>
                <form>
                    <tr>
                        <td><input type="checkbox" id="1" onclick='F();'></input></td>
                        <td>Inventario</td>
                        <td id="m1"><?php echo number_format(123.2, 2); ?></td>
                        <td><?php echo $ExivalF ?></td>
                    </tr>
                    <tr>
                        <td><input type="checkbox" id="2" onclick='F()'></input></td>
                        <td>Ventas a clientes</td>
                        <td id="m2"><?php echo number_format(123.2, 2); ?></td>
                        <td><?php echo $VentasF ?></td>
                    </tr>
                    <tr>
                        <td><input type="checkbox" id="3" onclick='F()'></input></td>
                        <td>Cuentas por cobrar</td>
                        <td id="m3"><?php echo number_format(123.2, 2); ?></td>
                        <td><?php echo $CXCF ?></td>
                    </tr>

                    <tr>
                        <td><input type="checkbox" id="4" onclick='F()'></input></td>
                        <td>Recuperacion de cartera</td>
                        <td id="m5"><?php echo number_format(123.2, 2); ?> </td>
                        <td><?php echo $RecF ?></td>
                    </tr>
                    <tr>
                        <td><input type="checkbox" id="5" onclick='F()'></input></td>
                        <td>Compras</td>
                        <td id="m4"><?php echo number_format(123.2, 2); ?></td>
                        <td><?php echo $ComprasF ?></td>
                    </tr>
                    <tr>
                        <td><input type="checkbox" id="6" onclick='F()'></input></td>
                        <td>Proveedores</td>
                        <td id="m4"><?php echo number_format(123.2, 2); ?></td>
                        <td><?php echo $ProvF ?></td>
                    </tr>
                </form>
            </tbody>
        </table>

    </div>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title m-b-0">Resumen semanal </h5>
        </div>

        <div style="width:70%">
            <canvas id="canvas" width="400" height="200"></canvas>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js" integrity="sha256-xKeoJ50pzbUGkpQxDYHD7o7hxe0LaOGeguUidbq6vis=" crossorigin="anonymous"></script>
        <script>
            var lineChartData = {
                labels: ['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'],
                datasets: [
                    <?php
                    echo $jsons[0];
                    ?> ,{
                        label: 'Ventas',
                        borderColor: "green",
                        backgroundColor: "red",
                        fill: false,
                        data: [
                            9, 9, 3, 4, 5, 6, 7
                        ],
                        yAxisID: 'y-axis-1',
                    }
                ]
            };

            function F1() {
                if ($("#1").is(':checked')) {
                    <?php $string =  $string . $jsons[0]; ?>;
                }
            }

            function F2() {
                if ($("#2").is(':checked')) {
                    <?php $string =  $string . $jsons[1]; ?>;
                }
            }

            function F3() {
                if ($("#3").is(':checked')) {
                    <?php $string =  $string . $jsons[2]; ?>;
                }
            }

            function F4() {
                if ($("#4").is(':checked')) {
                    <?php $string =  $string . $jsons[3]; ?>;
                }
            }

            function F5() {
                if ($("#5").is(':checked')) {
                    <?php $string =  $string . $jsons[4]; ?>;
                }
            }

            function F6() {
                if ($("#6").is(':checked')) {
                    alert("wot?");
                    <?php $string = $string . $jsons[5]; ?>;
                }
            }


            function F() {
               
                var dataset1 = {};
                var dataset2 = {};
                var dataset3 = {};
                var dataset4 = {};
                var dataset5 = {};
                var dataset6 = {};
                    if ($("#1").is(':checked')) {
                        dataset1 = <?php echo $jsons[0]; ?>;
                }
                if ($("#2").is(':checked')) {
                        dataset2 = <?php echo $jsons[1]; ?>;
                }
                if ($("#3").is(':checked')) {
                        dataset3 = <?php echo $jsons[2]; ?>;
                }
                if ($("#4").is(':checked')) {
                        dataset4 = <?php echo $jsons[3]; ?>;
                }
                if ($("#5").is(':checked')) {
                        dataset5 = <?php echo $jsons[4]; ?>;
                }
                if ($("#6").is(':checked')) {
                        dataset6 = <?php echo $jsons[5]; ?>;
                }

                var lineChartData2 = {
                    labels: ['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'],
                    datasets: [
                        dataset1,
                        dataset2,
                        dataset3,
                        dataset4,
                        dataset5,
                        dataset6
                    ]
                };
                var ctx = document.getElementById('canvas').getContext('2d');
                window.myLine = Chart.Line(ctx, {
                    data: lineChartData2,
                    options: {
                        responsive: true,
                        hoverMode: 'index',
                        stacked: false,
                        title: {
                            display: true,
                            text: 'Resumen semanal'
                        },
                        scales: {
                            yAxes: [{
                                type: 'linear', // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
                                display: true,
                                position: 'left',
                                id: 'y-axis-1',
                            }, {
                                type: 'linear', // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
                                display: true,
                                position: 'right',
                                id: 'y-axis-2',

                                // grid line settings
                                gridLines: {
                                    drawOnChartArea: false, // only want the grid lines for one axis to show up
                                },
                            }],
                        }
                    }
                });
            }
            window.onload = function() {
                var ctx = document.getElementById('canvas').getContext('2d');
                window.myLine = Chart.Line(ctx, {
                    data: lineChartData,
                    options: {
                        responsive: true,
                        hoverMode: 'index',
                        stacked: false,
                        title: {
                            display: true,
                            text: 'Resumen semanal'
                        },
                        scales: {
                            yAxes: [{
                                type: 'linear', // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
                                display: true,
                                position: 'left',
                                id: 'y-axis-1',
                            }, {
                                type: 'linear', // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
                                display: true,
                                position: 'right',
                                id: 'y-axis-2',

                                // grid line settings
                                gridLines: {
                                    drawOnChartArea: false, // only want the grid lines for one axis to show up
                                },
                            }],
                        }
                    }
                });
            };
        </script>
    </div>
</div>