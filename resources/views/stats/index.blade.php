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
              <div class="title">&nbsp;{{ $medsCount }}</div>
              <div class="comment">Medecins</div>
          </div>
          <div class="clearfix"></div>
      </div>
    </div>
  </div>
        <div class="col-lg-3 col-md-6 col-xs-12">
            <div class="widget">
                <div class="widget-body">
                    <div class="widget-icon  pull-left">
                       <i class="fa fa-users bigger-180"></i>
                    </div>
                    <div class="widget-content pull-left">
                        <div class="title">&nbsp;{{ $infsCount  }}</div>
                        <div class="comment">Infirmiers</div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-xs-12">
            <div class="widget">
                <div class="widget-body">
                    <div class="widget-icon green pull-left">
                      <i class="fa fa-cogs bigger-180"></i>
                    </div>
                    <div class="widget-content pull-left">
                        <div class="title">&nbsp; {{ $hospCount }}</div>
                        <div class="comment">Hospitalisation En cours</div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-xs-12">
          <div class="widget">
            <div class="widget-body">
              <div class="widget-icon blue pull-left">
                  <i class="fa fa-spinner bigger-180"></i>
              </div>
              <div class="widget-content pull-left">
                <div class="title">&nbsp;{{ $nbRequest}}</div>
                <div class="comment">Hospitalisation En attente</div>
              </div>
              <div class="clearfix"></div>
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
          </div>
          <div class="clearfix"></div>
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
          </div>
          <div class="clearfix"></div>
      </div>
    </div>
    </div>
    <div class="col-lg-3 col-md-6 col-xs-12">
    <div class="widget">
      <div class="widget-body">
          <div class="widget-icon pull-left">
            <i class="ace-icon fa fa-stethoscope bigger-180"></i>
          </div>
          <div class="widget-content pull-left">
              <div class="title">&nbsp;{{ $consultsNbr }}</div>
              <div class="comment">Consultations aujourd'hui</div>
          </div>
          <div class="clearfix"></div>
      </div>
    </div>
    </div>
  </div><div class="space-12"></div>
  <div class="row">
    <div class="col-lg-6">
        <div class="widget">
        <div class="widget-title">
          <i class="fa fa-stethoscope"></i> Consultaions / Jour
          <a class="pull-right" href="/stats/view">Plus de statistiques</a><div class="clearfix"></div>
        </div>
        <div class="widget-body medium no-padding">
          <canvas id = "canvasconsul" style="width:300px !important;height:150px !important;"></canvas>
        </div>
      </div>
    </div>
    <div class="col-lg-6">
      <div class="widget">
        <div class="widget-title">
          <i class="fa fa-cloud-download"></i>Nombre d'hospitalisation
          <a class="pull-right" href="/stats/view">Plus de statistiques</a><div class="clearfix"></div>
        </div>
        <div class="widget-body medium no-padding">
         <!--  <div id="bandwidthChart" class="morrisChart"> </div> -->
          <canvas id = "Hospcanvas"></canvas>
        </div>
      </div>
    </div>
  </div>
  <div class="space-12"></div>
  <div class="row">
    <div class="col-lg-6">
    <div class="widget">
        <div class="widget-title">
          <i class="fa fa-cloud-download"></i>Lits
          <a class="pull-right" href="/stats/view">Plus de statistiques</a>
          <div class="clearfix"></div>
        </div>
        <div class="widget-body medium no-padding">
          <div id="bandwidthChart" class="morrisChart">
            <canvas id = "canvaslit"></canvas>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-6">
      
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
          backgroundColor: "Bleu",
          data: {{ $nbhosp  }},
      }]
    };
     var barChartDataconsul = {
            labels: {!! $dates !!},
            datasets: [{
                label: 'Consultation',
                backgroundColor: "green",
                data: {{ $nbcons }},
            }]
        }; 
    /*
    $.ajax({
      type : 'get',
      url : '{{URL::to('searchdate')}}',
      data:{},
      success:function(data,status, xhr){
        for (key in data) {
          var date = data.date;
          var nbhosp = data.nbhosp;
          var nvhosp = data.nvhosp;
          var nbcons = data.nbcons;
          var datalit = data.datalit;
          //$(".nbrconsult").html(xhr.getResponseHeader("nbcons"));
           // $(".numberhosp").html(xhr.getResponseHeader("nbhosp")); // $(".nouvhosp").html(xhr.getResponseHeader("nvhosp"));      
        }
        var barChartDataconsul = {
            labels: date, date,
            datasets: [{
                label: 'Consultation',
                backgroundColor: "green",
                data: nbcons
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
        var ctxBed = document.getElementById("canvaslit").getContext("2d");
        window.myBar = new Chart(ctxBed, {
          type: 'pie',
          data: {
            labels: ['Reservé', 'Affecté', 'Libre'],
            datasets: [{
              data: datalit,
              backgroundColor: [
                "#F7464A",
                "#46BFBD",
                "#FDB45C",
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
      } 
    })
*/
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

});
</script>
@endsection