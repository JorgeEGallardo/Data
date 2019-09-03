<?php
$jsons = array("{label: 'Compras',
    borderColor: 'green',
    backgroundColor: 'orange',
    fill: false,
    data: [
        1,2,3,4,5,6,7
    ],
    yAxisID: 'y-axis-1'
},", "{
    label: 'Recuperacion,
    fill: false,
    borderColor: 'green',
    backgroundColor: 'orange',
    data: [8,2,1,2,3,4,5,6,7
    ],
    yAxisID: 'y-axis-2'
},");


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
            <h5 class="card-title m-b-0"><?php echo str_replace(".FDB", "", $empresadini[$bd]); ?></h5>
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
                    <td><input type="checkbox" ></input></td>
                    <td>Inventario</td>
                    <td id="m1"><?php echo number_format(123.2, 2); ?></td>
                    <td><?php echo $ExivalF ?></td>
                </tr>
                <tr>
                <td><input type="checkbox" onclick='F()'></input></td>
                    <td>Ventas a clientes</td>
                    <td id="m2"><?php echo number_format(123.2, 2); ?></td>
                    <td><?php echo $VentasF ?></td>
                </tr>
                <tr>
                <td><input type="checkbox"></input></td>
                    <td>Cuentas por cobrar</td>
                    <td id="m3"><?php echo number_format(123.2, 2); ?></td>
                    <td><?php echo $CXCF ?></td>
                </tr>

                <tr>
                <td><input type="checkbox"></input></td>
                    <td>Recuperacion de cartera</td>
                    <td id="m5"><?php echo number_format(123.2, 2); ?> </td>
                    <td><?php echo $RecF ?></td>
                </tr>
                <tr>
                <td><input type="checkbox"></input></td>
                    <td>Compras</td>
                    <td id="m4"><?php echo number_format(123.2, 2); ?></td>
                    <td><?php echo $ComprasF ?></td>
                </tr>
                <tr>
                <td><input type="checkbox"></input></td>
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
                    ?> {
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
function F(){
    var lineChartData = {
                labels: ['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'],
                datasets: [
                    <?php
                    echo $jsons[0];
                    ?> {
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
   noF();
}
function noF(){
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