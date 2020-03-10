@extends('app')
@section('title')
  	Nouvelle Consultation
@endsection
@section('style')
<style>
	.modalord {
	        width:104.7% !important;
	        right:-16% !important;
	        left:-2.5% !important;
	        top:-3.1% !important;
	}
/*	.with-margin {
	  margin-top: 1px !important;
	  margin-bottom: 1px !important;
	}*/
	.with-margin {
  margin-bottom: 5px;
}

.spacer5 {
  height: 5px;
}
	.modal-body
	{
	        top: -1px !important;
	}
	.modal-footer {
		  background-color: transparent;
		  position: absolute;
		  right:2px;		
  		bottom: 0px;
	}
	.modal.modal-wide .modal-dialog {
	  width: 95%;
	  height:1000px;
	}
	.modal-wide .modal-body {
	  overflow-y: auto;
	}
	#ord {/*position: absolute;*/
  		 top:1%;	
  		 left:-5%%;
	}
	iframe {
	    display: block;
	    margin: 0 auto;
	    border: 0;
	    position:relative;
	    z-index:999;
	}
	#mymainWidget div {
		height: 250px !important;
	}
	  .modal-footer ,.modal-header {
	    background-color: #438eb9;
	    padding:0.5% 0.5%;
	    color:#FFF;
	    border-bottom:0px dashed #438eb9;
	    width:100%;
	 
	 }		
	/*fin*/
	.dataTables_wrapper {
	        font-family: tahoma;
	        font-size: 10px;
	        position: relative;
	        clear: both;
	        zoom: 1;
	        zoom: 1;
	}
	.btn-transparent {
	      background: transparent;
	      color: #F2F2F2;
	      -webkit-transition: background .2s ease-in-out, border .2s ease-in-out;
	      -moz-transition: background .2s ease-in-out, border .2s ease-in-out;
	      -o-transition: background .2s ease-in-out, border .2s ease-in-out;
	      transition: background .2s ease-in-out, border .2s ease-in-out;
	      border: 2px solid #4992B7;
	}
	.btn-transparent:hover {
	        color: white;
	        background-color: rgba(255,255,255,0.2);
	}
