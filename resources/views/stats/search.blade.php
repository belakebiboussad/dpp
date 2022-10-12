@extends('app')
@section('main-content') 
<div class="row">
  <div class="col-sm-12">
    <div class="panel panel-default">
      <div class="panel-heading left">
      <H4>
          @switch($id)
            @case("1")
              Consultations
              @break
            @case("2")
              Hospitalisations
              @break
            @case("3")
              Lits
              @break
            @Default
              @break
          @endswitch 
        </H4>
      </div>
      <div class="panel-body">
        <div class="row">
          <div class="form-group {{ Auth::user()->role_id == 13 ? 'col-sm-3 col-xs-6' : 'hidden' }}"><label class="control-label">Service:</label>
            <div class="input-group col-sm-12 col-xs-12">
              <select class="form-control" class="input-group" id="service">
                <option value="">Choisir un uervice...</option>
                @foreach($services as $service)
                  <option value="{{ $service->id }}">{{ $service->nom }}</option>
                @endforeach
              </select>
              <span class="glyphicon glyphicon-search form-control-feedback"></span>            
            </div>
          </div>
          <div class="form-group {{ Auth::user()->role_id == 13 ? 'col-sm-3 col-xs-6' : 'col-sm-4' }}" {{ $id == 3 ? 'hidden':''}}><label class="control-label">Medcin:</label>
            <div class="input-group col-sm-12 col-xs-12">
            <select class="form-control" class="input-group col-sm-12 col-xs-12" id="medecin">
              <option value="">Choisir Un Medcin...</option>
              @foreach($medecins as $medecin)
                <option value="{{ $medecin->id }}">{{$medecin->full_name }}</option> 
              @endforeach
            </select>
            <span class="glyphicon glyphicon-search form-control-feedback"></span>   
            </div>         
          </div>
          <div class="form-group {{ Auth::user()->role_id == 13 ? 'col-sm-3 col-xs-6' : 'col-sm-4' }}"><label class="control-label">Date de debut:</label>
            <div class="input-group col-sm-12 col-xs-12">
              <input type="text" class="form-control date-picker" id="Dat_debut" data-date-format="yyyy-mm-dd" placeholder="YYYY-MM-DD" data-toggle="tooltip" data-placement="left" title="">
              <span class="glyphicon glyphicon-search form-control-feedback"></span>
            </div>    
          </div>
          <div class="form-group {{ Auth::user()->role_id == 13 ? 'col-sm-3 col-xs-6' : 'col-sm-4' }}"><label class="control-label">Date de fin:</label>
          <div class="input-group col-sm-12 col-xs-12">
            <input type="text" class="form-control date-picker" id="Dat_fn" data-date-format="yyyy-mm-dd" placeholder="YYYY-MM-DD" data-toggle="tooltip" data-placement="left" title="">
            <span class="glyphicon glyphicon-search form-control-feedback"></span>    
          </div>
          </div>
        </div>
      </div>
      <div class="panel-footer">
        <button type="submit" class="btn btn-sm btn-primary statistique">
            <i class="fa fa-search"></i>Rechercher</button>
      </div>
    </div>
  </div>
</div>
<div class="row" id="stat" hidden>
  <div class="col-sm-12">
    <div class="widget-box transparent">
      <div class="widget-header widget-header-flat widget-header-small">
        <h5 class="widget-title">Resultats: </h5>
        <label><span class="badge badge-info numberResult"></span></label>
      </div>
      <div class="bodycontainer scrollable">
      <div class = "col-md-10 offset-md-1">
      <div class = "panel panel-default"><div class = "panel-header"></div>
        <div class = "panel-body">
          <canvas id ="canvasId" height = "280" width = "600"></canvas>
        </div>
      </div>
      </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('page-script')
<script>    
  $(function(){
    $(document).on('click','.statistique',function(event){
        var service = $('#service').val();
        if(isEmpty(service))
         var service = '{{  Auth::user()->employ->service_id }}';
        var formData = {
            service : service,
            medecin : $('#medecin').val(),
            datDebut : $('#Dat_debut').val(),
            datFin : $('#Dat_fin').val(),
            className : {{ $id }}
        };
        $.ajax({
            type : 'get',
            url : '{{URL::to('searstat')}}',
            data: formData,
            success:function(data,status, xhr){ // $("#canvashosp").hide();
            $("#stat").show();
            $(".numberResult").html(data.objNbr);
            var barChartData = {
                        labels: data.dates,
                        datasets: [{
                          label: data.className,
                          backgroundColor: "green",
                          data: data.dataArray,
                        }]
            };
            var ctx = document.getElementById("canvasId").getContext("2d");
            window.myBar = new Chart(ctx, {
              type: 'bar',
              data: barChartData,// Chart.defaults.global.elements.line.fill = false;
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
                  labels: {// This more specific font property overrides the global property
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

      })//ajax
  });
})
</script>
@endsection