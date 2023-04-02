@extends('app')
@section('style')
<style type="text/css" media="screen">
  .widget {
    background: #ffffff;
    border: 1px solid transparent;
    border-radius: 2px;
    -webkit-box-shadow: 0 1px 1px rgb(0 0 0 / 5%);
    box-shadow: 0 1px 1px rgb(0 0 0 / 5%);
    border-color: #e9e9e9;
  }
  .widget .widget-body {
    padding: 20px;
  }
  .pull-left {
    float: left!important;
  }
</style>
@endsection
@section('main-content')
<div class="row">
  <div class="col-lg-3 col-md-6 col-xs-12">
    <div class="widget">
      <div class="widget-body">
        <div class="widget-icon pull-left">
          <i class="ace-icon fa fa-user-md bigger-180"></i>
        </div>
        <div class="widget-content pull-left">
          <div class="title">&nbsp;{{ $medsCount }}</div><div class="comment">Medecins</div> 
          </div><div class="clearfix"></div>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-md-6 col-xs-12">
  <div class="widget">
    <div class="widget-body">
      <div class="widget-icon  pull-left"><i class="menu-icon material-icons">groups</i></div>
      <div class="widget-content pull-left">
        <div class="title"> {{ $infsCount  }}</div><div class="comment">Infirmiers</div>
      </div><div class="clearfix"></div>
    </div>
  </div>
  </div>
  <div class="col-lg-3 col-md-6 col-xs-12">
    <div class="widget">
      <div class="widget-body">
        <div class="widget-icon green pull-left"><i class="fa fa-cogs bigger-180"></i></div>
        <div class="widget-content pull-left"><div class="title"> {{ $hospCount }}</div>
          <div class="comment">Hospitalisation En cours</div>
        </div><div class="clearfix"></div>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-md-6 col-xs-12">
    <div class="widget">
      <div class="widget-body">
        <div class="widget-icon blue pull-left"><i class="fa fa-spinner bigger-180"></i></div>
        <div class="widget-content pull-left"><div class="title">&nbsp;{{ $nbRequest}}</div>
          <div class="comment">Hospitalisation En attente</div>
        </div><div class="clearfix"></div>
      </div>
    </div>
  </div>
  </div><div class="space-12"></div>
    <div class="row">
    <div class="col-lg-3 col-md-6 col-xs-12">
    <div class="widget">
      <div class="widget-body">
          <div class="widget-icon pull-left">
            <i class="ace-icon fa fa-clock-o bigger-180"></i>
          </div>
          <div class="widget-content pull-left">
              <div class="title">&nbsp;{{ $nbrdvs }}</div>
              <div class="comment">Rendez-vous d'hospitalisation</div>
          </div><div class="clearfix"></div>
      </div>
    </div>
  </div>
    <div class="col-lg-3 col-md-6 col-xs-12">
    <div class="widget">
      <div class="widget-body">
          <div class="widget-icon pull-left">
           <i class="fa fa-bed bigger-180"></i>
          </div>
          <div class="widget-content pull-left">
              <div class="title">&nbsp;{{ $nbFreeBed }}</div>
              <div class="comment">Lit libre</div>
          </div><div class="clearfix"></div>
      </div>
    </div>
    </div>
    <div class="col-lg-3 col-md-6 col-xs-12">
    <div class="widget">
      <div class="widget-body">
        <div class="widget-icon pull-left"><i class="ace-icon fa fa-stethoscope bigger-180"></i></div>
        <div class="widget-content pull-left">
              <div class="title">&nbsp;{{ $consultsNbr }}</div>
              <div class="comment">Consultations aujourd'hui</div>
          </div><div class="clearfix"></div>
      </div>
    </div>
    </div>
    <div class="col-lg-3 col-md-6 col-xs-12">
    <div class="widget">
      <div class="widget-body">
        <div class="widget-icon pull-left"><span class="material-icons">swap_horizontal_circle</span>
        </div>
        <div class="widget-content pull-left">
          <div class="title">&nbsp;{{ $nbjPerHosp }} Jour</div>
          <div class="comment">Délai moyen d'hospitalisation</div>
        </div><div class="clearfix"></div>
      </div>
    </div>
    </div>
  </div><div class="space-12"></div>
  <div class="row">
    <div class="col-lg-6">
      <div class="widget">
        <div class="widget-title">
          <i class="fa fa-stethoscope"></i> Consultaions / Jour
          <a class="pull-right" href="{{route('stats.search',1)}}">Plus de statistiques</a><div class="clearfix"></div>
        </div>
        <div class="widget-body medium no-padding"><canvas id = "canvasconsul"></canvas></div>
      </div>
    </div>
    <div class="col-lg-6">
      <div class="widget">
        <div class="widget-title">
          <i class="menu-icon material-icons">local_hospital</i>Nombre d'hospitalisation
          <a class="pull-right" href="{{route('stats.search',2)}}">Plus de statistiques</a><div class="clearfix"></div>
        </div>
        <div class="widget-body medium no-padding"><canvas id = "Hospcanvas"></canvas></div>   
      </div>
    </div>
  </div><div class="space-12"></div>
  <div class="row">
    <div class="col-lg-6">
      <div class="widget">
        <div class="widget-title"><i class="fa fa-bed"></i> Lits
        <a class="pull-right" href="{{route('stats.search',3)}}">Plus de statistiques</a>
      </div>
      <div class="widget-body medium no-padding">
        <canvas id = "canvaslit" height="230" width="600"></canvas>
      </div>
      </div>
    </div>
    <div class="col-lg-6">
       <div class="widget">
        <div class="widget-title">
          <span class="material-icons">swap_horizontal_circle</span> Délai moyen d'hospitalisation
        </div>
        <div class="widget-body medium no-padding">
          <canvas id = "DMHOSP" height="230" width="600"></canvas>
        </div>
      </div>
    </div>  
  </div>