</style>
@endsection
@section('page-script')    
<script>
	function isNumeric (evt) {
		var theEvent = evt || window.event;
		var key = theEvent.keyCode || theEvent.which;
		key = String.fromCharCode (key);
		var regex = /[0-9]|\./;
		if ( !regex.test(key) ) {
		        theEvent.returnValue = false;
		        if(theEvent.preventDefault) theEvent.preventDefault();
		}
	}
  	$('document').ready(function(){
  		$( 'ul.nav li' ).on( 'click', function() {
			 	$(this).siblings().addClass('filter');
			});
			$('.wysiwyg-editor').on('input',function(e){
	  		var a = $(this).parent().nextAll("div.clearfix");
	   		var i = a.find("button:button").each(function(){
			   	$(this).removeAttr('disabled');
		  	});
			});
			$('.select2').css('width','400px').select2({allowClear:true})
     		$('#select2-multiple-style .btn').on('click', function(e){
	   			var target = $(this).find('input[type=radio]');
	    		var which = parseInt(target.val());
	   			if(which == 2) 
	   				$('.select2').addClass('tag-input-style');
	       	else
	       	 $('.select2').removeClass('tag-input-style');
     		});
				$(function() {
					var checkbox = $("#isOriented");  // Get the form fields and hidden div
					var hidden = $("#hidden_fields");  // Setup an event listener for when the state of the    // checkbox changes.
			    checkbox.change(function() {
				   	if (checkbox.is(':checked')) {
				  		hidden.show();
				   	} else {
				     	hidden.hide();
				     	$("#lettreorientaioncontent").val("");
				    }
					})
	   		}); 
	    	$(".two-decimals").change(function(){
	      			this.value = parseFloat(this.value).toFixed(2);
	     	});
    		$("button").click(function (event) {
		           which = '';
           			str ='send';
           			which = $(this).attr("id");
           			var which = $.trim(which);
           			var str = $.trim(str);
          			 if(which==str){
                   			return true;
          			}
     		});
    	$("#btnCalc").click(function(event){
      	  event.preventDefault();
     	});
    	$('#medc_table').DataTable({
		      processing: true, //serverSide: true,
		      ordering: true,
		      bInfo : false,
		      searching: true,
		      pageLength: 5,         
		      bLengthChange: false,
		      nowrap:true,
		      "language": {
		                    "url": '/localisation/fr_FR.json'
		      },
		      ajax: '/getmedicaments',
		          columns: [
		                    {data: 'Nom_com'},
		                    {data: 'Forme'},
		                    {data: 'Dosage'},
		                          {data: 'action', name: 'action', orderable: false, searchable: false}
		                   ]
		  });
		 	$('#ants-tab').DataTable({
        colReorder: true,
        stateSave: true,
        searching:false,
    	  'aoColumnDefs': [{
    	   	'bSortable': false,
       		'aTargets': ['nosort']
   			}],
   			"language": {
   			     "url": '/localisation/fr_FR.json'
		    },
  	  });
      jQuery('body').on('click', '.open-modal', function () {
   	    var atcd_id = $(this).val();
   	    $.get('/atcd/' + atcd_id, function (data) { 
   	    		$('#patientId').val(data.Patient_ID_Patient);
   	    		$('#atcd_id').val(data.id);
   	    		$('#Antecedant').val(data.Antecedant).change();
   	    		$('#typeAntecedant').val(data.typeAntecedant).change();
   	    		if(data.typeAntecedant   === 'Pathologiques')
						{
   	    			$('#sstypeatcdc').val(data.stypeatcd).change();
   	    		}
   	    		if(data.typeAntecedant   === 'Physiologiques')
						{
 							$('#habitudeAlim').val(data.habitudeAlim);
							(data.tabac) ? $('#tabac').prop('checked',true) : '';
			  	    (data.ethylisme) ? $('#ethylisme').prop('checked',true) : '';
			  	  }
						$('#dateAntcd').val(data.date);
						$('#description').val(data.descrioption);
   	    		jQuery('#EnregistrerAntecedant').val("update");	
		        jQuery('#antecedantModal').modal('show');
      	});
   	  });
    	$("#EnregistrerAntecedant").click(function (e) {
    		var habitudeAlim = null; var tabac=null ; var ethylisme = null;
      		e.preventDefault();
      		var formData = {
      			Patient_ID_Patient :jQuery('#patientId').val(),	
           	Antecedant         : jQuery('#Antecedant').val(),
          	typeAntecedant     : jQuery('#typeAntecedant').val(),
          	stypeatcd          : jQuery('#sstypeatcdc').val(),
            date : $('#dateAntcd').val(),
          	descrioption : $("#description").val(),
     	  	};
     	  	if(formData.typeAntecedant =="Physiologiques")
     	  	{
	      		formData.habitudeAlim = $('#habitudeAlim').val();
	      		formData.tabac = $("#tabac").is(":checked") ? 1:0;
	      		formData.ethylisme = $("#ethylisme").is(":checked") ? 1:0;     
     		}
        		if(!($("#description").val() == ''))
      		  {	
          			if($('.dataTables_empty').length > 0)
      			{
	        			$('.dataTables_empty').remove();
	      		}	
        	$.ajaxSetup({
        	  headers: {
              'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        	  }
          });
          var state = jQuery('#EnregistrerAntecedant').val();
          var type = "POST";
          var atcd_id = jQuery('#atcd_id').val();
	        var ajaxurl = '/atcd/';
	        if (state == "update") {
            type = "PUT";
            ajaxurl = '/atcd/' + atcd_id;
          }   
        $.ajax({
            type: type,
            url: ajaxurl,
            data: formData,
            dataType: 'json',
            success: function (data) {
            		var atcd = '<tr id="atcd' + data.id + '"><td class="hidden">' + data.Patient_ID_Patient + '</td><td>' + data.Antecedant + '</td><td>' + data.typeAntecedant +'</td><td>'+data.stypeatcd+
            		'</td><td>'+ data.date + '</td><td>' + data.descrioption + '</td>';
                atcd += '<td class ="center"><button class="btn btn-xs btn-info open-modal" value="' + data.id + '"><i class="fa fa-edit fa-xs" aria-hidden="true" style="font-size:16px;"></i></button>&nbsp;';
                atcd += '<button class="btn btn-xs btn-danger delete-atcd" value="' + data.id + '" data-confirm="Etes Vous Sur de supprimer?"><i class="fa fa-trash-o fa-xs"></i></button></td></tr>';
                if (state == "add") {
                    jQuery('#ants-tab tbody').append(atcd);
                } else {
                    $("#atcd" + atcd_id).replaceWith(atcd);
                }
                jQuery('#modalFormData').trigger("reset");
                jQuery('#antecedantModal').modal('hide')
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
       }          
      });
	    $('#antecedantModal').on('hidden.bs.modal', function () {
    		$("#sous_type").attr("hidden",true);
	      $('#PhysiologieANTC').attr("hidden",true);
	      $("#atcdsstypehide").attr("hidden",true);
		  });
		  jQuery('#btn-add').click(function () {
	      jQuery('#EnregistrerAntecedant').val("add");
	    	jQuery('#modalFormData').trigger("reset");
	    	jQuery('#antecedantModal').modal('show');
  		});	
  		////----- DELETE antecedant and remove from the page -----////
	    jQuery('body').on('click', '.delete-atcd', function () {
	        var atcd_id = $(this).val();      
	        $.ajaxSetup({
	            headers: {
	                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
	            }
	        });
	        $.ajax({
	            type: "DELETE",
	            url: '/atcd/' + atcd_id,
	            success: function (data) {
	                console.log(data);
	                $("#atcd" + atcd_id).remove();
	            },
	            error: function (data) {
	                console.log('Error:', data);
	            }
	        });
	    });
			$('#examensradio').on('select2:select', function (e) { 
	 			 $(".disabledElem").removeClass("disabledElem").addClass("enabledElem");
			});
			$('#examensradio').on('select2:unselecting', function(event) {
	  	 		$(".enabledElem").removeClass("enabledElem").addClass("disabledElem");
			});
      $('#btn-addImgExam').click(function(){
    		var selected = []; var array = [];	
				$('#ExamIgtModal').modal('toggle');
			  $.each($("input[name='exmns[]']:checked"), function(){
      		selected.push($(this).next('label').text());
      		array.push($(this).val());
      		$(this). prop("checked", false);
        });   
        var exam = '<tr id="acte-'+$("#examensradio").val()+'"><td id="idExamen" hidden>'+$("#examensradio").val()+'</td><td>'+$("#examensradio option:selected").text()+'</td><td id ="types" hidden>'+array+'</td><td>'+selected+'</td><td class="center" width="5%">';
	      exam += '<button type="button" class="btn btn-xs btn-danger delete-ExamImg" value="'+$("#examensradio").val()+'" data-confirm="Etes Vous Sur de supprimer?"><i class="fa fa-trash-o fa-xs"></i></button></td></tr>';     
	     	$('#ExamsImg').append(exam);
	     	$('#examensradio').val(' ').trigger('change');
	     	$(".enabledElem").removeClass("enabledElem").addClass("disabledElem");
	  	});
		  jQuery('body').on('click', '.delete-ExamImg', function () {
    		$("#acte-" + $(this).val()).remove();
   	  });
   	  $("#consultForm").submit(function(e){
     		var arrayLignes = document.getElementById("ExamsImg").rows;
    		var ExamsImg = [];
    	 	for(var i=0; i< arrayLignes.length; i++)
    		{
    			ExamsImg[i] = { acteImg: arrayLignes[i].cells[0].innerHTML, types: arrayLignes[i].cells[2].innerHTML }
    		}
     	 	var champ = $("<input type='text' name ='ExamsImg' value='"+JSON.stringify(ExamsImg)+"' hidden>");
      		champ.appendTo('#consultForm');
    	}); 
    	//calendrier pour rdv
    	var CurrentDate = (new Date()).setHours(23, 59, 59, 0); 
    	$('.calendar1').fullCalendar({
    		header: {
              left: 'prev,next today',
              center: 'title,dayGridMonth,timeGridWeek',
              right: 'month,agendaWeek,agendaDay'
        },
    		defaultView: 'agendaWeek',
        firstDay: 0,//dimanche
    		slotDuration: '00:15:00',
    		minTime:'08:00:00',
        maxTime: '17:00:00',
        navLinks: true,
        selectable: true,
        selectHelper: true,
        editable: true,
        hiddenDays: [ 5, 6 ],
        contentHeight: 700,
        eventColor: '#87CEFA',
        weekNumberCalculation: 'ISO',
        views: {}, 
       	select: function(start, end) {
       		var pid = $('#patientId').val();
       		if(start > CurrentDate)
       		{
           	createRDVModal(start,end,pid);
       		}else
       		{
       			$('.calendar1').fullCalendar('unselect');
       		}
       	},
        events: [
          @foreach($employe->rdvs as $rdv)
          {
                title : '{{ $rdv->patient->Nom . ' ' . $rdv->patient->Prenom }} ' +', ('+{{ $rdv->patient->getAge() }} +' ans)',
                start : '{{ $rdv->Date_RDV }}',
                end:   '{{ $rdv->Fin_RDV }}',
                id :'{{ $rdv->id }}',
                idPatient:'{{$rdv->patient->id}}',
                tel:'{{$rdv->patient->tele_mobile1}}',
                age:{{ $rdv->patient->getAge() }},   {{--url:'http://localhost:8000/patient/{{ $rdv->patient->id }}',--}}         
          },
          @endforeach 
    		],
    		eventRender: function (event, element, webData) {
            if(event.start < CurrentDate)
            {
              element.css('background-color', '#D3D3D3'); 
            }
            else
            {
              element.css("font-size", "1em");
              element.css("padding", "5px");      
            }
        },
    	}); 
  });
  function ajaxfunc(patientid)
 	{        
	    var habitudeAlim = null; var tabac=null ; var ethylisme = null;
	    var antecedant = $('#Antecedant').val();
	    var typeAntecedant = $('#typeAntecedant').val();
	    var soustype = $('#sstypeatcdc').val();    
	    var dateATCD = $('#dateAntcd').val()
	    var description = $("#description").val();               
	    if(typeAntecedant =="Physiologiques")
	    {
	      habitudeAlim= $('#habitudeAlim').val();
	      tabac = $("#tabac").is(":checked") ? 1:0;
	      ethylisme = $("#ethylisme").is(":checked") ? 1:0;
	    }
	    if (description === "")
	    {
	    }else{
	      $.ajax({
	          headers: {
	                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	          },
	          type:"POST",
	          url:'/AddANTCD',
	          data:{ antecedant:antecedant,typeAntecedant:typeAntecedant,soustype:soustype,dateATCD:dateATCD,description:description,patientid:patientid,habitudeAlim:habitudeAlim,tabac:tabac,ethylisme:ethylisme 
	          },
	          success:function(data){
	             $("#msg").html(data.msg);
	          }
	      }); 
	      $('#ants-tab').append("<tr><td>"+$('#Antecedant').val()+"</td><td>"+$('#dateAntcd').val()+"</td><td>"+$('#description').val()+"</td><td></td></tr>");  
	      resetField(); 
	    }
  }
  function resetField()
  {
    $("#description").val(' ');$('#dateAntcd').val('');       
  }
	function atcd()
	{  
	  $('#description').text(" ");
	    resetField();
	    if($('#Antecedant').val() === 'Personnels')
	    {
	      $("#sous_type").attr("hidden",false);
	      $("#atcdsstypehide").attr("hidden",true);
	    }
	    else
	    {
	      $("#sous_type").attr("hidden",true);
	      $('#PhysiologieANTC').attr("hidden",true);
	      $("#atcdsstypehide").attr("hidden",true);
	      $('#typeAntecedant').val(null);      //$('#typeAntecedant').prop("selectedIndex", 1);
	    }
	  }
	function atcdhide()
	{  
		  resetField(); 
		  if($('#Antecedant').val() === 'Personnels')
		  {
		  	if($('#typeAntecedant').val() === "Pathologiques")
		   	{
		      $('#atcdsstypehide').attr("hidden",false);//$('#atcdsstypehide').show();
		      $('#PhysiologieANTC').attr("hidden",true);//$('#PhysiologieANTC').hide();
		      $('#habitudeAlim').val(null);$('#tabac').prop('checked', false); 
		      $('#ethylisme').prop('checked', false);   
		   	}else
		   	{
		   	  $('#atcdsstypehide').attr("hidden",true);//$('#atcdsstypehide').hide();
		     	$('#PhysiologieANTC').attr("hidden",false);//$('#PhysiologieANTC').show();
		   		$('#sstypeatcdc').prop("selectedIndex", 1);
		    }
		    }
	}
	function createordXhr(patId,employeId)
	{
		var keys=[], meds=[];
	  	$("#ordonnance thead tr th").each(function(){
		  	if(($(this).html() == "id") || ($(this).html() == "Posologie"))
		  	{
		  	  keys.push($(this).html());
		  	}  
		});
		$("#ordonnance tbody tr").each(function(){
	  	var obj={}, i=0;
		$(this).children("td").each(function(index){
		    if((index == 1) || (index == 5) )
		  	{
		  		obj[keys[i]]=$(this).html();
		    		i++;
		  	}
	      })
  		meds.push(obj);	
	 	});
	 	var formData = {
       		id_patient:patId,
       		id_employe:employeId,
       		meds:JSON.stringify(meds),
	 	};
		$.ajaxSetup({
	    		headers: {
	        		'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
	    		}
	  	});
		$.ajax({
			beforeSend: function (xhr) {
        		var token = $('meta[name="_token"]').attr('content');
        		if (token) {
          				return xhr.setRequestHeader('X-CSRF-TOKEN', token);
        		}
   	   	},
		type: "POST",
		url: "/ordonnaces/ordPrint",
			data:formData,//contentType: "application/j-son;charset=UTF-8",
		  	dataType: "json",
		  	success: function (data,status, xhr) {	  	
			   	$('#iframe-pdf').contents().find('html').html(data.html);
			  	$("#ordajax").modal();	// $('#iframe-pdf').focus();//$("#iframe-pdf").get(0).contentWindow.print();			        
		  	},	
	   		error: function (data) {
     	 			console.log('Error:', data);
     			}
  		})
	}
	function print()
	{
		document.title = 'ordonnance-('+$('#nom').text()+' '+$('#prenom').text()+')';
		 $('#iframe-pdf').get(0).contentWindow.print();
		  document.title = 'Nouvelle Consultation';
	}
</script>
@endsection
@section('main-content')
<div class="page-header" width="100%">
<!--  style= "margin-top:-3%;" -->
	<div class="row">
		<div class="col-sm-12" style="margin-top: -5%;">	{{-- change --}}
			@include('patient._patientInfo')	
		</div>
	</div>
	
</div>
<div class="content" style="height:800px;">
<form  class="form-horizontal" action="{{ route('consultations.store') }}" method="POST" role="form" id ="consultForm" novalidate>
	 {{ csrf_field() }}
	 <input type="hidden" name="id" value="{{ $patient->id }}">
	<div id="prompt"></div>
	<div class="tabpanel">
		<ul class = "nav nav-pills nav-justified list-group" role="tablist" id="menu">
			<li role= "presentation" class="active col-md-4">
			  <a href="#Interogatoire" aria-controls="Interogatoire" role="tab" data-toggle="tab" class="btn btn-secondary btn-lg">
			    <i class="fa fa-commenting" aria-hidden="true"></i><span class="bigger-160"> Interogatoire</span>
			  </a>
			</li>
			<li role= "presentation"  class="col-md-4">
			           <a href="#ExamClinique"  ria-controls="ExamClinique" role="tab" data-toggle="tab" class="btn btn-success btn-lg"> 
			           <span class="bigger-160">Examen Clinique</span></a>
			</li>
			<li role= "presentation" class="col-md-4">
			          <a href="#ExamComp" aria-controls="ExamComp" role="tab" data-toggle="tab" class="btn btn-danger btn-lg">
			         		<span class="bigger-160">Examen Complémentaire</span>
				</a>
			</li>
	  </ul>
	  <div class ="tab-content"  style = "border-style: none;" >
	   	<div role="tabpanel" class = "tab-pane active " id="Interogatoire"> 
			  <div class= "col-md-12 col-xs-12">
			    @include('consultations.Interogatoire')
			  </div>  {{--  <div class= "col-md-3 col-xs-9"> </div> --}}
			</div>
			<div role="tabpanel" class = "tab-pane" id="ExamClinique">
			  <div class= "col-md-12 col-xs-12">
			     	@include('consultations.examenClinique')
			  </div>
			</div>  {{-- row --}}{{-- finexamenclinique --}}
			<div role="tabpanel" class = "tab-pane" id="ExamComp">
			  <div class= "col-md-12 col-xs-12">    
			     	@include('consultations.ExamenCompl')   
			  </div>{{-- <div class= "col-md-3 col-xs-9"> </div> --}}
			</div> 
	  </div>{{-- content --}}
  </div>{{-- tabpanel --}}
  <div class="space-12"></div>
  <div class="space-12"></div>
  <br><br>
  <div class="center bottom" style="bottom:0px;padding-">
			<div id="error" aria-live="polite"></div>
			<button class="btn btn-info btn-sm" type="submit" id="send">
				<i class="ace-icon fa fa-save bigger-110"></i>Enregistrer
			</button>
			&nbsp; &nbsp; &nbsp;
			<a href="{{ route('patient.show',$patient->id) }}" class="btn btn-info btn-sm">
				<i class="ace-icon fa fa-undo bigger-110"></i>Annuler
			</a>
			
	</div>	{{-- center --}}
</form>
<!-- Modal -->
<div>
	@include('consultations.LettreOrientation')
</div>
{{-- endModal --}}
<!-- Modal -->
<div>
	@include('consultations.DemadeHospitalisation')
</div>
<div class="row">
	@include('consultations.AntecedantModal')
</div>
</div>{{-- content --}}
<div class="row">
	@include('consultations.ModalFoms.Ordonnance') 
</div>
<div class="row">
@include('consultations.ModalFoms.imprimerOrdonnance') 
</div>
<div class="row">
@include('consultations.ModalFoms.imprimerOrdonnanceAjax') 
</div>
<div class="row">
	@include('consultations.ModalFoms.rendezVous') 
</div>
@endsection