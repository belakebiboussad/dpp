@extends('app')
@section('title','Nouvelle Consultation')
@section('style')
 <link rel="stylesheet" href="{{ asset('css/print.css') }}" />  
 <link rel="stylesheet" href="{{ asset('css/styles.css') }}" />
 <style>
  .modaldialog {
    width:92%;
  }
  iframe {
      display: block;
      margin: 0 auto;
      border: 0;
      position:relative;
      z-index:999;
  }
  .b{
    height:20px !important;
  }
  #content {
    background: white;
    width: 98%;
    height: 100%;
    margin: 5px auto;
    border: 1px solid orange;
    padding: 10px;
  }
</style>
@endsection
@section('page-script')
<script>
function resetField()
{
  $("#description").val('');$('#dateAntcd').val('');
}
$(function(){
  $('#btn-add, #AntFamil-add').click(function () {//ADD
      $('#EnregistrerAntecedant').val("add");
      $('#modalFormData').trigger("reset");
      $('#AntecCrudModal').html("Ajouter un antécédent");//voir
      if(this.id == "AntFamil-add")
      {
        $("#EnregistrerAntecedant").attr('data-atcd','Famille'); 
        if(! ($( "#atcdsstypehide" ).hasClass( "hidden" )))
          $( "#atcdsstypehide" ).addClass("hidden");
      }else{
        $("#EnregistrerAntecedant").attr('data-atcd','Perso'); 
        if(($( "#atcdsstypehide" ).hasClass( "hidden" )))
          $('#atcdsstypehide').removeClass("hidden");
      }
      $('#antecedantModal').modal('show');
  });
 /*
  $(document).on("click","#rdvadd",function(){
    $(".calendar").fullCalendar( 'refetchEvents' );
    $('#RDV').modal("show");
  });
  */
})
</script>
@endsection
@section('main-content')
<div class="container-fluid">
<div class="row"><div class="col-sm-12">@include('patient._patientInfo')</div></div>
  <div class="row">
    <form  class="form-horizontal" id ="consultForm" action="{{ route('consultations.store') }}" method="POST" role="form">
      {{ csrf_field() }}
      <input type="hidden" name="patient_id" id="patient_id" value="{{ $patient->id }}">
      <div class="form-group" id="error" aria-live="polite">
        @if (count($errors) > 0)
        <div class="alert alert-danger">
        <ul>
         @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
        </ul>
      </div>
       @endif
      </div>
      <div class="tabpanel">
      <ul class = "nav nav-pills nav-justified list-group" role="tablist">
        <li role= "presentation" class="col-md-4 in active">
          <a href="#Interogatoire" aria-controls="Interogatoire" role="tab" data-toggle="tab" class="btn btn-secondary btn-lg">
          <span class="bigger-160" style="font-size:10vw">Interrogatoire</span>
          </a>
        </li>
        <li role= "presentation" class="col-md-4">
          <a href="#ExamClinique"  aria-controls="ExamClinique" role="tab" data-toggle="tab" class="btn btn-success btn-lg"> 
            <span class="bigger-160" style="font-size:10vw">Examens Cliniques</span></a>
        </li>
        <li role= "presentation" class="col-md-4">
            <a href="#ExamComp" aria-controls="ExamComp" role="tab" data-toggle="tab" class="btn btn-danger btn-lg">
            <span class="bigger-160" style="font-size:10vw">Examens Complémentaires</span>
          </a>
        </li>
      </ul>
      <div class ="tab-content no-border"><!-- tyle = "border-style: none;" -->
        <div role="tabpanel" class = "tab-pane active" id="Interogatoire">@include('consultations.Interogatoire')</div>
        <div role="tabpanel" class = "tab-pane" id="ExamClinique">@include('consultations.examenClinique')</div>
        <div role="tabpanel" class = "tab-pane" id="ExamComp">@include('ExamenCompl.index')</div>  
      </div>
    </div><!-- tabpanel -->
    </form>
</div>
@include('cim10.cimModalForm')
@include('antecedents.AntecedantModal')
@endsection