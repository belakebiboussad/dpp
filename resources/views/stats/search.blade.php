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
          <div class="form-group {{ Auth::user()->role_id == 13 ? 'col-sm-3 col-xs-6' : 'col-sm-4' }}"><label class="control-label">Medcin:</label>
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
        <button type="submit" class="btn btn-sm btn-primary statistique"><i class="fa fa-search"></i>Rechercher</button>
      </div>
    </div>
  </div>
</div>
<div class="row" id="stat" hidden>
  <div class="col-sm-12">
    <div class="widget-box transparent">
      <div class="widget-header widget-header-flat widget-header-small">
        <h5 class="widget-title"><img src="img/policeman.png" class="img1 img-thumbnail">Resultats: </h5>
          <label><span class="badge badge-info numberResult"></span></label>
          <label><span class="badge badge-info numberResultt"></span></label>
      </div>
      <div class="bodycontainer scrollable" id="listhospit">
      <div class = "col-md-10 offset-md-1" >
      <div class = "panel panel-default" >
        <div class = "panel-header" > Tableau de bord </div>
        <div class = "panel-body" >
          <canvas id = "canvashosp" height = "280" width = "600" hidden> </canvas>
          <canvas id = "canvasconsul" height = "280" width = "600" hidden> </canvas>
          <canvas id = "canvaslit"  hidden> </canvas>
        </div>
      </div>
      </div >
    </div >
</div >

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
            Datdebut : $('#Dat_debut').val(),
            Datfin : $('#Dat_fin').val(),
            className : {{ $id }},
        };
        $.ajax({
            type : 'get',
            url : '{{URL::to('searstat')}}',
            data: formData,
            success:function(data,status, xhr){ // $("#canvashosp").hide();
              alert(data);
              // for (key in data) {
              //   var date = data.date;
              //   var nbhosp = data.nbhosp;// if(nbhosp!=0){  $("#canvashosp").show();}
              //   var nvhosp = data.nvhosp;
              //   var nbcons = data.nbcons;
              //   var service = data.services;
              //   var datalit = data.datalit;
              //   var medecin = data.medecin;
              // }
            }
      })//ajax
  });
})
</script>
@endsection