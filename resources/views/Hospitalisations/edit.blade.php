@extends('app_sur')
@section('page-script')
<script type="text/javascript">
	var nowDate = new Date();
  var now = nowDate.getFullYear() + '-' + (nowDate.getMonth()+1) + '-' + ('0'+ nowDate.getDate()).slice(-2);
 	$('document').ready(function(){
    $("#dateEntree").datepicker("setDate", now);			
	  $("#dateSortie").datepicker("setDate", now);	
	  $('#dateSortie').attr('readonly', true);
		$('.timepicker').timepicker({
            timeFormat: 'HH:mm',
            interval: 15,
            minTime: '08',
            maxTime: '17:00pm',
            defaultTime: '09:00',   
            startTime: '08:00',
            dynamic: true,
            dropdown: true,
            scrollbar: true
    });
	 	$( "#RDVForm" ).submit(function( event ) {  
  			$("#dateSortie").prop('disabled', false);
  	});
	});
</script>
@endsection
@section('main-content')
<div class="page-header">
   <?php $patient = $hosp->admission->demandeHospitalisation->consultation->patient; ?>
   @include('patient._patientInfo', $patient)
</div><!-- /.page-header -->
<div class="space-12"></div>
@endsection