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
 	 	$(".starthidden").show();	
	}
	function assureShow(tpSelectVal)
	{
		$('.nav-pills li').eq(0).removeClass('hide');
 	 	$("div#Assure").removeClass('hide');
 	  $(".starthidden").hide(250);	
 	  $('#description').val('');
 	  if(tpSelectVal == "0")
 	  {
 	  	$('.Asdemograph').find('*').each(function () { $(this).attr("disabled", true); });
 	  }
	}
 	function showTypeEdit(sel)
 	{
 		switch(sel.value){
 	 		case "0":case "1": case "2": case "3": case "4":
 	 				assureShow(sel.value);
 	 				switch('{{ $patient->Type }}'){
 	 					case "5":	case "6":
 	 							break;
 	 					case "0":case "1": case "2": case "3": case "4":
 	 							// if('{{ $patient->Type }}' == "0" && ($('#type').val() !== "0"))                       
 	 							// { 

 	 							// }	
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
 	 		if(jQuery.inArray('{{ $patient->Type }}', [5,6]))
 	 		{
 	  		$('.nav-pills a[href="#Patient"]').tab('show');
 			}	
 		}*/
  }
	$(function(){
	/*if(jQuery.inArray('{{ $patient->Type }}', [5,6]))
	{	$('#menuPatient a:first').hide();
	else	$('#menuPatient a:first').show();
	$('.nav-pills li.active').removeClass('active');
	$('.tab-content div.active').removeClass('active');
	$("a[href='#Patient']").tab("show");
	  $('#menuPatient li.active').removeClass('active').addClass('hide');
	 $('#menuPatient li.active').removeClass('active').css('display', 'none');  
	 }*/
		if(jQuery.inArray('{{ $patient->Type }}', ["5","6"]) !== -1)
		{
			assurHide();
		}else
		{
			if('{{ $patient->Type }}' == "0")
			{
				$('.Asdemograph').find('*').each(function () { $(this).attr("disabled", false); });
			}
		}
});
</script>
@endsection
@section('main-content')
	<ul class="nav nav-pills nav-justified list-group" role="tablist" id="menuPatient">
		<li class="active" role="presentation">
		  <a data-toggle="tab" href="#Assure" data-toggle="tab" class="Deptnav_link" aria-selected="true">
		   <!-- onclick="copyPatientInfo('{{ $patient->id}}');"   -->
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
			{{--
			<div class="row"><div class="col-sm-12"><h5 class="header smaller lighter blue"><strong>Informations démographiques</strong></h5></div></div>
			<div class="row  Asdemograph">
			  <div class="col-sm-6">
						<div class="form-group">
							<label class="col-sm-3 col-xs-3 control-label" for="nomf"><strong>Nom :<span style="color: red">*</span></strong></label>
							<div class="col-sm-9">
								@if(isset($assure))
									<input type="text" id="nomf" name="nomf"  value="{{ $assure->Nom }}" class="req col-xs-12 col-sm-12" autocomplete= "off" alpha/>
								@else
									<input type="text" id="nomf" name="nomf"  value="" class="col-xs-12 col-sm-12" autocomplete= "off" alpha/>
								@endif	
							</div>
						</div>
					</div>
					<div class="col-sm-6">
					<div class="form-group">
					<label class="col-sm-3 control-label" for="prenomf"><strong>Prénom :<span style="color: red">*</span></strong></label>
					<div class="col-sm-9">
						@if(isset($assure))
						<input type="text" id="prenomf" name="prenomf"  value="{{ $assure->Prenom }}" class="req col-xs-12 col-sm-12" autocomplete= "off" alpha/>
						@else
						<input type="text" id="prenomf" name="prenomf" class="col-xs-12 col-sm-12" autocomplete= "off" alpha/>
						@endif
					</div>
					</div>
					</div>
  			</div>
  			--}}
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
