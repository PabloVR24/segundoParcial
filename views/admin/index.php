<?php
include(__DIR__ . '/../../includes/navbar.php');
include(__DIR__ . '/../../class/class_db/class_db.php');
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Dashboard con Charts.js</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.0/dist/chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
    <link rel="stylesheet" href="../../css/style_dashboard.css">
</head>
<div class="container">

    <body>
        <div class="TITULO">
            <h1>Dashboard de Solicitudes</h1>
        </div>
        <div class="FILTRO">
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <label for="municipio">Filtrar por municipio:</label>
                <br>
                <select class="form-control" id="municipio" name="municipio">
                    <option value="">Todos</option>
                    <?php
                    $db = new class_db();
                    $db->set_db('localhost', 'root', '', 'mydb');
                    $result = mysqli_query($db->db_conn, "SELECT DISTINCT ID_MUNICIPIO FROM ticket");
                    while ($row = mysqli_fetch_assoc($result)) {
                        $municipio = $row['ID_MUNICIPIO'];
                        $selected = '';
                        if (isset($_POST['municipio']) && $_POST['municipio'] == $municipio) {
                            $selected = 'selected';
                        }
                        $nombre_municipio = '';
                        if ($municipio == 1) {
                            $nombre_municipio = 'Abasolo';
                        } else if ($municipio == 2) {
                            $nombre_municipio = 'Acuña';
                        } else if ($municipio == 3) {
                            $nombre_municipio = 'Allende';
                        } else if ($municipio == 4) {
                            $nombre_municipio = 'Arteaga';
                        } else if ($municipio == 5) {
                            $nombre_municipio = 'Candela';
                        } else if ($municipio == 6) {
                            $nombre_municipio = 'Castaños';
                        } else if ($municipio == 7) {
                            $nombre_municipio = 'Cuatro Ciénegas';
                        } else if ($municipio == 8) {
                            $nombre_municipio = 'Escobedo';
                        } else if ($municipio == 9) {
                            $nombre_municipio = 'Francisco I. Madero';
                        } else if ($municipio == 10) {
                            $nombre_municipio = 'Frontera';
                        } else if ($municipio == 11) {
                            $nombre_municipio = 'General Cepeda';
                        } else if ($municipio == 12) {
                            $nombre_municipio = 'Guerrero';
                        } else if ($municipio == 13) {
                            $nombre_municipio = 'Hidalgo';
                        } else if ($municipio == 14) {
                            $nombre_municipio = 'Jiménez';
                        } else if ($municipio == 15) {
                            $nombre_municipio = 'Juárez';
                        } else if ($municipio == 16) {
                            $nombre_municipio = 'Lamadrid';
                        } else if ($municipio == 17) {
                            $nombre_municipio = 'Matamoros';
                        } else if ($municipio == 18) {
                            $nombre_municipio = 'Monclova';
                        } else if ($municipio == 19) {
                            $nombre_municipio = 'Morelos';
                        } else if ($municipio == 20) {
                            $nombre_municipio = 'Múzquiz';
                        } else if ($municipio == 21) {
                            $nombre_municipio = 'Nadadores';
                        } else if ($municipio == 22) {
                            $nombre_municipio = 'Nava';
                        } else if ($municipio == 23) {
                            $nombre_municipio = 'Ocampo';
                        } else if ($municipio == 24) {
                            $nombre_municipio = 'Parras';
                        } else if ($municipio == 25) {
                            $nombre_municipio = 'Piedras Negras';
                        } else if ($municipio == 26) {
                            $nombre_municipio = 'Progreso';
                        } else if ($municipio == 27) {
                            $nombre_municipio = 'Ramos Arizpe';
                        } else if ($municipio == 28) {
                            $nombre_municipio = 'Sabinas';
                        } else if ($municipio == 29) {
                            $nombre_municipio = 'Sacramento';
                        } else if ($municipio == 30) {
                            $nombre_municipio = 'Saltillo';
                        } else if ($municipio == 31) {
                            $nombre_municipio = 'San Buenaventura';
                        } else if ($municipio == 32) {
                            $nombre_municipio = 'San Juan de Sabinas';
                        } else if ($municipio == 33) {
                            $nombre_municipio = 'San Pedro';
                        } else if ($municipio == 34) {
                            $nombre_municipio = 'Sierra Mojada';
                        } else if ($municipio == 35) {
                            $nombre_municipio = 'Torreón';
                        } else if ($municipio == 36) {
                            $nombre_municipio = 'Viesca';
                        } else if ($municipio == 37) {
                            $nombre_municipio = 'Villa Unión';
                        } else if ($municipio == 38) {
                            $nombre_municipio = 'Zaragoza';
                        }

                        $nombre_municipio = $nombre_municipio != '' ? "($nombre_municipio)" : '';
                        echo "<option value=\"$municipio\" $selected>$municipio $nombre_municipio</option>";
                    }
                    $db->close_db();
                    ?>
                </select>
                <input class="btn btn-success" type="submit" value="Filtrar">
            </form>
        </div>
        <?php
        $db = new class_db();
        $db->set_db('localhost', 'root', '', 'mydb');
        $data = $db->get_ticket_counts_by_municipio_and_status();
        $db->close_db();
        $total_pendientes = 0;
        $total_resueltos = 0;
        $municipio_seleccionado = isset($_POST['municipio']) ? $_POST['municipio'] : '';
        if (!empty($municipio_seleccionado)) {
            $pendientes_por_municipio = $data[$municipio_seleccionado]['PENDIENTE'];
            $resueltos_por_municipio = $data[$municipio_seleccionado]['RESUELTO'];
        } else {
            foreach ($data as $municipio => $estados) {
                $total_pendientes += $estados['PENDIENTE'];
                $total_resueltos += $estados['RESUELTO'];
            }
        } ?>
        <div class="GRAFICO">
            <canvas id="grafica-pastel"></canvas>
            <script>
                var ctx = document.getElementById('grafica-pastel').getContext('2d');
                var chart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: ['Pendientes', 'Resueltos'],
                        datasets: [{
                            data: [<?php
                                    if (!empty($municipio_seleccionado)) {
                                        echo "$pendientes_por_municipio, $resueltos_por_municipio";
                                    } else {
                                        echo "$total_pendientes, $total_resueltos";
                                    }
                                    ?>],
                            backgroundColor: ['#7D5A8C', '#7641BF'],
                            borderWidth: 1.5
                        }]
                    },
                    options: {
                        maintainAspectRatio: false,
                        responsive: true,
                        title: {
                            display: false,
                            text: 'Solicitudes por Estatus'
                        },
                        plugins: {
                            datalabels: {
                                color: 'black',
                                font: {
                                    size: 20
                                },
                                formatter: function(value, ctx) {
                                    var dataset = ctx.chart.data.datasets[0];
                                    var total = dataset.data.reduce(function(previousValue, currentValue, currentIndex, array) {
                                        return previousValue + currentValue;
                                    });
                                    var percentage = Math.floor((value / total) * 100 + 0.5);
                                    return percentage + "%";
                                }
                            }
                        },
                        legend: {
                            labels: {
                                fontColor: 'white'
                            }
                        }
                    },
                    plugins: [ChartDataLabels]
                });
            </script>
        </div>
    </body>
</div>

</html>