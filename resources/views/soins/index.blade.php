@extends('app')
@section('main-content')
<div class="container-fluid">
  <div class="row"><div class="col-sm-12">@include('patient._patientInfo',['patient'=>$hosp->patient])</div></div>
  <div class="pull-right">
   <a href="{{route('hospitalisation.index')}}" class="btn btn-white btn-info btn-bold"><i class="ace-icon fa fa-list bigger-120 blue"></i>Hospitalisations</a>
  </div><div class="space-12"></div>
  <div class="row">
    <div class="col-sm-6 widget-container-col">
      <div class="widget-box widget-color-blue">
        <div class="widget-header">
          <h5 class="widget-title lighter"><i class="ace-icon fa fa-table"></i>Actes</h5>
        </div>
        <div class="widget-body"> 
          <div class="widget-main">
            <table class="table  table-bordered table-hover">
              <thead>
                <tr>
                  <th class="center">Nom</th><th class="center">Posologie</th>
                  <th class="center">Médecin prescripteur</th><th class="center">Date prescription</th>
                  <th class="center"><em class="fa fa-cog"></em></th>
                </tr>
              </thead>
              <tbody>
                @foreach($hosp->visites as $visite)
                  @foreach($visite->actes as $acte )      
                    @if(!$acte->retire)
                    <tr id="acte-{{ $acte->id }}">
                      <td>{{ $acte->nom }}</td><td>{{ $acte->description }}</td>
                      <td>{{ $acte->visite->medecin->full_name }}</td><td>{{ $acte->visite->date_formated}}</td><td class="center">
                        <button onclick ="getActdetail({{ $acte->id }})" style="cursor:pointer" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Résume du l'acte"><i class="fa fa-eye fa-xs"></i></a></button>
                      </td> 
                    </tr>
                    @endif
                  @endforeach
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-sm-6 widget-box transparent" id="details"></div>       
  </div>
  @if(! is_null($lastVisite))  
  <div class="row">
    <div class="col-sm-6 widget-container-col">
      <div class="widget-box widget-color-blue">
        <div class="widget-header">
          <h5 class="widget-title lighter"><i class="ace-icon fa fa-table"></i>Traitements</h5>
        </div>
        <div class="widget-body"> 
          <div class="widget-main">  
            <table  class="table  table-bordered table-hover">
        <thead>
          <tr>
            <th class="center">Denomination</th>
            <th class="center">Posologie</th>
            <th class="center">Médecin prescripteur</th>
            <th class="center">Date prescription</th>
            <th class="center"><em class="fa fa-cog"></em></th>
          </tr>
        </thead>
        <tbody>
        @foreach($hosp->visites as $visite)
          @foreach($visite->traitements as $trait)
            <tr id="acte-{{ $trait->id }}">
              <td>{{ $trait->medicament->nom }}</td> 
              <td>{{ $trait->posologie }}</td>
              <td>{{ $trait->visite->medecin->full_name }}</td> 
              <td>{{ $trait->visite->date}}</td> 
              <td class="center">
                <button onclick ="getTraitdetail({{$trait->id }})" style="cursor:pointer" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Résume du traitement"><i class="fa fa-eye fa-xs"></i></a></button>
              </td> 
            </tr>
          @endforeach
        @endforeach
        </tbody>
      </table>  
          </div>
        </div>
      </div>      
    </div>
  </div>
  @endif
  @if((! is_null($lastVisite)) && (! is_null($lastVisite->constantes)))
  <div class="row">
    <div class="col-sm-6 widget-container-col">
      <div class="widget-box widget-color-blue">
        <div class="widget-header">
          <h5 class="widget-title lighter"><i class="ace-icon fa fa-table"></i>Constantes</h5>
        </div>
        <div class="widget-body"> 
          <div class="widget-main">  
            <table  class="table  table-bordered table-hover">
              <thead>
              <tr>
                <th class="center">Nom</th> <th class="center">Observation</th>
                <th class="center"><em class="fa fa-cog"></em></th>
              </tr>
              </thead>
              <tbody> 
                @foreach($lastVisite->constantes as $const)
                <tr>
                  <td>{{ $const->description }}</td><td>{{ $const->pivot->obs}}</td>
                  <td class="center">
                    <button  style="cursor:pointer" class="btn btn-primary btn-xs setConst" data-toggle="tooltip"  value="{{ $const->id }}" data-unite="{{ $const->id }}"><i class="fa fa-eye fa-xs"></i></a></button>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endif
