@extends('app')
@section('title','Modifier  le patient')
@section('page-script')
<script type="text/javascript">
$(function(){
	if(jQuery.inArray('{{ $patient->Type }}', [5,6]))
	{

	// 	$('#menuPatient a:first').hide();
	// else
	// 	$('#menuPatient a:first').show();
	// $('.nav-pills li.active').removeClass('active');
	// $('.tab-content div.active').removeClass('active');
	// $("a[href='#Patient']").tab("show");
	  //$('#menuPatient li.active').removeClass('active').addClass('hide');
	  $('#menuPatient li.active').removeClass('active').css('display', 'none');
	  
	 }

});
</script>
@endsection
@section('main-content')
	<ul class="nav nav-pills nav-justified" role="tablist" id="menuPatient">
		<li class="active" role="presentation">
		  <a data-toggle="tab" href="#Assure" data-toggle="tab" class="Deptnav_link" onclick="copyPatientInfo('{{ $patient->id}}');"  aria-selected="true">
	    	<span class="bigger-130"><strong>Assuré(e)</strong></span>
	    </a>
 		</li>
	 	<li role="presentation">
	 	<a data-toggle="tab" href="#Patient" role="presentation" class="Deptnav_link">
	   	<span class="bigger-130"><strong>Patient</strong></span></a>
	  </li>
	</ul>
	<div class="tab-content">
  	<div id="Assure" class="tab-pane fade in active">Assure</div>
		<div id="Patient" class="tab-pane fade">Patient</div>
  </div> <div class="hr hr-dotted"></div>	
@endsection
