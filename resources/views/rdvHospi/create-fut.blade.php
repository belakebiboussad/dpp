@extends('app')
@section('page-script')
<script type="text/javascript">
	var nowDate = new Date();
  var now = nowDate.getFullYear() + '-' + (nowDate.getMonth()+1) + '-' + ('0'+ nowDate.getDate()).slice(-2);
 	$('document').ready(function(){
    $("#dateEntree").datepicker("setDate", now);			
	  $("#dateSortiePre").datepicker("setDate", now);
	 	$( "#RDVForm" ).submit(function( event ) {  
  			$("#dateSortiePre").prop('disabled', false);
  	});
  	$('.filelink' ).click( function( e ) {
      e.preventDefault();  
    });
	});
	function updateDureePrevue()
	{
		if($("#dateEntree").val() != undefined) {
			var dEntree = $('#dateEntree').datepicker('getDate');
   		var dSortie = $('#dateSortiePre').datepicker('getDate');
			var iSecondsDelta = dSortie - dEntree;
			var iDaysDelta = iSecondsDelta / (24 * 60 * 60 * 1000);
			if(iDaysDelta < 0)
			{
				iDaysDelta = 0;
				$("#dateSortiePre").datepicker("setDate", dEntree); 
			}
			$('#numberDays').val(iDaysDelta );	
		}		
	}
</script>
@endsection
@section('main-content')
<div class="page-header" width="100%">
	<div class="row"><div class="col-sm-12" style="margin-top: -3%;"><?php $patient = $demande->demandeHosp->consultation->patient; ?>@include('patient._patientInfo')</div></div>
</div>
<div class="row"><h3><strong>Ajouter un Rendez-vous hospitalisation</strong></h3></div>
@endsection