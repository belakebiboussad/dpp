@extends('app')
@section('style')
@endsection
@section('main-content')
<div class="container-fluid">
  <div class="row"><div class="col-sm-12"><?php $patient = $hosp->patient; ?>@include('patient._patientInfo')</div></div>
  <div class="space-12"></div>
  <div class="row">
    <div class="col-xs-6 label label-lg label-primary arrowed-in arrowed-right">
      <span class="f-16"><strong>Actes</strong></span>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-6">
      <table id="" class="table  table-bordered table-hover">
        <thead>
          <tr>
            <th class="center"><strong>Nom acte</strong></th>
            <th class="center"><strong>Posologie</strong></th>
            <th class="center"><strong>Médecin prescripteur</strong></th>
            <th class="center"><em class="fa fa-cog"></em></th>
          </tr>
        </thead>
        <tbody>
          @foreach($hosp->getlastVisite()->actes as $acte )
            @if(!$acte->retire)
              <tr id="acte-{{ $acte->id }}">
                <td>{{ $acte->nom }}</td> 
                <td>{{ $acte->description }}</td>
                <td>{{ $acte->visite->medecin->full_name }}</td> 
                <td class="center">
                  <button data-toggle="modal" class="btn btn-xs btn-primary" data-target="#acteExecute" data-acte-id="{{ $acte->id }}" data-dismiss="modal"><em class="fa fa-cog"></em></button>
                </td> 
              </tr>
            @endif
          @endforeach
        </tbody>
      </table>
    </div>    
  </div>
  <div class="row">
    <div class="col-xs-6 label label-lg label-primary arrowed-in arrowed-right">
      <span class="f-16"><strong>traitements</strong></span>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-6">
      <table  class="table  table-bordered table-hover">
        <thead>
          <tr>
            <th class="center"><strong>Nom médicament</strong></th>
            <th class="center"><strong>Posologie</strong></th>
            <th class="center"><strong>Médecin prescripteur</strong></th>
            <th class="center"><em class="fa fa-cog"></em></th>
          </tr>
        </thead>
        <tbody>
        @foreach($hosp->getlastVisite()->traitements as $trait )
            @if(!$trait->retire)
             <tr id="acte-{{ $acte->id }}">
                <td>{{ $trait->medicament->nom }}</td> 
                <td>{{ $trait->posologie }}</td>
                <td>{{ $trait->visite->medecin->full_name }}</td> 
                <td class="center">
                  <button data-toggle="modal" class="btn btn-xs btn-primary" data-target="" data-acte-id="{{ $trait->id }}" data-dismiss="modal"><em class="fa fa-cog"></em></button>
                </td> 
              </tr>
            @endif
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
<div class="row">@include('soins.ModalFoms.acteExecute')</div>
<script type="text/javascript">
  $(function(){/*$("#fait").change(function() {  if ($(this).is(':checked')) $("#obs").addClass("hidden");else $("#obs").removeClass("hidden");})*/
    $('#acteExecute').on('shown.bs.modal', function (event) {
      var acteId = $(event.relatedTarget).data('acte-id');
      $(".send").val(acteId);
    });
    $(".send").click(function(e){//runActe
      e.preventDefault();
      var formData = {
        acte_id : $(this).val(),
        does    : $("#fait").is(':checked')?1:0,
        obs     : $('#obs').val()
      };
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
      });
      $.a
      var url = "{{ route('acteExec.store') }}";
      $.ajax({
          type : 'POST',
          url :url,
          data:formData,
          success:function(data){   
           $('#acteExecute').modal('hide');
           $("#acte-" + data.acte_id).remove();
          }
      })
    })
  });
 </script> 
@endsection