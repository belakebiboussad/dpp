@extends('app')
@section('title','Rechercher un Fonctionnaire')
@section('page-script')
 {{-- <script src = "https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"> </script> --}}
 <script>
       $(document).ready(function(){
              event.preventDefault();
                $.ajax({
                       type : 'get',
                      url : '{{URL::to('searchdate')}}',
                      data:{},
                      success:function(data,status, xhr){
                              for (key in data) {
                                    var datalit = data.datalit;
                              }     
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
                      }
              });
    });
</script>
@endsection
@section('main-content')
<div class="page-content">
    <div class="page-header">Tableau du Board</div>
    <div class="row">
      <div class="col-lg-3 col-md-6 col-xs-12">
            <div class="widget">
                <div class="widget-body">
                    <div class="widget-icon orange pull-left">
                        <i class="fa fa-desktop"></i>
                    </div>
                    <div class="widget-content pull-left">
                        <div class="title">14</div>
                        <div class="comment">Lits</div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
      <div class="col-sm-12 infobox-container">
      <div class="infobox infobox-red">
      <div class="infobox-icon"><i class="menu-icon fa fa-bed" aria-hidden="true"></i> </div>
      <div class="infobox-data">
        <span class="infobox-data-number">{{ App\modeles\lit::all()->count() }}</span>
        <div class="infobox-content"><b>Lits</b></div>
      </div>
    </div>
     <div class="pull-right" style ="margin-top:-0.5%;">
                    <a href="{{route('stats.search')}}" class ="btn btn-white btn-info btn-bold btn-xs">statistique Avancée&nbsp;<i class="ace-icon fa fa-arrow-circle-right bigger-120 black"></i></a>
                </div>
</div>
</div>
    <div class="row"><div class="panel panel-default ">  </div><!-- panel -->
    </div><!-- row -->
    <div class="row" id="stat" >
        <div class="col-sm-12">
            <div class="widget-box transparent">
                <div class="widget-header widget-header-flat widget-header-small">
                    <h5 class="widget-title"></h5>
                    <label for=""><span class="badge badge-info numberResult"></span></label>
                    <label for=""><span class="badge badge-info numberResultt"></span></label>
                </div>
                <div class="bodycontainer scrollable" id="listhospit">
                  <div class = "col-md-10 offset-md-1" >
                  <div class = "panel panel-default" >
                 <div class = "panel-header" > Lits</div>
                 <div class = "panel-body" >
                    <canvas id = "canvaslit"> </canvas>
                  </div >


            </div >
        </div >
    </div >
</div >

</div>
</div>

</div>
@endsection
