@extends('admin.BaseAdmin')

@section('title')
    <div style="position: relative; left: 360px;">
        Registrar una mascota
    </div>
@endsection

@section('content')
    <figure class="highcharts-figure">
        <div id="container"></div>
        gráfica
    </figure>
    <script>
        $(function() {
            console.log("hello");
            var data = {!! $datas !!};
            console.log(data);

            Highcharts.chart('container', {
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie'
                },
                title: {
                    text: 'Productos'
                },
                tooltip: {

                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                },
                accessibility: {
                    point: {
                        valueSuffix: '%'
                    }
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                        }
                    }
                },
                series: [{
                    name: 'Productos',
                    colorByPoint: true,
                    data: data
                }]
            });
        });
    </script>
@endsection
