@extends('app')
@section('title','Nouvelle Consultation')
@section('style')
  {{-- <link rel="stylesheet" href="{{ asset('css/print.css') }}" />  
<link rel="stylesheet" href="{{ asset('css/styles.css') }}" /> --}}
 <style>
  .modaldialog {
    width:92%;
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
  jQuery('#btn-add, #AntFamil-add').click(function () {//ADD
      jQuery('#EnregistrerAntecedant').val("add");
      jQuery('#modalFormData').trigger("reset");
      $('#AntecCrudModal').html("Ajouter un antécédent");
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
      jQuery('#antecedantModal').modal('show');
    });
});
 
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
        
      </ul>
      <div class ="tab-content no-border"><!-- tyle = "border-style: none;" -->
        <div role="tabpanel" class = "tab-pane active" id="Interogatoire">@include('consultations.Interogatoire')</div>
      </div>
    </div><!-- tabpanel -->
    </form>
</div>
@include('cim10.cimModalForm')
@include('antecedents.AntecedantModal')
@endsection