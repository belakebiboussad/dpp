@extends('app')
@section('title','Modifier  le patient')
@section('page-script')
<script type="text/javascript">
	function assurHide()
	{
		var active_tab_selector = $('#menuPatient a[href="#Assure"]').attr('href');
		$('#menuPatient a[href="#Assure"]').parent().addClass('hide');
		$(active_tab_selector).removeClass('active').addClass('hide');
		$('.nav-pills a[href="#Patient"]').tab('show');
 	/* 	$(".starthidden").show();*/
	}
	function assureShow(tpSelectVal)
	{
		$('.nav-pills li').eq(0).removeClass('hide');
 	 	$("div#Assure").removeClass('hide');
 	  $(".starthidden").hide(250);
 	  $('#description').val('');
 		/*if(tpSelectVal == "0"){$('.asDemograph').find('*').each(function () { $(this).attr("disabled", true); });}*/
 	}
 	function showTypeEdit(type)
 	{	
 		switch(type){
 	 		case "0":case "1": case "2": case "3": case "4":
 	 				assureShow(type);
 	 				switch('{{ $patient->Type }}'){
 	 					case "0":case "1": case "2": case "3": case "4":
 	 							if('{{ $patient->Type }}' == "0" && ( type !== "0")) //disasble  assure 'input element
 	 							{	//$('.asDemograph').find('*').each(function () { $(this).attr("disabled", false); });
 	  							$('.asdemogData').attr('disabled', '');
 	  							$('#Assure').find('input').val('');//initialiser les inputs de l'assuré
	 								$('#Assure').find("select").prop("selectedIndex",0);
 	 							} 		
 	 							break;
 	 					default:
 	 						break;
 	 				}
 	 				break;
 	 		case "5":	case "6":
 	 				assurHide();
 	 				break;
 	 		default:
 	 				break;
 		 }
 	 /*if(i ==0){
 	 		if(jQuery.inArray('{{-- $patient->Type --}}', [5,6]))
 	 		{
 	  		$('.nav-pills a[href="#Patient"]').tab('show');
 			}	
 		}*/
  	}
	$(function(){
	/*if(jQuery.inArray('{{-- $patient->Type --}}', [5,6]))
	{	$('#menuPatient a:first').hide();
	else	$('#menuPatient a:first').show();
	$('.nav-pills li.active').removeClass('active');
	$('.tab-content div.active').removeClass('active');
	$("a[href='#Patient']").tab("show");
	  $('#menuPatient li.active').removeClass('active').addClass('hide');
	 $('#menuPatient li.active').removeClass('active').css('display', 'none');  
	 }*/
	showTypeEdit('{{ $patient->Type }}');	
});
</script>
@endsection
@section('main-content')
	<ul class="nav nav-pills nav-justified list-group" role="tablist" id="menuPatient">
		<li class="active" role="presentation">
			 <a data-toggle="tab" href="#Assure" data-toggle="tab" class="Deptnav_link" aria-selected="true" onclick="copyPatientInfo('{{ $patient->id }}');">
		 		<span class="bigger-130"><strong>Assuré(e)</strong></span>
	    		</a>
 		</li>
	 	<li role="presentation">
	 	<a data-toggle="tab" href="#Patient" role="presentation" class="Deptnav_link">
	   	<span class="bigger-130"><strong>Patient</strong></span></a>
	  </li>
	</ul>
	<div class="tab-content">
  	<div id="Assure" class="tab-pane active">
			@include('assurs.editAssure')	
  	</div>
		<div id="Patient" class="tab-pane">
			@include('patient.editPatient')
		</div>
  </div><div class="hr hr-dotted"></div>
  <div class="row">
		<div class="center"><br>
			<button class="btn btn-info btn-sm" type="submit"><i class="ace-icon fa fa-save bigger-110"></i>Enregistrer</button>&nbsp; &nbsp; &nbsp;
			<button class="btn btn-default btn-sm" type="reset"><i class="ace-icon fa fa-undo bigger-110"></i>Annuler</button>
		</div>
	</div>	
@endsection