@endsection
@section('page-script')
<script type="text/javascript">
$(function(){
    var barChartDataHosp = {
    labels:  {!! $dates !!},
      datasets: [{
          label: 'Hospitalisation',
          backgroundColor: "#032cfc",
          data: {{ $nbhosp  }}
      }]
    };
    var barChartDataconsul = {
            labels: {!! $dates !!},
            datasets: [{
                label: 'Consultation',
                backgroundColor: "green",
                data: {{ $nbcons }}
            }]
    }; 
    var ctxCons = document.getElementById("canvasconsul").getContext("2d");
    window.myBar = new Chart(ctxCons, {
          type: 'bar',
          data: barChartDataconsul,
          options: {
            scales: {
              yAxes: [{
                  ticks: {
                      beginAtZero: true,
                      userCallback: function(label, index, labels) { 
                        if (Math.floor(label) === label) { 
                          return label;
                        }
                      }
                  },
                  scaleLabel: {
                      display: false
                  }
              }]
            },
            legend: {
              labels: {  // This more specific font property overrides the global property
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
    // hosp
    var ctxHosp = document.getElementById("Hospcanvas").getContext("2d");
    window.myBar = new Chart(ctxHosp, {
            type: 'bar',
            data: barChartDataHosp,
            options: {
              scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        userCallback: function(label, index, labels) { 
                          if (Math.floor(label) === label) { 
                            return label;
                          }
                        }
                    },
                    scaleLabel: {
                        display: false
                    }
                }]
              },
              legend: {
                labels: {
                    // This more specific font property overrides the global property
                    fontColor: '#0000ff',
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
    var ctxBed = document.getElementById("canvaslit").getContext("2d");
    window.myBar = new Chart(ctxBed, {
        type: 'pie',
        data: {
          labels: ['Libre','Affecté','Reservé', 'Bloqué'],
          datasets: [{
              data: {{ $datalit }},
              backgroundColor: [
                "#49be25",
                "#46BFBD",
                "#FF4500",
                ,"#FF0000",
              ],
            }]
        },
        options: {
            responsive:true, //metre ca popur regler dimention
            maintainAspectRatio: false,//metre ca popur regler dimention
            pieceLabel: {
                mode: 'value',
                position: 'outside',
                fontColor: '#000',
                format: function (value) {
                    return '$' + value;
                }
            },
            title: {
              display: true,
              text: 'Etats des lits',
              fontSize: 15,
              fontStyle: 'bold'
            },
            legend: {
              display: false,
              position: 'bottom',
            },
        }
    });  
    //deb
    var ctxdmo = document.getElementById("DMHOSP").getContext("2d");
    chart =  new Chart(ctxdmo, {
          type: 'line',
          data: {
              labels: {!! $monthLabels !!} ,
              datasets: [{
                  label: "DMH",
                  data: {{ $avHospStysub }},
                  backgroundColor:'#49be25',
                  borderColor:'#46BFBD',
                  borderWidth: 4,
              }]
          },
          options: {
              onClick: (e) => {
                const canvasPosition = Chart.helpers.getRelativePosition(e, chart);
              },
              interaction: {
                mode: 'nearest'
              },
              scales: {
                  xAxes: [{
                    gridLines: {
                        display: true,
                        drawBorder:true,
                    },
                    ticks: {
                      display: true,
                      fontFamily: "Montserrat",
                      fontColor: "#46BFBD",
                      fontSize: 14, 
                    }
                  }],
                  y: {
                     beginAtZero: true,
                     max: 40,
                  },
              }//scales
          }
    }); 
    //end test
   });
</script>
@endsection