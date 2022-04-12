@extends('app')
@section('main-content')
<div class="container-fluid">
  <div class="row"><div class="col-sm-12"><?php $patient = $hosp->patient; ?>@include('patient._patientInfo')</div></div>
  <div class="space-12"></div>
  <div class="row">
    <div class="col-xs-7 label label-lg label-primary arrowed-in arrowed-right">
      <span class="f-16"><strong>Actes</strong></span>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-7">
      <table class="table  table-bordered table-hover">
        <thead>
          <tr>
            <th class="center"><strong>Nom acte</strong></th>
            <th class="center"><strong>Posologie</strong></th>
            <th class="center"><strong>Médecin prescripteur</strong></th>
            <th class="center"><strong>Date prescription</strong></th>
            <th class="center"><em class="fa fa-cog"></em></th>
          </tr>
        </thead>
        <tbody>
          @foreach($hosp->visites as $visite)
            @foreach($visite->actes as $acte )      
              @if(!$acte->retire)
              <tr id="acte-{{ $acte->id }}">
                <td>{{ $acte->nom }}</td> 
                <td>{{ $acte->description }}</td>
                <td>{{ $acte->visite->medecin->full_name }}</td> 
                <td>{{ $acte->visite->date}} à {{ $acte->visite->heure }}</td>
                <td class="center"><!-- <button data-toggle="modal" class="btn btn-xs btn-primary" data-target="#acteExecute" data-acte-id="{{ $acte->id }}" data-dismiss="modal"><i class="fa fa-eye fa-xs"></i></button> -->
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
  <div class="row">
    <div class="col-xs-7 label label-lg label-primary arrowed-in arrowed-right">
      <span class="f-16"><strong>traitements</strong></span>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-7">
      <table  class="table  table-bordered table-hover">
        <thead>
          <tr>
            <th class="center"><strong>Nom médicament</strong></th>
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
              <td>{{ $trait->visite->date}} à {{$trait->visite->heure}}</td> 
              <td class="center">
                <button onclick ="getTraitdetail({{$trait->id }})" style="cursor:pointer" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Résume du traitement"><i class="fa fa-eye fa-xs"></i></a></button>
              </td> 
            </tr>
          @endforeach
        @endforeach
        </tbody>
      </table>
    </div>
    <div class="col-md-5 col-sm-5 widget-box transparent"  id="details"></div>    
  </div>
</div>
@include('soins.ModalFoms.acteExecuteModal')@include('soins.ModalFoms.traitExecuteModal')
<script type="text/javascript">
  function getActdetail(id){
    // var url= '{{ route ("acteExec.index", ":slug") }}'; // url = url.replace(':slug',id);
   var url = '{{ route("acteExec.index") }}';
    $.ajax({
        url : url,
        type : 'GET',
        data:{   id :  id  },
        success:function(data,status, xhr){
          $('#details').html(data);
        },
        error:function(data){
          alert("Error");
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
      var acteId = $(event.relatedTarget).data('acte-id');
      $(".execActe").val(acteId);
    });
    $(".execActe").click(function(e){//runActe
      e.preventDefault();
      var formData = {
        acte_id : $(this).val(),
        does    : $("#fait").is(':checked')?1:0,
        obs     : $('#obs').text()
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
           $('#acteExecute').modal('hide');
           $("#acte-" + data.acte_id).remove();
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
           $('#traitExecute').modal('hide');
           if(data.does == 1)
             $("#admin-" + data.ordre).remove();
          }
      })
    });
  });
 </script> 
@endsection