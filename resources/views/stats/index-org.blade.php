
@extends('app')
@section('main-content')
<div class = "container" >
    <div class = "row" >
        <div class = "col-md-12 offset-md-1" >
            <div class = "panel panel-default" >
                <div class = "panel-header"> Tableau de bord hospitalisation</div>
                <div class = "panel-body">
                    <canvas id = "canvas" height = "280" width = "600" ></canvas>
                </div >
                <div class = "panel-header"> Tableau de bord consultation</div>
                <div class = "panel-body"> 
                    <canvas id = "canvass" height = "280" width = "600" > </canvas>
                </div>
            </div>
        </div >
    </div >
</div >
@endsection
@section('page-script')
{{-- <script src="{{asset('/js/Chart.min.js') }}"></script> --}}
<script>
    var date = <?php echo $date; ?>;
    var nvhosp = <?php echo $nvhosp; ?>;
    var nbhosp = <?php echo $nbhosp; ?>;
    var nbcons = <?php echo $nbcons; ?>;
    var serv = <?php echo $serv; ?>;
    var barChartData = {
        labels: date,date,
        datasets: [{
            label: 'nouvelle hospitalisaton',
            backgroundColor: "pink",
            data: nvhosp
        },
           {label: 'nombre d\'Hospitalisations',
            backgroundColor: "blue",
            data:  nbhosp

        },
        ]
    };
       var barChartDataa = {
        labels:      serv,serv,
        datasets: [{
            label: 'nombre de consultations par service',
            backgroundColor: "pink",
               data: nbcons
        },
           
        ]
    };
   window.onload = function() {
        var ctxXX = document.getElementById("canvass").getContext("2d");
        window.myBar = new Chart(ctxXX, {
        type: 'bar',
        data: barChartDataa,
        // Chart.defaults.global.elements.line.fill = false;
         options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        callback: function(value) {if (value % 1 === 0) {return value;}}
                    },
                    scaleLabel: {
                        display: false
                    }
                }]
            },

            legend: {
                labels: {
                    // This more specific font property overrides the global property
                    fontColor: '#122C4B',
                    fontFamily: "'Muli', sans-serif",
                    padding: 25,
                    boxWidth: 25,
                    fontSize: 14,
                }
            },
            layout: {
                padding: {
                    left: 10,
                    right: 10,
                    top: 0,
                    bottom: 10
                }
            }
        }



        });



        var ctx = document.getElementById("canvas").getContext("2d");
        window.myBar = new Chart(ctx, {
            type: 'bar',
            data: barChartData,
          


         // Chart.defaults.global.elements.line.fill = false;



              options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        callback: function(value) {if (value % 1 === 0) {return value;}}
                    },
                    scaleLabel: {
                        display: false
                    }
                }]
            },

            legend: {
                labels: {
                    // This more specific font property overrides the global property
                    fontColor: '#122C4B',
                    fontFamily: "'Muli', sans-serif",
                    padding: 25,
                    boxWidth: 25,
                    fontSize: 14,
                }
            },
            layout: {
                padding: {
                    left: 10,
                    right: 10,
                    top: 0,
                    bottom: 10
                }
            }
        }



        });
    };
</script>
@endsection