</div>
@include('soins.ModalFoms.acteExecuteModal')@include('soins.ModalFoms.traitExecuteModal')@include('constantes.scripts.functions')
<script type="text/javascript">
  function getActdetail(id){ 
   var url = '{{ route("acteExec.index") }}';
    $.ajax({
        url : url,
        type : 'GET',
        data:{   id :  id  },
        success:function(data,status, xhr){
          $('#details').html(data);
        },
        error:function(data){
          console.log("error acte details")
        } 
    });
  }
  function getTraitdetail(id){
    var url= '{{ route ("traitement.show", ":slug") }}';
    url = url.replace(':slug',id);
    $.ajax({
        url : url,
        type : 'GET',
        success:function(data,status, xhr){
          $('#details').html(data);
        },
        error:function(data){
          console.log("error traitement details")
        } 
    });
  }
  $(function(){/*$("#fait").change(function() {  if ($(this).is(':checked')) $("#obs").addClass("hidden");else $("#obs").removeClass("hidden");})*/
    $('#acteExecute').on('shown.bs.modal', function (event) {
      $(".execActe").val($(event.relatedTarget).data('acte-id'));
      $(".execActe").attr('data-acte-ordre',$(event.relatedTarget).data('acte-ordre'));
    });
    $(".execActe").click(function(e){//runActe
      e.preventDefault();
      var formData = {
        _token: CSRF_TOKEN,
        acte_id : $(this).val(),
        does    : $("#fait").is(':checked')?1:0,
        obs     : $('#obs').val(),
        ordre    : $(this).data('acte-ordre')
      };
      $.ajax({
          type : 'POST',
          url :"{{ route('acteExec.store') }}",
          data:formData,
          success:function(data){   
            $('#acteExecute').modal('hide');//if(data.does == 1)$(".acte-" + data.ordre).remove();
              $('button[data-acte-ordre=' + data.ordre + ']'+'[data-acte-id='+data.acte_id+']').prop("disabled",true);    
          }
      })
    }); ///trait
    $('#traitExecute').on('shown.bs.modal', function (event) {
      $(".execTrait").val($(event.relatedTarget).data('trait-id'));
      $(".execTrait").attr('data-trait-ordre',$(event.relatedTarget).data('trait-ordre'));
    });
    $(".execTrait").click(function(e){//runActe
      e.preventDefault();
      var formData = {
        _token: CSRF_TOKEN,
        trait_id : $(this).val(),
        does     : $("#faitT").is(':checked')?1:0,
        obs      : $('#observ').val(),
        ordre    : $(this).data('trait-ordre')  
      };
      $.ajax({
          type : 'POST',
          url :"{{ route('traitExec.store') }}",
          data:formData,
          success:function(data){   
            $('#traitExecute').modal('hide');//if(data.does == 1) $(".admin-" + data.ordre).remove();
            $('button[data-trait-ordre=' + data.ordre + ']'+'[data-trait-id='+data.trait_id+']').prop("disabled",true);
          }
      })
    });
    $(".setConst").click(function(e){
      var url = '{{ route("const.index") }}';
      var formData = {
        id :  $(this).val(),
        hosp_id : '{{ $hosp->id}}'
      };
      $.ajax({
        url : url,
        type : 'GET',
        data:formData,
        success:function(data,status, xhr){
           $('#details').html(data);
        }
      });
    });
  });
 </script> 
@stop