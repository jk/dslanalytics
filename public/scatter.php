<?php

use JK\DslAnalytics\Parser;

require(dirname(__DIR__).'/vendor/autoload.php');

$p = new Parser();
$data = $p->convertToArray('../stats.csv');

$keys = array_keys($data);
sort($keys);
?>
<html>
<head>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
        google.load("visualization", "1", {packages:["scatter"]});
        google.setOnLoadCallback(drawChart);
        function drawChart() {

            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Uhrzeit');
            <?php
            foreach ($keys as $key) {
                $year = substr($key, 0, 4);
                $month = substr($key, 4, 2);
                $day = substr($key, 6, 2);
                $label = "${day}.${month}.${year}";
                echo "\t\t\tdata.addColumn('number', '".$label."');".PHP_EOL;
            }

            ?>

            data.addRows([
                <?php
                //[13,  4.8,  6.3,  3.6],
                // [14,  4.2,  6.2,  3.4]


                foreach (range(0, 95) as $index) {
                    $date_str = \JK\DslAnalytics\Helper::indexToTimeString($index);

                    $output =  "\t\t\t\t[\"${date_str}\", ";

                    $speeds = [];
                    foreach ($keys as $key) {
                        $speeds[] = (isset($data[$key][$index])) ? $data[$key][$index] : 'null';
                    }
                    $output .= join(', ', $speeds);
                    $output .= '],';
                    echo $output . PHP_EOL;
                }

                ?>
            ]);

            var options = {
                chart: {
                    title: 'Download-Bandbreite im Tagesverlauf',
                    subtitle: 'in Megabits',
                    hAxis: {
                        gridlines: {
                            color: '#ff0000'
                        },
                        slantedText: true,
                        slantedTextAngle: 90
                    }
                },
                legend: { position: 'bottom' },
                width: 1200,
                height: 700
            };

            var chart = new google.charts.Scatter(document.getElementById('chart_div'));

            chart.draw(data, options);
        }
    </script>
</head>
<body>
<div id="chart_div"></div>
</body>
</html>
