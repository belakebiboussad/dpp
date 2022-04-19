@extends('app')
@section('main-content')
<div class="container-fluid">
  <div class="row"><div class="col-sm-12">@include('patient._patientInfo',['patient'=>$hosp->patient])</div></div><div class="space-12"></div>
  <div class="row">
    <div class="col-sm-7 widget-container-col">
      <div class="widget-box widget-color-blue">
        <div class="widget-header">
          <h5 class="widget-title lighter"><i class="ace-icon fa fa-table"></i>Actes</h5>
        </div>
        <div class="widget-body"> 
          <div class="widget-main">
            <table class="table  table-bordered table-hover">
              <thead>
                <tr>
                  <th class="center"><strong>Nom</strong></th><th class="center"><strong>Posologie</strong></th>
                  <th class="center"><strong>Médecin prescripteur</strong></th><th class="center"><strong>Date prescription</strong></th>
                  <th class="center"><em class="fa fa-cog"></em></th>
                </tr>
              </thead>
              <tbody>
                @foreach($hosp->visites as $visite)
                  @foreach($visite->actes as $acte )      
                    @if(!$acte->retire)
                    <tr id="acte-{{ $acte->id }}">
                      <td>{{ $acte->nom }}</td><td>{{ $acte->description }}</td>
                      <td>{{ $acte->visite->medecin->full_name }}</td><td>{{ $acte->visite->date_presc}}</td> 
                      <td class="center">
                        <button onclick ="getActdetail({{ $acte->id }})" style="cursor:pointer" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Résume du traitement"><i class="fa fa-eye fa-xs"></i></a></button>
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
    <div class="col-md-5 col-sm-5 widget-box transparent"  id="details"></div>       
  </div>
  <div class="row">
    <div class="col-sm-7 widget-container-col">
      <div class="widget-box widget-color-blue">
        <div class="widget-header">
          <h5 class="widget-title lighter"><i class="ace-icon fa fa-table"></i>Traitements</h5>
        </div>
        <div class="widget-body"> 
          <div class="widget-main">  
            <table  class="table  table-bordered table-hover">
        <thead>
          <tr>
            <th class="center"><strong>Denomination</strong></th>
            <th class="center"><strong>Posologie</strong></th>
            <th class="center"><strong>Médecin prescripteur</strong></th>
            <th class="center"><strong>Date prescription</strong></th>
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
              <td>{{ $trait->visite->date_presc}}</td> 
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
  <div class="row">
    <div class="col-sm-7 widget-container-col">
      <div class="widget-box widget-color-blue">
        <div class="widget-header">
          <h5 class="widget-title lighter"><i class="ace-icon fa fa-table"></i>Constantes</h5>
        </div>
        <div class="widget-body"> 
          <div class="widget-main">  
            <table  class="table  table-bordered table-hover">
              <thead>
              <tr>
                <th class="center"><strong>Constante</strong></th>
                <th class="center"><strong>Observation</strong></th>
                <th class="center"><em class="fa fa-cog"></em></th>
              </tr>
              </thead>
               <tbody>
                @foreach($lastVisite->prescreptionconstantes->constantes as $const)
                <tr>
                  <td>{{ $const->description }}</td>
                  @if($loop->first)
                  <td class="align-middle" rowspan = "{{$lastVisite->prescreptionconstantes->constantes->count() }}">
                  {{ $lastVisite->prescreptionconstantes->observation }}
                  </td>
                  @endif
                  <td class="center">
                    <button  style="cursor:pointer" class="btn btn-primary btn-xs setConst" data-toggle="tooltip" title="" value="{{ $const->id }}" data-unite="{{ $const->id }}"><i class="fa fa-eye fa-xs"></i></a></button>
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
</div>
@include('soins.ModalFoms.acteExecuteModal')@include('soins.ModalFoms.traitExecuteModal')@include('constantes.scripts.functions')
<script type="text/javascript">
  function getActdetail(id){ // var url= '{{ route ("acteExec.index", ":slug") }}'; // url = url.replace(':slug',id);
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
        acte_id : $(this).val(),
        does    : $("#fait").is(':checked')?1:0,
        obs     : $('#obs').val(),
        ordre    : $(this).data('acte-ordre')
      };
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
      });
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
        trait_id : $(this).val(),
        does     : $("#faitT").is(':checked')?1:0,
        obs      : $('#observ').val(),
        ordre    : $(this).data('trait-ordre')  
      };
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
      });
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
        data:formData,//{   id :  $(this).val() , hosp_id= '{{-- $hosp->id--}}' };
        success:function(data,status, xhr){
          $('#details').html(data);
        },
        error:function(data){
          console.log("error acte details")
        }
      });
      
    });
  });
 </script> 
@endsection