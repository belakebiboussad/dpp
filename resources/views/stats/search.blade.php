

@extends('app')
@section('title','Rechercher ')
@section('page-script')
<script src = "https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"> </script>



<script>
      
    $(document).ready(function(){
        $(document).on('click','.statistique',function(event){
            event.preventDefault();
              
            var service = $('#service').val();
            var medecin = $('#medecin').val();
            
            var Datdebut = $('#Dat_debut').val();
            var Datfin = $('#Dat_fin').val();
            $.ajax     ({
                    type : 'get',
                    url : '{{URL::to('searstat')}}',
         data:{'Datdebut':Datdebut,'Datfin':Datfin,'service':service,medecin:medecin},
                    success:function(data,status, xhr){

                 // $("#canvashosp").hide();

                   for (key in data) {


                      var date = data.date;
                      var nbhosp = data.nbhosp;
                     // if(nbhosp!=0){  $("#canvashosp").show();}
                      var nvhosp = data.nvhosp;
                      var nbcons = data.nbcons;
                      var service = data.services;
                      var datalit = data.datalit;
                       var medecin = data.medecin;
                     
                                

                          }
            //alert(nvhosp);
            // $('#sample-form').hide();
            // $('#validation-form').removeClass('hide');

                  
                    var etat =$("#etat").val();
                   if(etat==1)           {$("#stat").show();
                                          $("#canvashosp").show();
                                          $("#canvaslit").hide();
                                          $("#canvasconsul").hide();}
                    else if(etat==2)      { $("#stat").show();
                                            $("#canvashosp").hide();
                                          $("#canvasconsul").show();
                                          $("#canvaslit").hide();
                                           alert($("#etat").val());
                                         // $("#canvaslit").hide();
                                        //  $("#canvashosp").hide();
                                          } 
                    else if(etat==3)      {
                                          $("#stat").show();
                                          $("#canvashosp").hide();                                          
                                          $("#canvasconsul").hide();
                                          $("#canvaslit").show();
                                          } 
                      else if(etat==0){

                        $("#stat").show();
                        $("#canvaslit").show();
                        $("#canvasconsul").show();
                        $("#canvashosp").show();
                    }                                                                  

                  // if(data != "")
                  //       {   $("#stat").show();

                  //        if(datalit== "")
                  //           {
                  //                $("#canvaslit").hide();
                  //           }
                  //        if(nbhosp== "")
                  //           {
                  //                $("#canvashosp").hide();
                  //           }
                  //         else
                  //             {
                  //              $("#canvashosp").show();

                  //             }  
                  //        if(nbcons== "")
                  //           {
                  //                $("#canvasconsul").hide();
                  //           }
                  //           else
                  //           {
                  //               $("#canvasconsul").show();
                  //           }      
                           
                  //       }else
                  //       {   

                  //          $("#stat").hide();



                            
                  //       }
                      

  var ctxcoss = document.getElementById("canvaslit").getContext("2d");
  window.myBar = new Chart(ctxcoss, {
  type: 'pie',
  data: {

    labels: ['Reservé', 'Affecté', 'Libre'],
    datasets: [{
      data: datalit,
       backgroundColor: [
        "#F7464A",
        "#46BFBD",
        "#FDB45C",
        //"#949FB1",
        //"#4D5360",
      ],
    }]
  },
  options: {

       
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
            display: true,
            position: 'bottom',
        },

  }
});


                  
                    var barChartDataconsul = {
                                labels: date,date,
                                datasets: [{
                                    label: 'nouveau consultation',
                                    backgroundColor: "pink",
                                    data: nbcons
                                },

                                ]
                            };



        var ctxcos = document.getElementById("canvasconsul").getContext("2d");
        window.myBar = new Chart(ctxcos, {
            type: 'bar',
            data: barChartDataconsul,


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
                 
             // $(".numberResult").html(xhr.getResponseHeader("nbhosp"));


                                var barChartData = {
                                labels: date,date,
                                datasets: [{
                                    label: 'nouveau hospitalier',
                                    backgroundColor: "pink",
                                    data: nvhosp
                                },
                                   {label: 'nombre hospitalisation',
                                    backgroundColor: "blue",
                                    data:  nbhosp

                                },
                                ]
                            };



        var ctx = document.getElementById("canvashosp").getContext("2d");
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
         }
        });

    });

    });

</script>

@endsection
@section('main-content')
<div class="page-content">
    <div class="row">
        <div class="col-sm-12 center">
            <h2><strong>Bienvenue Docteur:</strong><q class="blue">{{ Auth::User()->employ->nom }} {{ Auth::User()->employ->prenom }}</q></h2>
        </div>
    </div>
    <div class="space-12"></div>
   <div class="row">
    <div class="col-sm-12 col-md-12">
      <div class="panel panel-default">
      <div class="panel-heading left"> 
        <H4><strong>Rechercher </strong></H4>
        <div class="pull-right">
          <a href="{{route('stat.index')}}" class ="btn btn-white btn-info btn-bold btn-xs">Statistique&nbsp;<i class="ace-icon fa fa-arrow-circle-right bigger-120 black"></i></a>
        </div>
      </div>
      <div class="panel-body">
        <div class="row">
            @if(Auth::user()->role_id != 14)
          <div class="form-group col-sm-2"><label class="control-label">Service:</label>
           
             <select class="form-control autofield" class="input-group col-sm-12 col-xs-12" id="service" name="idservice">
                        <option value="">Choisir Un Service...</option>
                        @foreach($services as $service)
                        <option value="{{ $service->id }}">{{ $service->nom }}</option>
                        @endforeach
                    </select>
                    <span class="glyphicon glyphicon-search form-control-feedback"></span>            
            </div>
              @endif
            <div class="form-group col-sm-2"><label class="control-label">Medcin:</label>
           
             <select class="form-control autofield" class="input-group col-sm-12 col-xs-12" id="medecin" name="idmedecin">
                        <option value="">Choisir Un Medcin...</option>
                          @foreach($medecins as $medecin)
                        <option value="{{ $medecin->id }}">{{$medecin->full_name }}</option> 
                    @endforeach
                    </select>
                    <span class="glyphicon glyphicon-search form-control-feedback"></span>            
             </div>
             

             <div class="form-group col-sm-2"><label class="control-label">Date de debut:</label>
              <div class="input-group col-sm-12 col-xs-12">
                <input type="text" class="form-control date-picker ltnow" id="Dat_debut" name="Dat_debut" data-date-format="yyyy-mm-dd" placeholder="YYYY-MM-DD" data-toggle="tooltip" data-placement="left" title="Date Naissance">
                <span class="glyphicon glyphicon-search form-control-feedback"></span>
              </div>    
            </div>

            <div class="form-group col-sm-2"><label class="control-label">Date de fin:</label>
              <div class="input-group col-sm-12 col-xs-12">
                <input type="text" class="form-control date-picker ltnow" id="Dat_fn" name="Dat_fn" data-date-format="yyyy-mm-dd" placeholder="YYYY-MM-DD" data-toggle="tooltip" data-placement="left" title="Date Naissance">
                <span class="glyphicon glyphicon-search form-control-feedback"></span>
              </div>    
            </div>



              <div class="form-group col-sm-2"><label class="control-label">Etat statistique:</label>           
              <select class="form-control autofield" class="input-group col-sm-12 col-xs-12" id="etat" name="etat">
                        <option value="0">Choisir Un Statistique...</option>
                        <option value="1">Hospitalisation</option>
                        <option value="2">Consultation</option>
                         <option value="3">Lit</option>                        
                    </select>
                    <span class="glyphicon glyphicon-search form-control-feedback"></span>            
             </div>
          
          
            
            
              </div>
            </div>    
        
        </div>
      </div>  {{-- body --}}
      <div class="panel-footer">
        <button type="submit" class="btn btn-sm btn-primary statistique"><i class="fa fa-search"></i>&nbsp;Rechercher</button>
        
      </div>
    </div><!-- panel -->
    </div>    
  </div>
            
               

       
    <div class="row" id="stat" hidden>
        <div class="col-sm-12">
            <div class="widget-box transparent">
                <div class="widget-header widget-header-flat widget-header-small">
                    <h5 class="widget-title"><img src="img/policeman.png" class="img1 img-thumbnail">Resultats: </h5>
                    <label for=""><span class="badge badge-info numberResult"></span></label>
                    <label for=""><span class="badge badge-info numberResultt"></span></label>

                </div>
                <div class="bodycontainer scrollable" id="listhospit">
                  <div class = "col-md-10 offset-md-1" >
                  <div class = "panel panel-default" >
                 <div class = "panel-header" > Tableau de bord </div>
                 <div class = "panel-body" >
                    <canvas id = "canvashosp" height = "280" width = "600" hidden> </canvas>
                    <canvas id = "canvasconsul" height = "280" width = "600" hidden> </canvas>
                    <canvas id = "canvaslit"  hidden> </canvas>

                 
                      </div >


            </div >
        </div >
    </div >
</div >

</div>
</div>

</div>
@endsection
